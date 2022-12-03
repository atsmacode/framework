<?php

require './vendor/autoload.php';

use Atsmacode\Framework\DbConfigProvider;
use Atsmacode\Framework\Console\Commands\BuildEnvironment;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new BuildEnvironment(null, new DbConfigProvider()));
$application->run();
