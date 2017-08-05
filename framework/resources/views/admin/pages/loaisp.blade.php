@extends('admin.layout')	
@section('content')
	<div class="panel panel-default">
        <div class="panel-heading"><b>Danh sách loại SP</b>
        </div>
        <div class="panel-body">
             <table class="table table-hover">
		    <thead>
		      <tr>
		        <th>STT</th>
		        <th>Tên Loại</th>
		        <th width="35%">Mô tả</th>
		        <th>Hình</th>
		        <th>Danh sách sp</th>
		        <th>#</th>
		      </tr>
		    </thead>
		    <tbody>
		    <?php $stt = 1;?>
		    @foreach($listType as $type)
		      <tr>
		        <td>{{$stt}}</td>
		        <td>{{$type->name}}</td>
		        <td width="35%">{{$type->description}}</td>
		        <td><img src="shopping/image/product/{{$type->image}}" width="150px"></td>
		        <td><a href=""><button class="btn  btn-success">Xem danh sách sp</button></a></td>
		        <td>
		        	<a href="{{route('edit_loaisp',$type->id)}}">
		        		<i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
		        	</a>
		        	<i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
		        </td>
		      </tr>
		      <?php $stt++;?>
		    @endforeach
		    </tbody>
		  </table>
        </div>
    </div>
@endsection