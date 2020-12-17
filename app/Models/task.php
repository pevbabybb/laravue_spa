<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    public function relation()
    {
        return $this->hasone('App\Models\people_relation');
    }
}
