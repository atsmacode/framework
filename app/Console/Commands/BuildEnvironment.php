<?php

namespace Atsmacode\Framework\Console\Commands;

use Atsmacode\Framework\ConfigProvider;
use Atsmacode\Framework\Migrations\CreateTestTable;
use Atsmacode\Framework\Migrations\CreateDatabase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(
    name: 'app:build-framework',
    description: 'Populate the DB with all resources',
    hidden: false,
    aliases: ['app:build-framework']
)]

class BuildEnvironment extends Command
{
    private $buildClasses = [
        CreateDatabase::class,
        CreateTestTable::class
    ];

    protected static $defaultName = 'app:build-framework';

    public function __construct(string $name = null, ConfigProvider $configProvider)
    {
        parent::__construct($name);

        $this->configProvider = $configProvider;
    }

    protected function configure(): void
    {
        $this->addArgument('-v', InputArgument::OPTIONAL, 'Display feedback message in console.');
        $this->addOption('-d', '-d', InputArgument::OPTIONAL, 'Run in dev mode for running unit tests.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $GLOBALS['THE_ROOT'] = '';
        
        unset($GLOBALS['dev']);
        $dev    = $input->getOption('-d') === 'true' ?: false;
        $GLOBALS['dev'] = $dev ? $dev : null; 

        foreach($this->buildClasses as $class){
            foreach($class::$methods as $method){
                (new $class($this->configProvider))->{$method}();
            }
        }

        return Command::SUCCESS;
    }
}
