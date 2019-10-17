@extends("app")
@section("contents")
<h1 class="page-title">Edit PRA</h1>
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{url('/dashboard')}}"><i class="fa fa-home"></i>Home</a></li> 
				<li><a href="{{url('/pra')}}">PRA Management</a></li> 
				<li class="active"><strong>Edit PRA</strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h3 class="panel-title">Edit PRA</h3>
							<!-- <ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
								<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
							</ul> -->
						</div>
						<div class="panel-body">
							@include('errors.validation')
							{!! Form::model($edit, ['method' => 'PATCH', 'action' => ['PRAController@update', $edit->id], 'class' => 'form-horizontal', 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
								<input type="hidden" name="created_id" id="created_id" value="{{Auth::User()->id}}">
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">ID#</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('voucher_no', null, ['id' => 'voucher_no','class'=>'form-control', 'autofocus'=>'autofocus']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">FILE NO</label>
					<div class="col-sm-3"> 
						{!! Form::text('file_no', null, ['id' => 'file_no','class'=>'form-control']) !!} 
					</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">SELECT OFFICE</label>  
					<div class="col-sm-9"> 
						 {!! Form::select('catagory_id', $offices, $edit->catagory_id, ['id' => 'catagory_id','class'=>'form-control']) !!} 
					</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">CLIENT NAME</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('client_name', null, ['id' => 'client_name','class'=>'form-control']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">BUSINESS NAME</label>
					<div class="col-sm-3"> 
						{!! Form::text('business_name', null, ['id' => 'business_name','class'=>'form-control']) !!}
					</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">NTN</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('ntn', null, ['id' => 'ntn','class'=>'form-control']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">CNIC</label>
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
					<label class="col-sm-2 control-label">ELEC REFERENCE</label>
					<div class="col-sm-3"> 
						{!! Form::text('reference_no', null, ['id' => 'reference_no','class'=>'form-control']) !!} 
					</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">PRA ID</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('pra_id', null, ['id' => 'pra_id','class'=>'form-control']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">PRA PASSWORD</label>
					<div class="col-sm-3"> 
						{!! Form::text('pra_password', null, ['id' => 'pra_password','class'=>'form-control']) !!} 
					</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">PRA PIN</label>  
					<div class="col-sm-9"> 
						 {!! Form::text('pra_pin', null, ['id' => 'pra_pin','class'=>'form-control']) !!} 
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
	</div>
</div>
@stop