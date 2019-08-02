@extends("app")
@section("contents")
<h1 class="page-title">Edit Book</h1>
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="/dashboard"><i class="fa fa-home"></i>Home</a></li> 
				<li><a href="/products">Books</a></li> 
				<li class="active"><strong>Edit Book</strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h3 class="panel-title">Edit Book</h3>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
								<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
							@include('errors.validation')
							{!! Form::model($edit, ['method' => 'PATCH', 'action' => ['ProductController@update', $edit->id], 'class' => 'form-horizontal' ]) !!}
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Book Code</label>  
									<div class="col-sm-5"> 
									{!! Form::text('product_code', null, ['id' => 'product_code','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Book Name (Urdu)</label>  
									<div class="col-sm-5"> 
									{!! Form::text('product_name', null, ['id' => 'product_name','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Book Name (English)</label>  
									<div class="col-sm-5"> 
									{!! Form::text('product_english', null, ['id' => 'product_english','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Select Catagory</label>  
									<div class="col-sm-5"> 
									{!! Form::select('catagory_id', $catagories, null, ['id' => 'catagory_id','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Select Publisher</label>  
									<div class="col-sm-5"> 
									{!! Form::select('publisher_id', $publishers, null, ['id' => 'publisher_id','class'=>'form-control',]) !!}
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
									{!! Form::date('year', null, ['id' => 'year','class'=>'form-control',]) !!}
									</div> 
								</div>
							
								<div class="line-dashed"></div>
								<center><div class="form-actions">
							  <button type="submit" class="btn btn-primary">Update Book</button>
							</div></center>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
@stop