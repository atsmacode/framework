<?php

namespace Atsmacode\Framework\Models;

use Atsmacode\Framework\Collection\Collection;
use Atsmacode\Framework\Dbal\Model;

class Test extends Model
{
    use Collection;

    public        $table = 'test';
    public string $name;
    public int    $id;
}
