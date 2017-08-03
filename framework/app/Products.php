<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    public function BillDetail(){
    	return $this->hasMany('App\BillDetail','id_product','id');
    }

    public function TypeProduct(){
    	return $this->belongsTo('App\TypeProduct','id_type','id');
    }

    public function Bills(){
    	return $this->belongsToMany('App\Bills','bill_detail','id_product','id_bill');

    	//model, bảng trung gian, khóa ngoại bảng hiện tại, khóa ngoại bảng liên kết tới
    }
}
