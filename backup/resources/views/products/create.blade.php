@extends("app")
@section("contents")
<h1 class="page-title">Add Product</h1>
<div class="container-fluid">
				@if (Session::has('flash_message'))
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="margin-right: 20px;margin-top: 15px;">&times;</button>
					<div class="alert alert-success"> {{ Session::get('flash_message') }} </div>
				@endif
			</div>
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="/dashboard"><i class="fa fa-home"></i>Home</a></li> 
				<li><a href="/products">Products</a></li> 
				<li class="active"><strong>Add Product</strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h3 class="panel-title">Add Product</h3>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
								<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
							@include('errors.validation')
							{!! Form::open(['url' => 'products', 'class' => 'form-horizontal' ]) !!}
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Product Code</label>  
									<div class="col-sm-5"> 
									{!! Form::text('product_code', $code->last()->id, ['id' => 'product_code','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Product Name (Urdu)</label>  
									<div class="col-sm-5"> 
									{!! Form::text('product_name', null, ['id' => 'product_name','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Product Name (English)</label>  
									<div class="col-sm-5"> 
									{!! Form::text('product_english', null, ['id' => 'product_english','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Product Author</label>  
									<div class="col-sm-5"> 
									{!! Form::text('author', null, ['id' => 'author','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Select Catagory</label>  
									<div class="col-sm-5"> 
									{!! Form::select('catagory_id', $catagories, null, ['id' => 'catagory_id','class'=>'form-control livesearch']) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Select Publisher</label>  
									<div class="col-sm-5"> 
									{!! Form::select('publisher_id', $publishers, null, ['id' => 'publisher_id','class'=>'form-control livesearch']) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Purchase Price</label>  
									<div class="col-sm-5"> 
									{!! Form::text('product_cost', null, ['id' => 'product_cost','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Sale Price</label>
									<div class="col-sm-5"> 
									{!! Form::text('product_price', null, ['id' => 'product_price','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Year</label>
									<div class="col-sm-5"> 
									{!! Form::text('year', null, ['id' => 'year','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="line-dashed"></div>
								<center><div class="form-actions">
							  <button type="submit" class="btn btn-primary">Save Product</button>
							</div></center>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
@stop