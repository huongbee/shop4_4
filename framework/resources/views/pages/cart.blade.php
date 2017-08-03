@extends('layout')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Shopping Cart</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Home</a> / <span>Shopping Cart</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			@if($cart==null)
				<div>Chưa có sản phẩm trong giỏ hàng</div>
			@else
			<div class="table-responsive">
				<!-- Shop Products Table -->
				<table class="shop_table beta-shopping-cart-table" cellspacing="0">
					<thead>
						<tr>
							<th class="product-name">Product</th>
							<th class="product-price">Price</th>
							<th class="product-quantity">Qty.</th>
							<th class="product-subtotal">Total</th>
							<th class="product-remove">Remove</th>
						</tr>
					</thead>
					<tbody>
					
						@foreach($cart->items as $c)
						<tr class="cart_item">
							<td class="product-name">
								<div class="media">
									<img src="image/product/{{$c['item']['image']}}" width="80px">
									<div>
										<p class="font-large table-title">{{$c['item']['name']}}</p>
									</div>
								</div>
							</td>

							<td class="product-price">
								<span class="amount" id="dongia_{{$c['item']['id']}}" dongia="{{$c['item']['promotion_price']}}" >{{number_format($c['item']['promotion_price'])}} vnđ</span>
							</td>
							<td class="product-quantity">
								<select class=" form-control soluong" dataID="{{$c['item']['id']}}">
									@for($i=1; $i<=10; $i++)
									<option value="{{$i}}" @if($c['qty']==$i) selected @endif>{{$i}}</option>
									@endfor
								</select>
							</td>

							<td class="product-subtotal">
								<span class="amount" id="total_{{$c['item']['id']}}">{{number_format($c['price'])}} vnđ</span>
							</td>

							<td class="product-remove">
								<a href="{{route('delete_cart',$c['item']->id)}}" class="remove" title="Remove this item"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>

					
				</table>
				<!-- End of Shop Table Products -->
			</div>
					
			

			<!-- Cart Collaterals -->
			<div class="cart-collaterals">

				

				<div class="cart-totals pull-right">
					<div class="cart-totals-row"><span>Tổng cộng:</span> <span id="totalPrice" >{{number_format($cart->totalPrice)}} vnđ</span></div>
					<div class="cart-totals-row">
						<a href="{{route('checkout')}}"><button class="beta-btn primary" style="width: 100%">Đặt hàng</button></a>
					</div>
				</div>

				<div class="clearfix"></div>
			</div>
			@endif
			<!-- End of Cart Collaterals -->
			<div class="clearfix"></div>

		</div> <!-- #content -->
	</div> <!-- .container -->
<script src="assets/dest/js/jquery.js"></script>
<script>
	$(document).ready(function(){
		$('.soluong').change(function(){
			var soluong = $(this).val();
			var idSP = $(this).attr('dataID');

			var dongia = $('#dongia_'+idSP).attr('dongia')

			$.ajax({
				url:"{{route('edit_cart')}}",
				data:{
					idSP:idSP,
					soluong:soluong,
					_token:"{{csrf_token()}}"
				},
				type:"POST",
				success:function(data){
					$('#totalPrice').html(data)
					$('#tongtien').html(data); //cho giỏ hàng ở header
				},
				error:function(){
					console.log('err')
				}
			})

			// console.log(dongia)
			var total = soluong*dongia ;
			total = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			$('#total_'+idSP).html(total+' vnđ')


			$('#soluong_'+idSP).html(soluong)//cho giỏ hàng ở header
			




		});
	})
</script>
@endsection