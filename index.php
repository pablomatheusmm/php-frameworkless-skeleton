<?php

require_once './vendor/autoload.php';

use App\App;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

$whoops = new Run;
$whoops->prependHandler(new PrettyPageHandler);
$whoops->register();

$app = new App();
$app->run();

