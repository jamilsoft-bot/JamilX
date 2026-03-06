<?php
$showEmail = !empty($preferences['show_email']);
$showPhone = !empty($preferences['show_phone']);
$showLocation = !empty($preferences['show_location']);
$newsletter = !empty($preferences['newsletter']);
?>

<form action="profile?action=settingsupdate" method="post" class="space-y-6">
    <div class="rounded-3xl bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-slate-900">Visibility Preferences</h3>
        <p class="mt-2 text-sm text-slate-500">Choose what information is visible on your public profile.</p>
        <div class="mt-6 space-y-4">
            <label class="flex items-center justify-between rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                <span>Show email address</span>
                <input type="checkbox" name="show_email" class="h-5 w-5 rounded border-slate-300 text-blue-600" <?php echo $showEmail ? 'checked' : ''; ?>>
            </label>
            <label class="flex items-center justify-between rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                <span>Show phone number</span>
                <input type="checkbox" name="show_phone" class="h-5 w-5 rounded border-slate-300 text-blue-600" <?php echo $showPhone ? 'checked' : ''; ?>>
            </label>
            <label class="flex items-center justify-between rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                <span>Show location</span>
                <input type="checkbox" name="show_location" class="h-5 w-5 rounded border-slate-300 text-blue-600" <?php echo $showLocation ? 'checked' : ''; ?>>
            </label>
        </div>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-slate-900">Notifications</h3>
        <p class="mt-2 text-sm text-slate-500">Stay in the loop with product updates and announcements.</p>
        <label class="mt-6 flex items-center justify-between rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-600">
            <span>Subscribe to the newsletter</span>
            <input type="checkbox" name="newsletter" class="h-5 w-5 rounded border-slate-300 text-blue-600" <?php echo $newsletter ? 'checked' : ''; ?>>
        </label>
    </div>

    <div class="flex justify-end gap-3">
        <a href="profile?action=view" class="rounded-full border border-slate-200 px-6 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">Back</a>
        <button class="rounded-full bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700" type="submit">Save Settings</button>
    </div>


<div class="rounded-3xl bg-white p-6 shadow-sm">
    <h3 class="text-lg font-semibold text-slate-900">Passkey Security</h3>
    <p class="mt-2 text-sm text-slate-500">Add biometric/passkey login and manage registered devices.</p>

    <div class="mt-4 flex flex-wrap items-center gap-3">
        <button id="passkey-enroll-btn" type="button" class="rounded-full bg-indigo-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">
            <i class="fa-solid fa-fingerprint mr-2"></i> Add passkey
        </button>
        <button id="passkey-refresh-btn" type="button" class="rounded-full border border-slate-200 px-5 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
            Refresh list
        </button>
    </div>

    <div id="passkey-message" class="mt-4 text-sm text-slate-600"></div>
    <div id="passkey-list" class="mt-4 space-y-3"></div>
</div>

</form>


