<?php

namespace Atsmacode\Framework\Models;

use Atsmacode\Framework\Collection\Collection;
use Atsmacode\Framework\Models\FrameworkModel;

class Test extends FrameworkModel
{
    use Collection;

    public        $table = 'test';
    public string $name;
    public int    $id;
}
