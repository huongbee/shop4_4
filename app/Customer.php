<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    //protected $timestamps = false;

    public function Bills(){
    	return $this->hasMany('App\Bills','id_customer','id');
    }

    public function BillDetail(){
    	return $this->hasManyThrough('App\BillDetail','App\Bills','id_customer','id_bill','id');

    	//model liên kết, model trung gian, khóa ngoại bảng trung gian, khóa ngoại bảng liên kết, khóa chính
    }


}
