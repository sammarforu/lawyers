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
				<h2 class="panel-title"><b>Add Wealth Statement</b></h2>
			</div>
		<div class="panel-body" id="myTable">
			@include('errors.validation')
			{!! Form::open(['url' => 'wealth-statement', 'class' => 'form-horizontal', 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
			<input type="hidden" name="created_id" id="created_id" value="{{Auth::User()->id}}">
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">ID#</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('voucher_no', null, ['id' => 'voucher_no','class'=>'form-control', 'autofocus'=>'autofocus']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">CLIENT NAME</label>
					<div class="col-sm-3"> 
						{!! Form::text('client_name', null, ['id' => 'client_name','class'=>'form-control']) !!} 
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
					<label class="col-sm-2 control-label">CNIC</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('cnic', null, ['id' => 'cnic','class'=>'form-control']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">INCOME</label>
					<div class="col-sm-3"> 
						{!! Form::text('income', null, ['id' => 'income','class'=>'form-control']) !!}
					</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">EXPENSE</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('expense', null, ['id' => 'expense','class'=>'form-control']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">CASH</label>
					<div class="col-sm-3"> 
						{!! Form::text('cash', null, ['id' => 'cash','class'=>'form-control']) !!} 
					</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">BANK BALANCE</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('bank_balance', null, ['id' => 'bank_balance','class'=>'form-control']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">GOLD</label>
					<div class="col-sm-3"> 
						{!! Form::text('gold', null, ['id' => 'gold','class'=>'form-control']) !!} 
					</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">PRIZE BOND</label>  
					<div class="col-sm-4"> 
						 {!! Form::text('prize_bond', null, ['id' => 'prize_bond','class'=>'form-control']) !!} 
						
					</div>
					<label class="col-sm-2 control-label">BIKE</label>
					<div class="col-sm-3"> 
						{!! Form::text('bike', null, ['id' => 'bike','class'=>'form-control']) !!} 
					</div> 							
					</div>
				</div>

				 <div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">ADD DETAIL</label>  
					<div class="col-sm-9"> 
						 <button type="button" onclick="AddRowFunction()" class="btn btn-success"><i class="fa fa-plus"></i> </button>
					</div>
					</div>
				</div>
				<div id="detail">

				</div>
				<!--<div class="row" id="myTable">
					 <div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-2 control-label">ADD DETAIL</label>  
					<div class="col-sm-8"> 
						 {!! Form::text('catagory_id', null, ['id' => 'catagory_id','class'=>'form-control']) !!} 
					</div>
					<div class="col-sm-1"> 
						<button onclick="javascript:myDeleteFunction($(this).closest('tr'));" class="btn btn-red" title="Delete Row" type="button"> <i class="icon-trash"></i> </button>
					</div>
					</div> 
				</div>-->
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

@section("scripts")
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script src="/js/plugins/nouislider/nouislider.min.js"></script>
<!-- Input Mask-->
<script src="/js/plugins/jasny/jasny-bootstrap.min.js"></script>
<!-- Select2-->
<script src="/js/plugins/select2/select2.full.min.js"></script>
<!--Bootstrap ColorPicker-->
<script src="/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!--Bootstrap DatePicker-->
<script src="/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
function AddRowFunction() {
	var html = '<div class="row">';
	html = html + '<tr>';
	html = html + '<div class="form-group" style="margin-left: 1%; margin-right: 1%;">'; 
	html = html + '<label class="col-sm-2 control-label">ADD DETAIL</label>';  
	html = html + '<div class="col-sm-8">'; 
	html = html + '<input type="text" id="detail" name="detail[]" class="form-control" placeholder="Car, Plot, House, Land, Files & Assets.">';
	html = html + '</div>';
	html = html + '<div class="col-sm-1">'; 
	html = html + '<button onclick="myDeleteFunction($(this).closest(\'tr\'));" class="btn btn-red" title="Delete Row" type="button"> <i class="icon-trash"></i> </button>';
	html = html + '</div>';
	html = html + '</div>';
	html = html + '</tr>';
	html = html + '</div>';
	$("#detail").append(html);
}

function myDeleteFunction(row) {
		if(confirm("Are you sure you want to delete this row?"))
		{
			$(row).remove();
		}
	}
</script>
@endsection