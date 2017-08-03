<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    protected $table = 'bills';

    public function Customer(){
    	return $this->belongsTo('App\Customer','id_customer','id');
    }

    public function BillDetail(){
    	return $this->hasMany('App\BillDetail','id_bill','id');
    }


    public function Products(){
    	return $this->belongsToMany('App\Products','bill_detail','id_bill','id_product');

    	//model, bảng trung gian, khóa ngoại bảng hiện tại, khóa ngoại bảng liên kết tới
    }
}
