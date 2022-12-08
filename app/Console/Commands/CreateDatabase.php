<?php

namespace Atsmacode\Framework\Console\Commands;

#[AsCommand(
    name: 'app:create-database',
    description: 'Create/drop your DB',
    hidden: false,
    aliases: ['app:create-database']
)]

class CreateDatabase extends Migrator
{
    protected array $buildClasses = [
        CreateDatabase::class
    ];

    protected static $defaultName = 'app:create-database';
}
