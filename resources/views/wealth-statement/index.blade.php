@extends("app")
@section("head")
<link href="/css/plugins/datatables/jquery.dataTables.css" rel="stylesheet">
<link href="/js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">
@stop
@section("contents")
			<div class="container-fluid">
				@if (Session::has('flash_message'))
					 <div class="alert alert-success alert-dismissible fade in">
			 			<a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-right: 4%;">&times;</a>
			 			<strong>Success!</strong> {{ Session::get('flash_message') }}
			  		</div>
				@endif
			</div>
			<div class="page-heading clearfix">
				<h1 class="page-title pull-left">Wealth Statement Management</h1><a href="{{url('wealth-statement/create')}}" class="btn btn-primary btn-sm btn-add" role="button">Add New</a>
			</div>
			<!--
			<div class="btn-group" style="float: right; margin-top: -32px;">
				<a href="parties/create" class="btn btn-primary btn-sm btn-add" role="button">Excel</a>
				<a href="parties/create" class="btn btn-primary btn-sm btn-add" role="button">PDF</a>
				<a href="parties/create" class="btn btn-primary btn-sm btn-add" role="button">Print</a>
		  </div>
		  --->
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="
				/dashboard"><i class="fa fa-home"></i>Home</a></li> 
				<!-- <li><a href="{{url('/catagories')}}">Office Management</a></li> -->
				<li class="active"><strong>Income Tax Management</strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h3 class="panel-title">{{$office[0]->catagory_name}}</h3>
							<!-- <ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
								<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
							</ul> -->
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
									<thead>
										<tr>
											<th>SERIAL#</th>
										    <th>ID</th>
											<!-- <th>DATE</th> -->
										    <th>CLIENT NAME</th>
										    <th>INCOME</th>
										    <th>EXPENSE</th>
										    <th>CNIC</th>
										    <th>ACTION</th>
										</tr>
									</thead>
									 <tbody>
						  <?php $sum = 1; ?>
						  @foreach($ntns as $ntn)

							<tr>
								<td><?php echo $sum; ?></td>
								<td class="center">{{$ntn->voucher_no}}</td>
								<!-- <td class="center">{{date("m/d/Y", Strtotime($ntn->task_date))}}</td> -->
								<td class="center">{{$ntn->client_name}}</td>
								<td class="center">{{$ntn->income}}</td>
								<td class="center">{{$ntn->expense}}</td>
								<td class="center">{{$ntn->cnic}}</td>
								
								
								<td class="size-80 text-center">
									<div class="dropdown">
										<a class="more-link" data-toggle="dropdown" href="#/"><i class="icon-dot-3 ellipsis-icon"></i></a>
										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="{{url('/wealth-statement/details/')}}/{{$ntn->id}}">DETAILS</a></li>
											<li><a href="{{url('/wealth-statement/')}}/{{$ntn->id}}/edit">EDIT</a></li>
											<li><a href="javascript:checkDelete({{ $ntn->id }}, '/wealth-statement/{{ $ntn->id }}/destroy', '/wealth-statement/{{$office[0]->id}}');">DELETE</a> </li>
										</ul>
									</div>
								</td>
							</tr>
							<?php $sum = $sum + 1;?>
						  @endforeach
						  </tbody>
									<tfoot>
										<tr>
											<th>SERIAL#</th>
										    <th>ID</th>
											<!-- <th>DATE</th> -->
										    <th>CLIENT NAME</th>
										    <th>INCOME</th>
										    <th>EXPENSE</th>
										    <th>CNIC</th>
										    <th>ACTION</th>
										    
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
@stop

@section("scripts")
<script src="/js/jquery.min.js"></script>
<!--<script src="/js/bootstrap.min.js"></script>
<script src="/js/plugins/metismenu/jquery.metisMenu.js"></script>
<script src="/js/plugins/blockui-master/jquery-ui.js"></script>
<script src="/js/plugins/blockui-master/jquery.blockUI.js"></script>
<script src="/js/functions.js"></script>
--->
<script src="/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="/js/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="/js/plugins/datatables/jszip.min.js"></script>
<script src="/js/plugins/datatables/pdfmake.min.js"></script>
<script src="/js/plugins/datatables/vfs_fonts.js"></script>
<script src="/js/plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="/js/plugins/datatables/extensions/Buttons/js/buttons.colVis.js"></script>
<script>
	$(document).ready(function () {
		$('.dataTables-example').DataTable({
			dom: '<"html5buttons" B>lTfgitp',
			buttons: [
				{
					extend: 'copyHtml5',
					exportOptions: {
						columns: [ 0, ':visible' ]
					}
				},
				{
					extend: 'excelHtml5',
					exportOptions: {
						columns: ':visible'
					}
				},
				{
					extend: 'pdfHtml5',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4 ]
					}
				},
				'colvis'
			]
		});
	});
</script>

@stop