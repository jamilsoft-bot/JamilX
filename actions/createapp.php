<?php

class createapp extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle("Create App");
        $this->setText("");
    }

    public function getAction()
    {
        if (isset($_POST['createBtn'])) {
            $this->processAppCreation();
        }
        include "containers/apps/createapp.php";
    }

    private function processAppCreation()
    {
        $nick = trim($_POST['Nick']);
        $name = trim($_POST['Name']);
        $version = trim($_POST['Version']);
        $author = trim($_POST['author']);
        $email = trim($_POST['Email']);
        $website = trim($_POST['Website']);
        $summary = trim($_POST['Summary']);

        if (empty($nick)) {
            echo "<script>alert('App Nickname is required'); history.back();</script>";
            return;
        }

        if (class_exists('AppData')) {
            // Prepare Data
            $data = [
                'Nick' => $nick,
                'Name' => $name,
                'Version' => $version,
                'author' => $author,
                'Email' => $email,
                'Website' => $website,
                'Summary' => $summary,
                'logo' => null,
                'tag' => 'jamilx, App, Saas'
            ];

            try {
                // Instantiate AppData to create structure
                $appData = new AppData($nick);
                $appData->createdr();
                $appData->createData();

                // Generate Configuration
                $json = json_encode($data, JSON_PRETTY_PRINT);
                if (!is_dir("Apps/$nick")) {
                    mkdir("Apps/$nick", 0777, true);
                }
                file_put_contents("Apps/$nick/conf.json", $json);

                // Success Message
                echo "<div class='fixed top-5 right-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative' role='alert'>
                        <strong class='font-bold'>Success!</strong>
                        <span class='block sm:inline'>App '$nick' created successfully.</span>
                      </div>";

                // Optional: Redirect or clear form
                // echo "<script>setTimeout(function(){ window.location.href = '?action=createapp'; }, 2000);</script>";

            } catch (Exception $e) {
                echo "<div class='fixed top-5 right-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>
                        <strong class='font-bold'>Error!</strong>
                        <span class='block sm:inline'>" . $e->getMessage() . "</span>
                      </div>";
            }
        } else {
            echo "<div class='fixed top-5 right-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>
                        <strong class='font-bold'>System Error!</strong>
                        <span class='block sm:inline'>AppData class not found.</span>
                      </div>";
        }
    }
}
