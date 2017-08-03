@extends('layout')
@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">{{$product->name}}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Home</a> / <span>Product</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">

					<div class="row">
						<div class="col-sm-4">
							<img src="image/product/{{$product->image}}" alt="">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title">{{$product->name}}</p>
								<p class="single-item-price">
									@if($product->unit_price>$product->promotion_price)
										<span class="flash-del">{{$product->unit_price}} VNĐ</span>
										<span class="flash-sale">{{$product->promotion_price}} VNĐ</span>
									@else
										<span class="flash-sale">{{$product->promotion_price}} VNĐ</span>
									@endif
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p>{{$product->description}}</p>
							</div>
							<div class="space20">&nbsp;</div>

							<p>Options:</p>
							<div class="single-item-options">
								
								<select class="wc-select" name="color">
									<option>Qty</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i></a>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Mô tả</a></li>
							<li><a href="#tab-reviews">Bình luận (0)</a></li>
						</ul>

						<div class="panel" id="tab-description">
							<p>{{$product->description}}</p>
						</div>
						<div class="panel" id="tab-reviews">
							<p>No Reviews</p>
						</div>
					</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
						<h4>Sản phẩm cũng loại</h4>

						<div class="row">
							@foreach($related_product as $new)
							<div class="col-sm-4">
								<div class="single-item">
										@if($new->unit_price>$new->promotion_price)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
										<div class="single-item-header">
											<a href="product.html"><img src="image/product/{{$new->image}}" alt="" style="height: 250px"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$new->name}}</p>
											<p class="single-item-price">
											@if($new->unit_price>$new->promotion_price)
												<span class="flash-del">{{$new->unit_price}} VNĐ</span>
												<span class="flash-sale">{{$new->promotion_price}} VNĐ</span>
											@else
												<span class="flash-sale">{{$new->promotion_price}} VNĐ</span>
											@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
							</div>
							@endforeach
						</div>
						<div class="row">{{$related_product->links()}}</div>
					</div> <!-- .beta-products-list -->
				</div>
				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Bán chạy</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
							@foreach($best_seller as $bs)
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="image/product/{{$bs->image}}" alt=""></a>
									<div class="media-body">
										{{$bs->name}}
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
							@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
					<div class="widget">
						<h3 class="widget-title">New Products</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/1.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/2.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/3.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/4.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection