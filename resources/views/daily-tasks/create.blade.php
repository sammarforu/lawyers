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
				<h2 class="panel-title"><b>Add Daily Task</b></h2>
			</div>
		<div class="panel-body">
			@include('errors.validation')
			{!! Form::open(['url' => 'daily-tasks', 'class' => 'form-horizontal', 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
			<input type="hidden" name="created_id" id="created_id" value="{{Auth::User()->id}}">
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">ID#</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('voucher_no', null, ['id' => 'voucher_no','class'=>'form-control', 'autofocus'=>'autofocus']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">Date</label>
					<div class="col-sm-3"> 
						<input id="task_date" type="date" name="task_date" value="<?php echo date('Y-m-d');?>" class="form-control"> 
					</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">Select Office</label>  
					<div class="col-sm-9"> 
						 {!! Form::select('catagori_id', $offices, null, ['id' => 'catagori_id','class'=>'form-control']) !!} 
					</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">Client Name</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('client_name', null, ['id' => 'client_name','class'=>'form-control']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">Business Name</label>
					<div class="col-sm-3"> 
						{!! Form::text('business_name', null, ['id' => 'business_name','class'=>'form-control']) !!} 
					</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">Cell No</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('cell_no', null, ['id' => 'cell_no','class'=>'form-control']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">Client CNIC</label>
					<div class="col-sm-3"> 
						{!! Form::text('cnic', null, ['id' => 'cnic','class'=>'form-control']) !!} 
					</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">Metter</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('metter', null, ['id' => 'metter','class'=>'form-control']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">Status</label>
					<div class="col-sm-3"> 
						{!! Form::select('status',array('PENDING' => 'PENDING', 'DONE' => 'DONE', 'NOT CLEAR' => 'NOT CLEAR'), null, ['id' => 'status','class'=>'form-control']) !!} 
					</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">Task</label>  
					<div class="col-sm-9"> 
						 {!! Form::textarea('task', null, ['id' => 'task','class'=>'form-control']) !!} 
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
				<!-- <div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
						<label class="col-sm-1 control-label">LC.NO</label>
						<div class="col-sm-2"> 
							{!! Form::text('lc_no', null, ['id' => 'lc_no',  'class'=>'form-control', 'required' => 'required']) !!} 
						</div>  
						<div class="col-sm-2">
							{!! Form::text('indentor_no', null, ['id' => 'indentor_no','class'=>'form-control', 'placeholder' => 'Indentor No']) !!}
						</div> 
						<div class="col-sm-2">
						</div>
						 <label class="col-sm-1 control-label">Address</label> 
						<div class="col-sm-4">
							{!! Form::text('address', null, ['id' => 'address','class'=>'form-control', 'placeholder' => 'Address', 'disabled' => 'disabled']) !!} 
						</div>							
					</div>
				</div> -->
				
				
				
				 
	<center><div class="form-actions">
			  <button type="submit" class="btn btn-primary">Submit</button>
			</div></center>			
			{!! Form::close() !!}
</div>
</div>
</body>
@stop
