@extends("app")
@section("contents")
<h1 class="page-title">Edit Supplier</h1>
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="/dashboard"><i class="fa fa-home"></i>Home</a></li> 
				<li><a href="/supplier">Supplier</a></li> 
				<li class="active"><strong>Edit Supplier</strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h3 class="panel-title">Edit Supplier</h3>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
								<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
							@include('errors.validation')
							{!! Form::model($edit, ['method' => 'PATCH', 'action' => ['SupplierController@update', $edit->id], 'class' => 'form-horizontal' ]) !!}
																<div class="form-group"> 
									<label class="col-sm-3 control-label">Supplier Name</label>
									<div class="col-sm-5"> 
									{!! Form::text('name', null, ['id' => 'name','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Phone</label>  
									<div class="col-sm-5"> 
									{!! Form::text('phone', null, ['id' => 'phone','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">City</label>  
									<div class="col-sm-5"> 
									{!! Form::text('city', null, ['id' => 'city','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="line-dashed"></div>
								<center><div class="form-actions">
							  <button type="submit" class="btn btn-primary">Update Supplier</button>
							</div></center>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
@stop