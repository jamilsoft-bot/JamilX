<?php

class emailhome extends JX_Action implements JX_ActionI{
     public function __construct()
    {
        $this->setTitle("Welcome to JamilX email service");
        $this->setText("");
    }

    public function getAction()
    {
        include "containers/email/home.php";
    }
}

class emailconfig extends JX_Action implements JX_ActionI{
    public function __construct()
    {
        $this->setTitle("Email Configuration Status");
        $this->setText("");
    }

    public function getAction()
    {
        $config = Email::config();
        include "containers/email/config.php";
    }
}

class emailtest extends JX_Action implements JX_ActionI{
    public function __construct()
    {
        $this->setTitle("Send Test Email");
        $this->setText("");
    }

    public function getAction()
    {
        global $Url;
        $config = Email::config();
        $result = null;
        $error = null;
        $success = null;

        if ($Url->post('send_test')) {
            $to = trim($Url->post('to'));
            $subject = trim($Url->post('subject'));
            $message = trim($Url->post('message'));
            $template = $Url->post('template');
            $mode = $Url->post('mode');
            $replyTo = trim($Url->post('reply_to'));

            if (!Email::validateEmail($to)) {
                $error = "Invalid recipient email address.";
            } else {
                $options = [
                    'reply_to' => $replyTo,
                ];

                if ($template !== null && $template !== '' && $template !== 'custom') {
                    $options['template'] = $template;
                    $options['vars'] = [
                        'name' => 'JamilX User',
                        'subject' => $subject,
                        'message' => $message,
                        'action_url' => 'https://example.com',
                        'code' => rand(100000, 999999),
                    ];
                    if ($mode === 'queue') {
                        $result = Email::queue($to, $subject, '', $options);
                    } else {
                        $result = Email::send($to, $subject, '', $options);
                    }
                } else {
                    $safeMessage = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));
                    if ($mode === 'queue') {
                        $result = Email::queue($to, $subject, $safeMessage, $options);
                    } else {
                        $result = Email::send($to, $subject, $safeMessage, $options);
                    }
                }

                if ($result && $result['success']) {
                    $success = $mode === 'queue' ? 'Email queued successfully.' : 'Email sent successfully.';
                } else {
                    $error = $config['debug'] && $result ? $result['error'] : 'Unable to send email.';
                }
            }
        }

        if ($success) {
            JX_Alert("Email", $success, "green");
        }
        if ($error) {
            JX_Alert("Email", $error, "red");
        }

        include "containers/email/test.php";
    }
}

class emaillogs extends JX_Action implements JX_ActionI{
    public function __construct()
    {
        $this->setTitle("Email Logs");
    }

    public function getAction()
    {
        $emailLogs = Email::getLogs(200);
        include "containers/email/logs.php";
    }
}

class emailqueue extends JX_Action implements JX_ActionI{
    public function __construct()
    {
        $this->setTitle("Email Queue Monitor");
    }

    public function getAction()
    {
        global $Url;
        if ($Url->get('retry') !== null) {
            $id = (int) $Url->get('retry');
            if (Email::retryQueue($id)) {
                JX_Alert("Queue", "Email queued for retry.", "green");
            } else {
                JX_Alert("Queue", "Unable to retry email.", "red");
            }
        }

        $status = $Url->get('status');
        $viewId = $Url->get('view');
        $queueView = null;
        if ($viewId !== null) {
            $queueView = Email::getQueueItem((int) $viewId);
        }
        $emailQueue = Email::getQueueItems($status ?: null, 200);
        include "containers/email/queue.php";
    }
}

class emailselftest extends JX_Action implements JX_ActionI{
    public function __construct()
    {
        $this->setTitle("Email Self-Test");
    }

    public function getAction()
    {
        include "containers/email/selftest-view.php";
    }
}
