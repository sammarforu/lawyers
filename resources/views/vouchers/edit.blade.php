@extends("app")
@section("contents")
<h1 class="page-title">Edit Voucher</h1>
<ol class="breadcrumb breadcrumb-2"> 
	<li><a href="/dashboard"><i class="fa fa-home"></i>Home</a></li> 
	<li><a href="/Vouchers">Vouchers</a></li> 
	<li class="active"><strong>Edit Voucher</strong></li> 
</ol>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<h3 class="panel-title">Edit Voucher</h3>
				<ul class="panel-tool-options"> 
					<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
					<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
					<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
				</ul>
			</div>
			<div class="panel-body">
				@include('errors.validation')
				{!! Form::model($edit, ['method' => 'PATCH', 'action' => ['VouchersEditController@update', $edit->id], 'class' => 'form-horizontal' ]) !!}
					<div class="form-group"> 
						<label class="col-sm-3 control-label">Date</label>  
						<div class="col-sm-5"> 
						{!! Form::date('date', null, ['id' => 'date','class'=>'form-control',]) !!}
						</div> 
					</div>
					<div class="form-group"> 
						<label class="col-sm-3 control-label">Voucher&nbsp;No</label>  
						<div class="col-sm-5"> 
						{!! Form::text('voucher_no', null, ['id' => 'voucher_no','class'=>'form-control',]) !!}
						</div> 
					</div>
					<div class="form-group" style="display: none;"> 
						<label class="col-sm-3 control-label">Voucher&nbsp;Type</label>  
						<div class="col-sm-5"> 
						{!! Form::text('v_type', null, ['id' => 'v_type','class'=>'form-control',]) !!}
						</div> 
					</div>
					<div class="form-group"> 
						<label class="col-sm-3 control-label">Select&nbsp;Account</label>  
						<div class="col-sm-5"> 
							{!! Form::select('account_head_id', $parties, null, ['id' => 'account_head_id','class'=>'form-control livesearch']) !!}
						</div> 
					</div>
					<div class="form-group"> 
						<label class="col-sm-3 control-label">Narration</label>
						<div class="col-sm-5"> 
						{!! Form::text('narration', null, ['id' => 'narration','class'=>'form-control',]) !!}
						</div> 
					</div>
					<div class="form-group"> 
						<label class="col-sm-3 control-label">Debit</label>  
						<div class="col-sm-5"> 
						{!! Form::text('debit', null, ['id' => 'debit','class'=>'form-control',]) !!}
						</div> 
					</div>
					<div class="form-group"> 
						<label class="col-sm-3 control-label">Credit</label>  
						<div class="col-sm-5"> 
						{!! Form::text('credit', null, ['id' => 'credit','class'=>'form-control',]) !!}
						</div> 
					</div>
					<div class="line-dashed"></div>
					<center><div class="form-actions">
				  <button type="submit" class="btn btn-primary">Update Voucher</button>
				</div></center>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop