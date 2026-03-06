<?php

class auth extends JX_Serivce implements JX_service
{
    public function __construct()
    {
        $this->setTitle('Auth API');
    }

    public function main()
    {
        global $Url;
        $action = $Url->get('action');
        $action = is_null($action) ? 'none' : $action;

        $allowed = [
            'none',
            'webauthnRegisterOptions',
            'webauthnRegisterVerify',
            'webauthnLoginOptions',
            'webauthnLoginVerify',
        ];

        if (!in_array($action, $allowed, true) || !method_exists($this, $action)) {
            return JX_WebAuthn::json(['ok' => false, 'error' => 'Action not found'], 404);
        }

        return $this->$action();
    }

    public function none()
    {
        return JX_WebAuthn::json([
            'ok' => true,
            'service' => 'auth',
            'actions' => [
                'webauthnRegisterOptions',
                'webauthnRegisterVerify',
                'webauthnLoginOptions',
                'webauthnLoginVerify',
            ],
        ]);
    }

    public function webauthnRegisterOptions()
    {
        global $JX_db, $users;

        $uid = isset($_SESSION['uid']) ? intval($_SESSION['uid']) : 0;
        if ($uid <= 0) {
            return JX_WebAuthn::json(['ok' => false, 'error' => 'Unauthorized'], 401);
        }

        $challenge = JX_WebAuthn::randomChallenge();
        $this->storeChallenge($challenge, 'register', $uid);

        $username = (string) $users->get_username($uid);
        if ($username === '') {
            $username = 'user-' . $uid;
        }

        $excludeCredentials = [];
        $stmt = $JX_db->prepare("SELECT `credential_id` FROM `user_passkeys` WHERE `user_id` = ? AND `revoked_at` IS NULL");
        if ($stmt) {
            $stmt->bind_param('i', $uid);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res) {
                while ($row = $res->fetch_assoc()) {
                    $excludeCredentials[] = [
                        'type' => 'public-key',
                        'id' => $row['credential_id'],
                    ];
                }
            }
            $stmt->close();
        }

