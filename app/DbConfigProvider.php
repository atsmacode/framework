<?php

namespace Atsmacode\Framework;

use Atsmacode\Framework\ConfigProvider;
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
