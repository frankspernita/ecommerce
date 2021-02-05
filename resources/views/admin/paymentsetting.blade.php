@extends('admin.layout')
@section('content')
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>{{ trans('labels.PaymentSetting') }} <small>{{ trans('labels.PaymentSetting') }}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">{{ trans('labels.PaymentSetting') }}</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content"> 
    <!-- Info boxes --> 
    
    <!-- /.row -->
    <div class="row">
      <div class="col-md-12">
        
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{ trans('labels.PaymentSetting') }}</h3>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body">
              <div class="row">
                  <div class="col-xs-12">              		
                      @if (count($errors) > 0)
                          @if($errors->any())
                            <div class="alert alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              {{$errors->first()}}
                            </div>
                          @endif
                      @endif
                  </div>
                </div>
            <div class="row">
              <div class="col-xs-12">
              	  <div class="box box-info">
                        <!-- form start -->                        
                         <div class="box-body">
                            {!! Form::open(array('url' =>'admin/updatePaymentSetting', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
                            
                            <div class="form-group">
                           		<label for="shippingEnvironment" class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.PaymentMetods') }}</label>
                                <div class="col-sm-10 col-md-4">
                                    
                         
                                    
                                    <label class=" control-label">
                                          <input type="checkbox" name="cash_on_delivery" id="cash_on_delivery" value="1" class="checkboxess " @if($result['shipping_methods'][0]->cash_on_delivery==1) checked @endif > &nbsp;Mercado Pago{{-- trans('labels.CashOnDelivery') --}}
                                    </label><br>

                            
                                
                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.PaymentMetodsText') }}</span>
                                </div>
                            </div>
                            
                            <hr>                            
                            <h4>Mercado Pago (Datos del Usuario)</h4>
                            <hr>
                            {!! Form::hidden('cod_name',  $result['shipping_methods'][0]->cod_name , array('class'=>'form-control', 'id'=>'cod_name')) !!}
                            @foreach($result['cod_description'] as $description_data)
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Credenciales Mercado Pago <br>(Access token)</label>
                                  <div class="col-sm-10 col-md-4">
                                    <input type="text" name="cod_name_<?=$description_data['languages_id']?>" class="form-control cash_on_delivery @if($result["shipping_methods"][0]->cash_on_delivery==1) field-validate @endif" value="">
                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Para obtener sus credenciales debe acceder a su cuenta de mercado pago y dirigirse al sigiente enlace: <a href="https://www.mercadopago.com/mla/account/credentials">Tus Credenciales</a></span>          
                                    <span class="help-block hidden"> Para obtener sus credenciales debe acceder a su cuenta de mercado pago y dirigirse al sigiente enlace: <a href="https://www.mercadopago.com/mla/account/credentials">Tus Credenciales</a></span>
                                  </div>
                                </div>
                             
                            @endforeach
                           	
                            			
                            									
							<!-- /.box-body -->
							<div class="box-footer text-center">
								<button type="submit" class="btn btn-primary payment-checkbox">{{ trans('labels.Update') }} </button>
								<a href="{{ URL::to('admin/dashboard/this_month')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
							</div>
                              <!-- /.box-footer -->
                            {!! Form::close() !!}
                            
                          
                        </div>
                  </div>
              </div>
            </div>
            
          </div>
          	
          
          <!-- /.box-body --> 
        </div>
        <!-- /.box --> 
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
    
    <!-- Main row --> 
  </section>
  <!-- /.content --> 
</div>
@endsection 