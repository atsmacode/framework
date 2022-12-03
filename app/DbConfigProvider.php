<?php

namespace Atsmacode\Database;

use Atsmacode\Database\ConfigProvider;
use Laminas\ConfigAggregator\ConfigAggregator;

class DbConfigProvider extends ConfigProvider
{
    public function get()
    {
        $aggregator = new ConfigAggregator([
            DbConfig::class
        ]);

        return $aggregator->getMergedConfig(); 
    }
}
