@extends("app")
@section("contents")
<!-- <body onload="AddRowFunction()"> -->
<body>
<div class="container-fluid">
@if (Session::has('flash_message'))
 	<div class="alert alert-success alert-dismissible fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-right: 4%;">&times;</a>
		<strong>Success!</strong> {{ Session::get('flash_message') }}
	</div>
@endif
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix" id="panelbg">
				<h2 class="panel-title"><b>Add NTN</b></h2>
			</div>
		<div class="panel-body">
			@include('errors.validation')
			{!! Form::open(['url' => 'ntn', 'class' => 'form-horizontal', 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
			<input type="hidden" name="created_id" id="created_id" value="{{Auth::User()->id}}">
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">ID#</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('voucher_no', null, ['id' => 'voucher_no','class'=>'form-control', 'autofocus'=>'autofocus']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">NTN</label>
					<div class="col-sm-3"> 
						{!! Form::text('ntn', null, ['id' => 'ntn','class'=>'form-control']) !!} 
					</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">SELECT OFFICE</label>  
					<div class="col-sm-9"> 
						 {!! Form::select('catagory_id', $offices, null, ['id' => 'catagory_id','class'=>'form-control']) !!} 
					</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">CLIENT NAME</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('client_name', null, ['id' => 'client_name','class'=>'form-control']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">CLIENT CNIC</label>
					<div class="col-sm-3"> 
						{!! Form::text('cnic', null, ['id' => 'cnic','class'=>'form-control']) !!}
					</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">CELL NO</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('cell_no', null, ['id' => 'cell_no','class'=>'form-control']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">TYPE</label>
					<div class="col-sm-3"> 
						{!! Form::select('business_name', array('BUSINESS' => 'BUSINESS', 'SALARY' => 'SALARY'), null, ['id' => 'cnic','class'=>'form-control']) !!} 
					</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">EMAIL</label>  
					<div class="col-sm-4"> 
						 {!! Form::email('email', null, ['id' => 'email','class'=>'form-control']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">PASSWORD</label>
					<div class="col-sm-3"> 
						{!! Form::text('password', null, ['id' => 'password','class'=>'form-control']) !!} 
					</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">IRIS ID</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('iris_id', null, ['id' => 'iris_id','class'=>'form-control']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">IRIS PASSWORD</label>
					<div class="col-sm-3"> 
						{!! Form::text('iris_password', null, ['id' => 'iris_password','class'=>'form-control']) !!} 
					</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">IRIS PIN</label>  
					<div class="col-sm-9"> 
						 {!! Form::text('iris_pin', null, ['id' => 'iris_pin','class'=>'form-control']) !!} 
					</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">Attachment</label>  
					<div class="col-sm-9"> 
						 <input type="file" name="attachment" id="attachment">
					</div>
					</div>
				</div>		 
	<center><div class="form-actions">
			  <button type="submit" class="btn btn-primary">Submit</button>
			</div></center>			
			{!! Form::close() !!}
</div>
</div>
</body>
@stop
