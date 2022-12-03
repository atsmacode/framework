<?php

require './vendor/autoload.php';

use Atsmacode\Database\DbConfigProvider;
use Atsmacode\Database\Console\Commands\BuildEnvironment;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new BuildEnvironment(null, new DbConfigProvider()));
$application->run();
