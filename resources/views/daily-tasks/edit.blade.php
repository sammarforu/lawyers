@extends("app")
@section("contents")
<h1 class="page-title">Edit Office</h1>
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="/dashboard"><i class="fa fa-home"></i>Home</a></li> 
				<li><a href="/catagories">Offices</a></li> 
				<li class="active"><strong>Edit Office</strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h3 class="panel-title">Edit Office</h3>
							<!-- <ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
								<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
							</ul> -->
						</div>
						<div class="panel-body">
							@include('errors.validation')
							{!! Form::model($edit, ['method' => 'PATCH', 'action' => ['DailyRoutineController@update', $edit->id], 'class' => 'form-horizontal', 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
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
						 {!! Form::select('catagori_id', $offices,  $edit->catagori_id, ['id' => 'catagori_id','class'=>'form-control']) !!} 
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
				<center><div class="form-actions">
			 			<button type="submit" class="btn btn-primary">Submit</button>
						</div>
				</center>		
					{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop