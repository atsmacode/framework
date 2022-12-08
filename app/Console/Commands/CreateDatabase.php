<?php

namespace Atsmacode\Framework\Console\Commands;

use Atsmacode\Framework\Migrations\CreateDatabase as CreateDatabaseMigration;

#[AsCommand(
    name: 'app:create-database',
    description: 'Create/drop your DB',
    hidden: false,
    aliases: ['app:create-database']
)]

class CreateDatabase extends Migrator
{
    protected array $buildClasses = [
        CreateDatabaseMigration::class
    ];

    protected static $defaultName = 'app:create-database';
}
