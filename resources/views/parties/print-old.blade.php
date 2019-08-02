@section("head")
@include("/include.config")
<?php	
	$que="select * from system_logos";
	$run=@mysql_query($que);

	$row=@mysql_fetch_array($run);
	$image = $row['image'];
?>


@stop
<body onload="window.print();">
		<div class="row">
			<div class="col-md-12">
				<!-- Card grid view -->
				<div class="cards-container box-view grid-view">
					<div class="row">						
						<div class="col-lg-12 col-sm-6 ">
						
							<!-- Card -->
							<div class="card">
							
								<!-- Card header -->
								<div class="card-header">
									<div class="card-short-description">
										<center><span class="user-name"><img src="/upload/logo/<?php echo $image;?>" style="height:100px; weight: 200px;"></span></center>
									</div>
								</div>
								<!-- /card header -->

								<!-- Card content -->
								<div class="card-content">
									<h3><strong>{{$company_detail[0]->system_name}}</strong></br></h3>
									<h5 style="margin-top:-15px;"><strong>Address : </strong>{{$company_detail[0]->address}}</br></h4>
									<h5 style="margin-top:-15px;"><strong>Email : </strong>{{$company_detail[0]->email}}</h5>
									<h5 style="margin-top:-15px;"><strong>Phone : </strong>{{$company_detail[0]->phone}}</h5>
									
								</div>
								
								<div class="card-content" style="float: right; margin-top: -135px; margin-right: 100px;">
									<h3><strong>Ledger</strong></h3>
									<h5 style="margin-top:-15px;"><strong>Customer Name : </strong>{{$party[0]->party_name}}</br></h5>
									<h5 style="margin-top:-15px;"><strong>Tel : </strong>{{$party[0]->phone}}</br></h5>
									<h5 style="margin-top:-15px;"><strong>City : </strong>{{$party[0]->city}}</br></h5>
								</div>
								<!-- /card content -->
							<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
									<thead>
										<tr>
											<th style="border: 1px solid;">No</th>
											<th style="border: 1px solid;">Description</th>
											<th style="border: 1px solid;">Quantity</th>
										
											<th style="border: 1px solid;">Sub Total</th>
										</tr>
									</thead>
									<tbody>
									<?php $sum = 1; $nettotal = 0; $totaldiscount = 0; $totaltax = 0; $total = 0; ?>
									@foreach ($party[0]->party as $parties)
										<tr class="gradeX">
											<td style="border: 1px solid;"><?php echo $sum; ?></td>
											<td style="border: 1px solid;">{{$parties->products->product_name}}</td>
											<td style="border: 1px solid;">{{$parties->quantity}}</td>
											
											<td style="border: 1px solid;">{{$parties->total_cost}}</td>
										</tr>
										<?php 
										$nettotal = $nettotal + $parties->total_cost;
										
										?>
										<?php $sum = $sum + 1; ?>
									
									@endforeach
										<tr class="gradeX">
											<center><td colspan="3" style="padding-left: 780px; border:1px solid;">Total</td></center>
											<td style="border:1px solid;"><?php echo $nettotal; ?></td>
										</tr>
									</tbody>
									</table>
								</div>
							</div>
							</div>
							<!-- /card -->	
						</div>
					</div>
				</div>
				<!-- /card grid view -->
			</div>
		</div>	</br>
<b style="float:right; margin-right: 0px;">Developed by <u style="color:blue;">www.stechsofts.com</u> | 0321 4197290</b>
</body>	