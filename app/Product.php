<?php

namespace App;

use Secrethash\R8\Contracts\R8;
use Secrethash\R8\Traits\R8Trait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements R8
{
    //
    use R8Trait;
}
