<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = 'bill_detail';


    public function Bills(){
    	return $this->belongsTo('App\Bills','id_bill','id');
    }

    public function Products(){
    	return $this->belongsTo('App\Products','id_product','id');
    }

}
