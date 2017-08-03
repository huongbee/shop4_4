@extends('layout')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Checkout</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="index.html">Home</a> / <span>Checkout</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			@if(count($errors)>0)
				<div class="alert alert-danger">
					<ul>
					@foreach($errors->all() as $err)
						<li>{{$err}}</li>
					@endforeach
					</ul>
				</div>
			@endif
			@if(Session::has('thanhcong'))
				<div class="alert alert-success">{{Session::get('thanhcong')}}</div>
			@endif
			<form action="{{route('checkout')}}" method="post" class="beta-form-checkout">
				{{csrf_field()}}

				<div class="row">
					<div class="col-sm-6">
						<h4>Thông tin đặt hàng</h4>
						<div class="space20">&nbsp;</div>

						<div class="form-block">
							<label for="your_first_name">Họ tên*</label>
							<input type="text" name="fullname" required>
						</div>

						<div class="form-block">
							<label for="adress">Address*</label>
							<input type="text" name="address" required placeholder="90 Lê Thị Riêng, P.Bến Thành, Quận 1">
							
						</div>
						<div class="form-block">
							<label for="email">Email address*</label>
							<input type="email" name="email" required>
						</div>

						<div class="form-block">
							<label for="phone">Phone*</label>
							<input type="text" name="phone" required>
						</div>
						
						<div class="form-block">
							<label for="notes">Order notes</label>
							<textarea name="notes"></textarea>
							<script>
								CKEDITOR.replace('notes')
							</script>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="your-order">
							<div class="your-order-head"><h5>Giỏ hàng</h5></div>
							<div class="your-order-body">
									
								<div class="your-order-item">
									<div class="pull-left"><p class="your-order-f18">Total:</p></div>
									<div class="pull-right"><h5 class="color-black">@if(Session::has('cart')){{number_format($totalPrice)}} @else 0 @endif vnđ</h5></div>
								</div>
							</div>
							<div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
							
							<div class="your-order-body">
								<ul class="payment_methods methods">
									<li class="payment_method_bacs">
										<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
										<label for="payment_method_bacs">COD</label>
										<div class="payment_box payment_method_bacs" style="display: block;">
											Bạn gửi tiền vào tài khoản số :12345678, Hệ thống sẽ kiểm tra rồi ship hàng đến địa chỉ bạn cung cấp
										</div>						
									</li>

									<li class="payment_method_cheque">
										<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="Thanh toán trực tiếp" data-order_button_text="">
										<label for="payment_method_cheque">Thanh toán trực tiếp</label>
										<div class="payment_box payment_method_cheque" style="display: none;">
											Sau khi nhân viên giao hàng gửi hàng đến địa chỉ bạn cũng cấp, thì bạn gửi gửi tienf thanh toán lại cho nhân viên
										</div>						
									</li>
									
									<li class="payment_method_paypal">
										<input id="payment_method_paypal" type="radio" class="input-radio" name="payment_method" value="Đặt giữ hàng tại cửa hàng" data-order_button_text="Proceed to PayPal">
										<label for="payment_method_paypal">Đặt giữ hàng tại của hàng</label>
										<div class="payment_box payment_method_paypal" style="display: none;">
											Hệ thống sẽ giữ đơn hàng của bạn có giá trị trong suốt 12 giờ sau bạn xác nhận đơn hàng. Sau 12 giờ, nếu bạn không đến nhận hàng thì đơn hàng bị hủy
										</div>						
									</li>
								</ul>
							</div>

							<div class="text-center"><button type="submit" class="beta-btn primary">Checkout <i class="fa fa-chevron-right"></i></button></div>
						</div> <!-- .your-order -->
					</div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection