@extends("app")
@section("contents")
@include("/include.config")
<?php	
	$que="select * from system_logos";
	$run=@mysql_query($que);

	$row=@mysql_fetch_array($run);
	$image = $row['image'];
?>
<h1 class="page-title">General Settings</h1>
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="/dashboard"><i class="fa fa-home"></i>Home</a></li> 
				<li><a href="/parties">General Settings</a></li> 
				<li class="active"><strong>General Settings</strong></li> 
			</ol>
				<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h3 class="panel-title">System Logo</h3>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
								<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
							</ul>
						</div>
						@include('errors.validation')
						<div class="panel-body">
							{!! Form::open(['url' => 'settings', 'class' => 'form-horizontal' ,'files' => 'true', 'enctype' => 'multipart/form-data']) !!}	
								<div class="form-group"> 
									<label class="col-sm-2 control-label">Upload Image</label> 
									<div class="col-sm-10"> 
										<input type="file"  id="image" name="image" class="form-control">
									</div> 
								</div>
								<div class="line-dashed"></div>
								<center><div class="form-actions">
							  <button type="submit" name="logo" id="logo" value="logo" class="btn btn-primary">Add Image</button>
							</div></center>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h3 class="panel-title">General Settings</h3>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
								<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
							</ul>
						</div>

						<div class="panel-body">
							@include('errors.validation')
					{!! Form::open(['url' => 'settings', 'class' => 'form-horizontal' ]) !!}
								<div class="form-group"> 
									<label class="col-sm-3 control-label">System Name</label>  
									<div class="col-sm-5"> 
									{!! Form::text('system_name', null, ['id' => 'system_name','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">title</label>  
									<div class="col-sm-5"> 
									{!! Form::text('title', null, ['id' => 'title','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">address</label>  
									<div class="col-sm-5"> 
									{!! Form::text('address', null, ['id' => 'address','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">phone</label>  
									<div class="col-sm-5"> 
									{!! Form::text('phone', null, ['id' => 'phone','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Email</label>  
									<div class="col-sm-5"> 
									{!! Form::text('email', null, ['id' => 'email','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">currency</label>  
									<div class="col-sm-5"> 
									{!! Form::text('currency', null, ['id' => 'currency','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">city</label>  
									<div class="col-sm-5"> 
									{!! Form::text('city', null, ['id' => 'city','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">State</label>  
									<div class="col-sm-5"> 
									{!! Form::text('state', null, ['id' => 'state','class'=>'form-control',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Country</label>  
									<div class="col-sm-5"> 
									{!! Form::text('country', null, ['id' => 'country','class'=>'form-control',]) !!}
									</div> 
								</div>


							
								<div class="line-dashed"></div>
								<center><div class="form-actions">
							  <button type="submit" name="settings" id="settings" value="settings" class="btn btn-primary">Add Settings</button>
							</div></center>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
@stop