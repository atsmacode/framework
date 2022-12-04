<?php

namespace Atsmacode\Framework\Models;

use Atsmacode\Framework\Dbal\Model;
use Atsmacode\Framework\FrameworkConfigProvider;

class FrameworkModel extends Model
{
    public function __construct(array $data = null)
    {
        parent::__construct(new FrameworkConfigProvider());
        
        $this->data = $data;
    }
}
