<?php

interface Logger {
    public function log($data);
}


class LogToFile implements Logger {
    public function log($data)
    {
        echo $data.' logged to a file.';
    }
}


class LogToDatabase implements Logger {
    public function log($data)
    {
        echo $data.' logged to a Database.';
    }
}

class LogToApi implements Logger {
    public function log($data)
    {
        echo $data.' logged to a Api.';
    }
}


class App {

    public function log($data, Logger $logger = null)
    {
        $logger->log($data);
    }
}

$app = new App();

$app->log('This Data', new LogToDatabase); // This will print "This Data logged to a Database"
$app->log('This Data', new LogToApi);  // This will print "This Data logged to a Api"


