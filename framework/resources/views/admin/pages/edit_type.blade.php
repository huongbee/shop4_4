@extends('admin.layout')	
@section('content')
	<div class="panel panel-default">
        <div class="panel-heading"><b>Cập nhật loại SP {{$type->name}}</b>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="POST">
            	{{csrf_field()}}
			  <div class="form-group">
			    <label class="control-label col-sm-2">Tên Loại:</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" name="name"  value="{{$type->name}}">
			    </div>
			  </div>
			  <div class="form-group">
			  	<div class="control-label col-sm-2"></div>
			    <div class="col-sm-10">
			      	<img src="shopping/image/product/{{$type->image}}" width="250px">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="pwd">Mô tả:</label>
			    <div class="col-sm-10"> 
			      <textarea id="description" name="desc"></textarea>
			      <script>
			      	CKEDITOR.replace('description',{
						customConfig: 'configAdmin.js'
					})
			      </script>
			    </div>
			  </div>
			  <div class="form-group"> 
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-default">Lưu</button>
			    </div>
			  </div>
			</form>
        </div>
    </div>
@endsection