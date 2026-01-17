<?php


function createApp($data = []){
    
    $appnick = $data['Nick'];
        $json = json_encode($data);

        $creatdata = new AppData($appnick);
        echo "Creating $appnick .....\n\n";
        $creatdata->createdr();
        echo "Creating Directories for $appnick .....\n\n";
        $creatdata->createData();

        echo "Adding Nacessary Data to $appnick .....\n";

        file_put_contents("Apps/$appnick/conf.json",$json);
        echo "Created $appnick .....\nEnjoy your App in Apps/$appnick";

}


if($program == "CreateApp"){
    $data = [];
    echo "Welcome to App Creation Wizard\n\n";
    $appnick = readline("Type your App Nick name (no Space) ");
    $data['Nick'] = $appnick;

    echo "\n\n";
    $name = readline("Type your App Full name:  ");
    $data['Name'] = $name;
    echo "\n\n";

    $summary = readline("Type your App Summary: ");
    $data['Summary'] = $summary;
    echo "\n\n";

    $version = readline("Type your App Version: ");
    $data['Version'] = $version;
    echo "\n\n";

    $author = readline("Type Author to your App(your Name) : ");
    $data['author'] = $author;
    echo "\n\n";

    $website = readline("Type your app website : ");
    $data['Website'] = $website;
    echo "\n\n";

    $email = readline("Type Author email : ");
    $data['Email'] = $email;
    $data['logo'] = null;

    createApp($data);

}