        return JX_WebAuthn::json([
            'ok' => true,
            'publicKey' => [
                'challenge' => $challenge,
                'rp' => [
                    'name' => 'JamilX',
                    'id' => JX_WebAuthn::rpId(),
                ],
                'user' => [
                    'id' => JX_WebAuthn::b64urlEncode((string) $uid),
                    'name' => $username,
                    'displayName' => $username,
                ],
                'pubKeyCredParams' => [
                    ['type' => 'public-key', 'alg' => -7],
                    ['type' => 'public-key', 'alg' => -257],
                ],
                'timeout' => 60000,
                'attestation' => 'none',
                'excludeCredentials' => $excludeCredentials,
                'authenticatorSelection' => [
                    'residentKey' => 'preferred',
                    'userVerification' => 'preferred',
                ],
            ],
        ]);
    }

    public function webauthnRegisterVerify()
    {
        global $JX_db;

        $uid = isset($_SESSION['uid']) ? intval($_SESSION['uid']) : 0;
        if ($uid <= 0) {
            return JX_WebAuthn::json(['ok' => false, 'error' => 'Unauthorized'], 401);
        }

        $body = JX_WebAuthn::getJsonBody();
        $credentialId = isset($body['id']) ? (string) $body['id'] : '';
        $response = isset($body['response']) && is_array($body['response']) ? $body['response'] : [];
        $clientDataJSON = isset($response['clientDataJSON']) ? (string) $response['clientDataJSON'] : '';

        if ($credentialId === '' || $clientDataJSON === '') {
            return JX_WebAuthn::json(['ok' => false, 'error' => 'Invalid payload'], 422);
        }

        $decodedClientData = json_decode(JX_WebAuthn::b64urlDecode($clientDataJSON), true);
        $challenge = is_array($decodedClientData) && isset($decodedClientData['challenge'])
            ? (string) $decodedClientData['challenge']
            : '';

        if (!$this->consumeChallenge($challenge, 'register', $uid)) {
            return JX_WebAuthn::json(['ok' => false, 'error' => 'Challenge validation failed'], 422);
        }

        // NOTE: cryptographic attestation verification is a follow-up phase.
        $publicKey = isset($response['publicKey']) ? (string) $response['publicKey'] : (string) (isset($response['attestationObject']) ? $response['attestationObject'] : '');
        $transports = isset($response['transports']) ? json_encode($response['transports']) : null;

        $stmt = $JX_db->prepare(
            "INSERT INTO `user_passkeys` (`user_id`, `credential_id`, `public_key_cose`, `transports`) VALUES (?, ?, ?, ?)"
        );

        if (!$stmt) {
            return JX_WebAuthn::json(['ok' => false, 'error' => 'Database error'], 500);
        }

        $stmt->bind_param('isss', $uid, $credentialId, $publicKey, $transports);
        $ok = $stmt->execute();
        $stmt->close();

        if (!$ok) {
            return JX_WebAuthn::json(['ok' => false, 'error' => 'Unable to save passkey (possibly duplicate credential).'], 422);
        }

        return JX_WebAuthn::json(['ok' => true]);
    }

    public function webauthnLoginOptions()
    {
        global $JX_db;

        $body = JX_WebAuthn::getJsonBody();
        $username = isset($body['username']) ? trim((string) $body['username']) : '';

        $uid = null;
        if ($username !== '') {
            $stmt = $JX_db->prepare("SELECT `id` FROM `users` WHERE `username` = ? LIMIT 1");
            if ($stmt) {
                $stmt->bind_param('s', $username);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result) {
                    $row = $result->fetch_assoc();
                    if ($row) {
                        $uid = intval($row['id']);
                    }
                }
                $stmt->close();
            }
        }

        $challenge = JX_WebAuthn::randomChallenge();
        $this->storeChallenge($challenge, 'login', $uid);

        $allowCredentials = [];
        if (!is_null($uid)) {
            $stmt = $JX_db->prepare("SELECT `credential_id` FROM `user_passkeys` WHERE `user_id` = ? AND `revoked_at` IS NULL");
            if ($stmt) {
                $stmt->bind_param('i', $uid);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res) {
                    while ($row = $res->fetch_assoc()) {
                        $allowCredentials[] = [
                            'type' => 'public-key',
                            'id' => (string) $row['credential_id'],
                        ];
                    }
                }
                $stmt->close();
            }
        }

        return JX_WebAuthn::json([
            'ok' => true,
            'publicKey' => [
                'challenge' => $challenge,
                'rpId' => JX_WebAuthn::rpId(),
                'timeout' => 60000,
                'userVerification' => 'preferred',
                'allowCredentials' => $allowCredentials,
            ],
        ]);
    }

    public function webauthnLoginVerify()
    {
        global $JX_db;

        $body = JX_WebAuthn::getJsonBody();
        $credentialId = isset($body['id']) ? (string) $body['id'] : '';
        $response = isset($body['response']) && is_array($body['response']) ? $body['response'] : [];
        $clientDataJSON = isset($response['clientDataJSON']) ? (string) $response['clientDataJSON'] : '';
        $resume = isset($body['resume']) ? $this->sanitizeResume((string) $body['resume']) : 'dashboard';

        if ($credentialId === '' || $clientDataJSON === '') {
            return JX_WebAuthn::json(['ok' => false, 'error' => 'Invalid payload'], 422);
        }

        $decodedClientData = json_decode(JX_WebAuthn::b64urlDecode($clientDataJSON), true);
        $challenge = is_array($decodedClientData) && isset($decodedClientData['challenge'])
            ? (string) $decodedClientData['challenge']
            : '';

        if (!$this->consumeChallenge($challenge, 'login', null)) {
            return JX_WebAuthn::json(['ok' => false, 'error' => 'Challenge validation failed'], 422);
        }

        // NOTE: cryptographic assertion verification is a follow-up phase.
        $stmt = $JX_db->prepare(
            "SELECT `user_id`, `sign_count` FROM `user_passkeys` WHERE `credential_id` = ? AND `revoked_at` IS NULL LIMIT 1"
        );

        if (!$stmt) {
            return JX_WebAuthn::json(['ok' => false, 'error' => 'Database error'], 500);
        }

        $stmt->bind_param('s', $credentialId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result ? $result->fetch_assoc() : null;
        $stmt->close();

        if (!$row) {
            return JX_WebAuthn::json(['ok' => false, 'error' => 'Unknown credential'], 401);
        }

        $uid = intval($row['user_id']);
        $_SESSION['uid'] = $uid;
        setcookie('uid', (string) $uid);

        $stmt = $JX_db->prepare("UPDATE `user_passkeys` SET `last_used_at` = NOW() WHERE `credential_id` = ?");
        if ($stmt) {
            $stmt->bind_param('s', $credentialId);
            $stmt->execute();
            $stmt->close();
        }

        return JX_WebAuthn::json([
            'ok' => true,
            'uid' => $uid,
            'resume' => $resume,
            'redirect' => $resume,
        ]);
    }

    private function storeChallenge($challenge, $type, $userId = null)
    {
        global $JX_db;

        $expiresAt = date('Y-m-d H:i:s', time() + 300);
        $sessionId = session_id();
        $uid = is_null($userId) ? 0 : intval($userId);

        $stmt = $JX_db->prepare(
            "INSERT INTO `webauthn_challenges` (`session_id`, `challenge`, `challenge_type`, `user_id`, `expires_at`) VALUES (?, ?, ?, ?, ?)"
        );

        if ($stmt) {
            $stmt->bind_param('sssis', $sessionId, $challenge, $type, $uid, $expiresAt);
            $stmt->execute();
            $stmt->close();
        }

        $cleanup = $JX_db->prepare("DELETE FROM `webauthn_challenges` WHERE `expires_at` < NOW()");
        if ($cleanup) {
            $cleanup->execute();
            $cleanup->close();
        }
    }

    private function consumeChallenge($challenge, $type, $userId = null)
    {
        global $JX_db;

        if ($challenge === '') {
            return false;
        }

        if (is_null($userId)) {
            $stmt = $JX_db->prepare(
                "SELECT `id` FROM `webauthn_challenges` WHERE `challenge` = ? AND `challenge_type` = ? AND `expires_at` > NOW() ORDER BY `id` DESC LIMIT 1"
            );
            if (!$stmt) {
                return false;
            }
            $stmt->bind_param('ss', $challenge, $type);
        } else {
            $uid = intval($userId);
            $stmt = $JX_db->prepare(
                "SELECT `id` FROM `webauthn_challenges` WHERE `challenge` = ? AND `challenge_type` = ? AND `user_id` = ? AND `expires_at` > NOW() ORDER BY `id` DESC LIMIT 1"
            );
            if (!$stmt) {
                return false;
            }
            $stmt->bind_param('ssi', $challenge, $type, $uid);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result ? $result->fetch_assoc() : null;
        $stmt->close();

        if (!$row) {
            return false;
        }

        $id = intval($row['id']);
        $del = $JX_db->prepare("DELETE FROM `webauthn_challenges` WHERE `id` = ?");
        if ($del) {
            $del->bind_param('i', $id);
            $del->execute();
            $del->close();
        }

        return true;
    }

    private function sanitizeResume($resume)
    {
        $resume = trim((string) $resume);

        if ($resume === '') {
            return 'dashboard';
        }

        if (strpos($resume, '://') !== false || strpos($resume, '//') === 0) {
            return 'dashboard';
        }

        if (!preg_match('/^[a-zA-Z0-9_\-\/?=&]+$/', $resume)) {
            return 'dashboard';
        }

        return $resume;
    }
}
