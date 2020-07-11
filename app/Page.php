<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //

    /**
     * Get the Route Key for the Model
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
