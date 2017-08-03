<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    protected $table = 'type_products';
    //protected $primaryKey = 'khoachinh';

    public function Products(){
    	return $this->hasMany('App\Products','id_type','id');
    }
}
