<?php
    $title = 'Admin Panel';

    $config = [
        'dataDir' => '../../data',
        'langs' => ['en','ru']
    ];

    function getDaraDirByLangName($baseDir,$langsArray){
        //get all files and dirs from data dir
        $files = scandir($baseDir);
        $langDirs = [];

        foreach ($files as $file){
            if(in_array($file,$langsArray)){
                $langDirs[] = $file;
            }
        }

        return $langDirs;
    }

    $dirs = getDaraDirByLangName($config['dataDir'],$config['langs']);

    function readFiles($baseDir,$langsDir){

        foreach($langsDir as $langDir){
            if($handle = opendir($baseDir.'/'.$langDir)){
                while (false !== ($dataFile = readdir($handle))) { 

                    $fd = fopen($baseDir.'/'.$langDir.'/'.$dataFile, 'r') or die("не удалось открыть файл");
                    while(!feof($fd))
                    {
                        $str = htmlentities(fgets($fd));
                        echo $str;
                    }
                    fclose($fd);
                }
            }
        }
    }

    readFiles($config['dataDir'],$dirs);

?>
<!DOCTYPE html>
<html lang="ru-RU">
    <head>
        <meta charset="utf-8">
        <title>Admin Panel</title>

        <!-- mobile responsive meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Admin panel | By Ginger Studio">
        <meta name="author" content="kaowebdev">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1><?=$title; ?></h1>
                </div>
            </div>
        </div>
    </body>
</html>