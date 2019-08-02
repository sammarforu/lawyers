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
				<h1 class="page-title pull-left">Account Heads</h1><a href="account-head/create" class="btn btn-primary btn-sm btn-add" role="button">Add Account Head</a>
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
				<!-- <li><a href="/account-head">account-head</a></li>  -->
				<li class="active"><strong>Account Heads</strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h3 class="panel-title">Manage Account Heads</h3>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
								<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
									<thead>
										<tr>
											<th>Serial #</th>
										    <th>Account&nbsp;Head</th> 
										    <th>Title</th> 
											<th>Account&nbsp;No</th>
											<!-- <th>Ledger</th> -->
										    <th>Actions</th>
										</tr>
									</thead>
									 <tbody>
						  <?php $sum = 1; ?>
						  @foreach($heads as $head)

							<tr>
								<td><?php echo $sum; ?></td>
								<td class="center">{{$head->account_group}}</td>
								<td class="center">{{$head->title}}</td>
								<td class="center">{{$head->account_no}}</td>
								<!-- <td class="size-80 text-center">
									<div class="dropdown">
										<a href="/account-head/print/{{$head->id}}" target="__blank" style="color:white;">
										<button class="btn btn-info" type="button"> <i class="icon-print" title="Print Invoice"></i></button></a>
									</div>
								</td> -->
								<td class="size-80 text-center">
									<div class="dropdown">
										<a class="more-link" data-toggle="dropdown" href="#/"><i class="icon-dot-3 ellipsis-icon"></i></a>
										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="/account-head/{{$head->id}}/edit">Edit</a></li>
											<li><a href="javascript:checkDelete({{ $head->id }}, '/account-head/{{ $head->id }}/destroy', '/account-head');">Delete</a> </li>
										</ul>
									</div>
								</td>

							</tr>
							<?php $sum = $sum + 1;?>
						  @endforeach
						  </tbody>
									<tfoot>
										<tr>
											<th>Serial #</th>
											<th>Account&nbsp;Head</th> 
										    <th>Title</th> 
											<th>Account&nbsp;No</th>
											<!-- <th>Ledger</th> -->
										    <th>Actions</th>
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