<script>
(function () {
    const toBase64Url = bytes => {
        const str = String.fromCharCode(...new Uint8Array(bytes));
        return btoa(str).replace(/\+/g, '-').replace(/\//g, '_').replace(/=+$/g, '');
    };

    const fromBase64Url = input => {
        const base64 = (input || '').replace(/-/g, '+').replace(/_/g, '/');
        const pad = base64.length % 4 ? '='.repeat(4 - (base64.length % 4)) : '';
        const raw = atob(base64 + pad);
        const bytes = new Uint8Array(raw.length);
        for (let i = 0; i < raw.length; i++) bytes[i] = raw.charCodeAt(i);
        return bytes.buffer;
    };

    const message = document.getElementById('passkey-message');
    const list = document.getElementById('passkey-list');
    const enrollBtn = document.getElementById('passkey-enroll-btn');
    const refreshBtn = document.getElementById('passkey-refresh-btn');

    if (!enrollBtn || !refreshBtn || !message || !list) return;

    const setMessage = (text, danger = false) => {
        message.className = danger ? 'mt-4 text-sm text-red-600' : 'mt-4 text-sm text-slate-600';
        message.textContent = text || '';
    };

    const renderList = (items) => {
        if (!Array.isArray(items) || !items.length) {
            list.innerHTML = '<p class="text-sm text-slate-500">No passkeys registered yet.</p>';
            return;
        }

        list.innerHTML = items.map(item => {
            const created = item.created_at ? new Date(item.created_at.replace(' ', 'T')).toLocaleString() : 'Unknown';
            const lastUsed = item.last_used_at ? new Date(item.last_used_at.replace(' ', 'T')).toLocaleString() : 'Never';
            const cred = item.credential_id || '';
            const shortCred = cred.length > 18 ? `${cred.slice(0, 9)}…${cred.slice(-6)}` : cred;
            return `
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-800">${item.device_name || 'Passkey'}</p>
                        <p class="text-xs text-slate-500">Credential: ${shortCred}</p>
                        <p class="text-xs text-slate-500">Created: ${created}</p>
                        <p class="text-xs text-slate-500">Last used: ${lastUsed}</p>
                    </div>
                    <button data-passkey-revoke="${item.id}" type="button" class="rounded-full border border-red-200 px-4 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-50">Revoke</button>
                </div>
            `;
        }).join('');

        list.querySelectorAll('[data-passkey-revoke]').forEach(btn => {
            btn.addEventListener('click', async () => {
                const id = Number(btn.getAttribute('data-passkey-revoke'));
                if (!id) return;
                if (!confirm('Revoke this passkey?')) return;

                try {
                    const resp = await fetch('auth?action=webauthnRevoke', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id })
                    });
                    const data = await resp.json();
                    if (!data.ok) throw new Error(data.error || 'Unable to revoke passkey.');
                    setMessage('Passkey revoked successfully.');
                    await loadPasskeys();
                } catch (err) {
                    setMessage(err.message || 'Unable to revoke passkey.', true);
                }
            });
        });
    };

    const loadPasskeys = async () => {
        try {
            const resp = await fetch('auth?action=webauthnList');
            const data = await resp.json();
            if (!data.ok) throw new Error(data.error || 'Unable to load passkeys.');
            renderList(data.items || []);
        } catch (err) {
            setMessage(err.message || 'Unable to load passkeys.', true);
        }
    };

    if (!window.PublicKeyCredential || !navigator.credentials) {
        enrollBtn.classList.add('hidden');
        setMessage('This browser does not support passkeys/WebAuthn.', true);
        loadPasskeys();
        return;
    }

    enrollBtn.addEventListener('click', async () => {
        try {
            enrollBtn.disabled = true;
            setMessage('Starting passkey setup...');

            const optionsResp = await fetch('auth?action=webauthnRegisterOptions');
            const optionsData = await optionsResp.json();
            if (!optionsData.ok) throw new Error(optionsData.error || 'Unable to start passkey registration.');

            const publicKey = optionsData.publicKey;
            publicKey.challenge = fromBase64Url(publicKey.challenge);
            publicKey.user.id = fromBase64Url(publicKey.user.id);
            if (Array.isArray(publicKey.excludeCredentials)) {
                publicKey.excludeCredentials = publicKey.excludeCredentials.map(item => ({
                    ...item,
                    id: fromBase64Url(item.id)
                }));
            }

            const credential = await navigator.credentials.create({ publicKey });
            if (!credential) throw new Error('No passkey credential was created.');

            const payload = {
                id: credential.id,
                type: credential.type,
                rawId: toBase64Url(credential.rawId),
                response: {
                    clientDataJSON: toBase64Url(credential.response.clientDataJSON),
                    attestationObject: credential.response.attestationObject ? toBase64Url(credential.response.attestationObject) : null,
                    transports: credential.response.getTransports ? credential.response.getTransports() : []
                }
            };

            const verifyResp = await fetch('auth?action=webauthnRegisterVerify', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            const verifyData = await verifyResp.json();
            if (!verifyData.ok) throw new Error(verifyData.error || 'Passkey registration failed.');

            setMessage('Passkey added successfully.');
            await loadPasskeys();
        } catch (err) {
            setMessage(err.message || 'Passkey registration failed.', true);
        } finally {
            enrollBtn.disabled = false;
        }
    });

    refreshBtn.addEventListener('click', () => {
        setMessage('Refreshing passkey list...');
        loadPasskeys();
    });

    loadPasskeys();
})();
</script>
