<?php

require './vendor/autoload.php';

use Atsmacode\Framework\FrameworkConfigProvider;
use Atsmacode\Framework\Console\Commands\BuildEnvironment;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new BuildEnvironment(null, new FrameworkConfigProvider()));
$application->run();
