<?php

namespace App;

use App\Establecimiento;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public function getRouteKeyName(){
        return 'slug';
    }

    public function establecimientos(){
        return $this->hasMany(Establecimiento::class);
    }
}
