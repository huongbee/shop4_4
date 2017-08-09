@extends('admin.layout')	
@section('content')
	<div class="panel panel-default">
        <div class="panel-heading"><b>Cập nhật loại SP {{$type->name}}</b>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{route('edit_loaisp',$type->id)}}">
            	{{csrf_field()}}
			  <div class="form-group">
			    <label class="control-label col-sm-2">Tên Loại:</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" name="name"  value="{{$type->name}}">
			    </div>
			  </div>
			  <div class="form-group">
			  	<div class="control-label col-sm-2"></div>
			    <div class="col-sm-6">
			      	<img src="shopping/image/product/{{$type->image}}" id="thumbnil" width="250px">
			    </div>
			  </div>
			  <div class="form-group">
			  	<div class="control-label col-sm-2">Chọn hình:</div>			    
			    <div class="col-sm-4">
			      	<input type="file" name="hinh" accept="image/*"  onchange="showMyImage(this)">			    
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="pwd">Mô tả:</label>
			    <div class="col-sm-10"> 
			      <textarea id="description" name="desc">
			      	{{$type->description}}
			      </textarea>
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

<script>
	function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById("thumbnil");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }
</script>

@endsection


