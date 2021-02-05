@extends('layout')
@section('content')
<section class="site-content">
    <div class="container">
        <div class="breadcum-area">
            <div class="breadcum-inner">
                <h3>@lang('website.Shopping cart')</h3>
                <ol class="breadcrumb">
                    
                    <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
                </ol>
            </div>
        </div>
        <div class="cart-area">
            <div class="row">
             	<?php 
					$price = 0;
				?>
				@if(count($result['cart']) > 0)
                     
                <div class="col-12 col-lg-8 cart-left">
                    <div class="row">
                         @if(session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                 {{ session()->get('message') }}
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>               
                        @endif
                    
                        <form method='POST' id="update_cart_form" action='{{ URL::to('/updateCart')}}' >
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th align="left">@lang('website.items')</th>
                                            <th align="right">@lang('website.Price')</th>
                                            <th align="right">@lang('website.Qty')</th>
                                            <th align="right">@lang('website.SubTotal')</th>
                                        </tr>
                                    </thead>
                                 
                                    @foreach( $result['cart'] as $products)
                                    <?php 
                                    $price+= $products->final_price * $products->customers_basket_quantity;		
                                    ?>
                                     
                                    <tbody>
                                        <tr>
                                            <td align="left" class="item">
                                                <input type="hidden" name="cart[]" value="{{$products->customers_basket_id}}">
                                                <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" class="cart-thumb">
                                                    <img class="img-fluid" src="{{asset('').$products->image}}" alt="{{$products->products_name}}" alt="">
                                                </a>
                                                <div class="cart-product-detail">
                                                    <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" class="title">
                                                        {{$products->products_name}} {{$products->model}}
                                                    </a>
                                                    @if(count($products->attributes) >0)
                                                        <ul>
                                                            @foreach($products->attributes as $attributes)
                                                                <li>{{$attributes->attribute_name}}<span>{{$attributes->attribute_value}}</span></li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            </td>
                                        
                                            <td align="right" class="price"><span>{{$web_setting[19]->value}}{{$products->final_price+0}}</span></td>
                                            <td align="right" class="Qty">
                                                <div class="input-group">
                                                  <span class="input-group-btn qtyminuscart">
                                                    	<i class="fa fa-minus" aria-hidden="true"></i>
                                                  </span>
                                                  <input name="quantity[]" type="text" readonly value="{{$products->customers_basket_quantity}}" class="form-control qty" min="{{$products->min_order}}" max="{{$products->max_order}}">                                                  
                                                  <span class="input-group-btn qtypluscart">
                                                  		<i class="fa fa-plus" aria-hidden="true"></i>
                                                  </span>
                                                </div>
                                            </td>
                                        
                                            <td align="right" class="subtotal"><span class="cart_price_{{$products->customers_basket_id}}">{{$web_setting[19]->value}}{{$products->final_price * $products->customers_basket_quantity}}</span>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td colspan="4" class="buttons">
                                                <a href="{{ URL::to('/editcart?id='.$products->customers_basket_id)}}" class="btn btn-sm btn-secondary">@lang('website.Edit')</a>
                                                <a href="{{ URL::to('/deleteCart?id='.$products->customers_basket_id)}}" class="btn btn-sm btn-secondary">@lang('website.Remove Item')</a>
                                            </td>
                                        </tr> 
                                    </tbody>            
                                    @endforeach
                                </table>
                            </div>
                        </form>
                    </div>
                        
                    <div class="row button">
                        <div class="col-12 col-sm-6">                
                            <div class="row">
                            	<a href="{{ URL::to('/shop')}}" class="btn btn-dark">@lang('website.Back To Shopping')</a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                        	<div class="row justify-content-end">
                            	<button class="btn btn-dark" id="update_cart">@lang('website.Update Cart')</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 cart-right">
                	<div class="order-summary-outer">
                    	<div class="order-summary">
                            <div class="table-responsive">
                                <table class="table">
                                	<thead>
                                    	<tr>
                                        	<th align="left" colspan="2">@lang('website.Order Summary') </th>
                                        </tr>
                                    </thead>
                                  	<tbody>
                                        <tr>
                                            <td align="left"><span>@lang('website.SubTotal')</span></td>
                                            <td align="right" id="subtotal">{{$web_setting[19]->value}}{{$price+0}}</td>
                                        </tr>
                                        

                                        <tr>
                                            <td align="left"><span>@lang('website.Discount(Coupon)')</span></td>
                                            <td align="right" id="discount">{{$web_setting[19]->value}}{{number_format((float)session('coupon_discount'), 2, '.', '')+0}}</td>
                                        </tr>
                                        <tr>
                                            <td class="last" align="left"><span>@lang('website.Total')</span></td>
                                            <td class="last" align="right" id="total_price">{{$web_setting[19]->value}}{{$price+0-number_format((float)session('coupon_discount'), 2, '.', '')}}</td>
                                        </tr>
                                	</tbody>
                                </table>
                            </div>
                        </div>                      
                        <div class="coupons">
                        	<!-- applied copuns -->
                            @if(count(session('coupon')) > 0 and !empty(session('coupon')))
                            	<div class="form-group"> 
                                    <label>@lang('website.Coupon Applied')</label>         
                                    @foreach(session('coupon') as $coupons_show)  
                                            
                                        <div class="alert alert-success">
                                            <a href="{{ URL::to('/removeCoupon/'.$coupons_show->coupans_id)}}" class="close"><span aria-hidden="true">&times;</span></a>
                                            {{$coupons_show->code}}
                                        </div>
                                        
                                    @endforeach
                                </div>         
                            @endif  
                            <form id="apply_coupon" class="form-validate">
                                <div class="form-group">
                                    <label >@lang('website.Coupon Code')</label>
                                    <input type="text" name="coupon_code" class="form-control" id="coupon_code">
                                    
                                    <div id="coupon_error" class="help-block" style="display: none"></div>
                                	<div id="coupon_require_error" class="help-block" style="display: none">@lang('website.Please enter a valid coupon code')</div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-dark">@lang('website.ApplyCoupon')</button>
                            </form>
                            
                            
                        </div>
                        
                        <div class="buttons">
                        	<a href="{{ URL::to('/checkout')}}" class="btn btn-block btn-secondary" >@lang('website.proceedToCheckout')</a>
                        </div>
                    </div>
                </div>
                
                @else
                
                <div class="col-xs-12 col-sm-12 page-empty">
                	<span class="fa fa-cart-arrow-down"></span>
                	<div class="page-empty-content">
                    	<span>@lang('website.cartEmptyText')</span>
                    </div>
                </div>
               @endif	
			</div>	
		</div>
	    <div class="related-product-area">
        <div class="heading">
            <h2>También compraron 
                <small class="pull-right"><a href="http://ecommercev2.sppflash.com.ar/shop?category_id=1">Ver todo</a></small>
            </h2>
            <hr>
        </div>
        <div class="row">
            <div class="products products-4x">            
                <div class="product">
                    <article>
                        <div class="thumb"><img class="img-fluid" src="http://ecommercev2.sppflash.com.ar/resources/assets/images/product_images/1502366462.pPOLO2-26090829_standard_v400.jpg" alt="FAIR ISLE HOODED SWEATER"></div>                                    
                            <span class="tag text-center">
                                Ropa de Hombre, Ropa de niña, Suéteres
                            </span>
                            <h2 class="title text-center">FAIR ISLE HOODED SWEATER</h2>                                            
                            <div class="price text-center">
                                $45
                            </div>
                            <div class="product-hover">
                            <div class="icons">
                                <div class="icon-liked">
                                    <span products_id="79" class="fa  fa-heart-o  is_liked"><span class="badge badge-secondary">4</span></span>
                                </div>
                                <a href="http://ecommercev2.sppflash.com.ar/product-detail/fair-isle-hooded-sweater" class="fa fa-eye"></a>
                            </div>
                            <div class="buttons">
                                <a class="btn btn-block btn-secondary" href="http://ecommercev2.sppflash.com.ar/product-detail/fair-isle-hooded-sweater">Ver Detalle</a>
                            </div>
                        </div>
                    </article>
                </div>         
                <div class="product">
                    <article>
                        <div class="thumb"><img class="img-fluid" src="http://ecommercev2.sppflash.com.ar/resources/assets/images/product_images/1502364697.pPOLO2-23643008_standard_v400.jpg" alt="COTTON CHINO BELTED SHIRTDRESS"></div>
                            <span class="discount-tag">57%</span>                                        
                            <span class="tag text-center">
                                Ropa de Hombre, Ropa de niña, 		                                			                                    			Camiseta Polo de Hombre, 		                                			                                    			Vestidos y mamelucos
                            </span>
                            <h2 class="title text-center">COTTON CHINO BELTED SHIRTDRESS</h2>                                            
                            <div class="price text-center">
                                $23.5
                                <span>$55</span> 
                            </div>                                    
                            <div class="product-hover">
                                <div class="icons">
                                    <div class="icon-liked">
                                        <span products_id="73" class="fa  fa-heart-o  is_liked"><span class="badge badge-secondary">5</span></span>
                                    </div>
                                    <a href="http://ecommercev2.sppflash.com.ar/product-detail/cotton-chino-belted-shirtdress" class="fa fa-eye"></a>
                                </div>
                                <div class="buttons">
                                    <button type="button" class="btn btn-block btn-secondary cart" products_id="73">Añadir al carrito</button>
                                </div>
                            </div>
                        </article>
                    </div>           
                    <div class="product">
                        <article>
                            <div class="thumb"><img class="img-fluid" src="http://ecommercev2.sppflash.com.ar/resources/assets/images/product_images/1502193710.pPOLO2-24128696_standard_v400.jpg" alt="POLO AVIATOR SUNGLASSES"></div>
                            <span class="tag text-center">
                                Ropa de Hombre, Gafas de sol y anteojos
                            </span>                                        
                            <h2 class="title text-center">POLO AVIATOR SUNGLASSES</h2>                                            
                            <div class="price text-center">
                                $229
                            </div>           
                            <div class="product-hover">
                                <div class="icons">
                                    <div class="icon-liked">
                                        <span products_id="23" class="fa  fa-heart-o  is_liked"><span class="badge badge-secondary">0</span></span>
                                    </div>
                                    <a href="http://ecommercev2.sppflash.com.ar/product-detail/polo-aviator-sunglasses" class="fa fa-eye"></a>
                                </div>
                                <div class="buttons">
                                    <button type="button" class="btn btn-block btn-secondary cart" products_id="23">Añadir al carrito</button>
                                </div>
                            </div>
                        </article>
                    </div>       
                    <div class="product">
                        <article>
                            <div class="thumb"><img class="img-fluid" src="http://ecommercev2.sppflash.com.ar/resources/assets/images/product_images/1502193577.pPOLO2-24933842_standard_v400.jpg" alt="POLO SQUARE SUNGLASSES"></div>                                    
                            <span class="tag text-center">
                                Ropa de Hombre, Gafas de sol y anteojos 		                                			                                        
                            </span>
                            <h2 class="title text-center">POLO SQUARE SUNGLASSES</h2>                                            
                            <div class="price text-center">
                                $129
                            </div>                                                                                
                            <div class="product-hover">
                                <div class="icons">
                                    <div class="icon-liked">
                                        <span products_id="22" class="fa  fa-heart-o  is_liked"><span class="badge badge-secondary">0</span></span>
                                    </div>
                                    <a href="http://ecommercev2.sppflash.com.ar/product-detail/polo-square-sunglasses" class="fa fa-eye"></a>
                                </div>                                            
                                <div class="buttons">
                                    <button type="button" class="btn btn-block btn-secondary cart" products_id="22">Añadir al carrito</button>
                                </div>
                            </div>
                        </article>
                    </div>            
                    <div class="product">
                        <article>
                            <div class="thumb"><img class="img-fluid" src="http://ecommercev2.sppflash.com.ar/resources/assets/images/product_images/1502193410.pPOLO2-19116009_standard_v400.jpg" alt="NAUTICAL-STRIPED SUNGLASSES"></div>                                   
                            <span class="tag text-center">
                                Ropa de Hombre, Gafas de sol y anteojos 		                                			                                        
                            </span>
                            <h2 class="title text-center">NAUTICAL-STRIPED SUNGLASSES</h2>                                            
                            <div class="price text-center">
                                $150
                            </div>   
                            <div class="product-hover">
                                <div class="icons">
                                    <div class="icon-liked">
                                        <span products_id="21" class="fa  fa-heart-o  is_liked"><span class="badge badge-secondary">0</span></span>
                                    </div>
                                    <a href="http://ecommercev2.sppflash.com.ar/product-detail/nautical-striped-sunglasses" class="fa fa-eye"></a>
                                </div>
                                <div class="buttons">    
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
	</div>
 </section>
		
@endsection 	


