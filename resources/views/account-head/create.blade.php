@extends("app")
@section("contents")
<div class="container-fluid">
	@if (Session::has('flash_message'))
	<div class="alert alert-success alert-dismissible fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-right: 4%;">&times;</a>
		<strong>Success!</strong> {{ Session::get('flash_message') }}
		</div>
		@endif
</div>
<h1 class="page-title">Add Account Head</h1>
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="/dashboard"><i class="fa fa-home"></i>Home</a></li> 
				<li><a href="/account-head">Account Heads</a></li> 
				<li class="active"><strong>Account Head</strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h3 class="panel-title">Add Account Head</h3>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
								<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
							@include('errors.validation')
							{!! Form::open(['url' => 'account-head', 'class' => 'form-horizontal' ]) !!}
							<div class="form-group"> 
									<label class="col-sm-3 control-label">Account Group</label>  
									<div class="col-sm-5"> 
									{!! Form::select('account_group', array('Fixed Assets'=> 'Fixed Assets', 'Furniture' => 'Furniture', 'Capital' => 'Capital', 'Cash' => 'Cash', 'Current Assets' => 'Current Assets', 'Debtors' => 'Debtors', 'Creditors' => 'Creditors'), null, ['id' => 'account_group','class'=>'form-control livesearch',]) !!}
									</div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Title</label>  
									<div class="col-sm-5"> 
									{!! Form::text('title', null, ['id' => 'title','class'=>'form-control',]) !!}
									</div> 
								</div>
								
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Account No</label>
									<div class="col-sm-5"> 
									{!! Form::text('account_no', null, ['id' => 'account_no','class'=>'form-control',]) !!}
									</div> 
								</div>
							
								<div class="line-dashed"></div>
								<center><div class="form-actions">
							  <button type="submit" class="btn btn-primary">Save</button>
							</div></center>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
@stop