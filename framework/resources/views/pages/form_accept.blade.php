@extends('layout')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng nhập</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="index.html">Home</a> / <span>Đăng nhập</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			@if(Session::has('thanhcong'))
				<div class="alert alert-success">{{Session::get('thanhcong')}}</div>
			@endif
			@if(Session::has('error'))
				<div class="alert alert-danger">{{Session::get('error')}}</div>
			@endif

			<form action="{{route('accept_cart',$id_bill)}}" method="post" class="beta-form-checkout">
				{{csrf_field()}}
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4>Xác nhận đơn hàng DH00{{$id_bill}}</h4>
						<div class="space20">&nbsp;</div>

						
						<div class="form-block">
							<label for="email">Nhập mã xác nhận (*)</label>
							<input type="text" name="maxacnhan" required minlength="6" maxlength="6">
						</div>
						
						<div class="form-block">
							<button type="submit" class="btn btn-primary">Xác nhận</button>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection