@extends("app")
@section("contents")
<!-- <center><h1 class="page-title" style="font-size:400%; color:white;"><b>{{$company_detail[0]->system_name}}</b></h1></center>
<center><h4 class="page-title" style="font-size:200%;"><b>{{$company_detail[0]->address}}</b></h4></center>
<center><h4 class="page-title" style="font-size:200%;"><b>{{$company_detail[0]->email}}</b></h4></center>
<center><h4 class="page-title" style="font-size:200%;"><b>{{$company_detail[0]->city}}</b></h4></center>
<center><h4 class="page-title" style="font-size:200%;"><b>{{$company_detail[0]->phone}}</b></h4></center>


<center><h4 class="page-title" style="font-size:200%;"><b>{{$company_detail[0]->state}}</b></h4></center>

<div>
<div class="col-sm-5">
</div>
<div class="col-sm-3">
</div>
<div class="col-sm-4">
	<h1 class="page-title" style="font-size:200%;"><b><a href="http://itlife.com.pk/" target="__blank" style="color:white;">IT Life</a></b></h1>
	<h4 class="page-title" style="font-size:100%; color:orange;"><b>Urooj Center, Near Farid Kot Road. Lahore.</b></h4>
<h4 class="page-title" style="font-size:100%; color:orange;"><b>0321 4197290</b></h4>
<h4 class="page-title" style="font-size:100%; color:orange;"><b>0423 7235275</b></h4>
<h4 class="page-title" style="font-size:100%; color:orange;"><b>info@itlife.com.pk</b></h4>
<h4 class="page-title" style="font-size:100%; color:orange;"><b><a href="http://itlife.com.pk/" target="__blank" style="color:blue;">www.itife.com.pk</a></b></h4>
</div>
</div> -->

<!--  <h1 class="page-title"><b>Dashboard</b></h1> -->
 <div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading no-border clearfix" id="subpanelbg"> 
				<center><h2 class="panel-title">Welcome {{Auth::user()->name}}</h2></center>	
			</div>
			
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading no-border clearfix" id="panelbg"> 
				<center><h2 class="panel-title">SALES STATUS</h2></center>
			</div> 
			<!-- panel body --> 
			<div class="panel-body">
				<ul class="list-item member-list">
					<li>	
						<div class="user-detail">
							<b>LOCAL SALES (RS)</b><span class="badge" style="float:right; color:#10ff00;">{{$sales}}</span>
						</div>
					</li>
					<li>
						<div class="user-detail">
							<b>GST SALES (RS)</b><span class="badge" style="float:right; color:#10ff00;">{{$Gstsales}}</span>
						</div>
					</li>
					<li>
						<div class="user-detail">
							<b>TOTAL SALES (RS)</b><span class="badge" style="float:right; color:#10ff00;">{{$sales+$Gstsales}}</span>
						</div>
					</li>
			
				</ul>
				
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading no-border clearfix" id="panelbg"> 
				<center><h2 class="panel-title">CHEQUE IN HAND</h2></center> 
			</div> 
			<!-- panel body --> 
			<div class="panel-body">
				<ul class="list-item member-list">
					<li>	
						<div class="user-detail">
							<a href="#"><b>ACCOUNT ACTIVITY LEDGER</b></a>
						</div>
					</li>
					<li>	
						<div class="user-detail">
							<a href="/sales-report/all-party/create"><b>SALE REPORT ALL PARTY</b></a>
						</div>
					</li>
					<li>	
						<div class="user-detail">
							<a href="/sales-report/single-party/create"><b>SALE REPORT PARTY WISE</b></a>
						</div>
					</li>
					<li>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading no-border clearfix" id="panelbg"> 
				<center><h2 class="panel-title">CUSTOMER & PRODUCT</h2></center> 
			</div> 
			<!-- panel body --> 
			<div class="panel-body">
				<ul class="list-group"> 
					<a href="/client-all-report"><li class="list-group-item"><span class="badge badge-primary"><i class="fa fa-hand-o-left" aria-hidden="true"></i></span><b>CUSTOMER LEDGER</b></li></a>
					<a href="#"><li class="list-group-item"><span class="badge badge-primary"><i class="fa fa-hand-o-left" aria-hidden="true"></i></span><b>CUSTOMER BALANCE</b></li></a> 
					<a href="#"><li class="list-group-item"><span class="badge badge-primary"><i class="fa fa-hand-o-left" aria-hidden="true"></i></span><b>PRODUCT LEDGER</b></li></a>
					<a href="#"><li class="list-group-item"><span class="badge badge-primary"><i class="fa fa-hand-o-left" aria-hidden="true"></i></span><b>ALL PRODUCT BALANCE</b></li></a>
					<a href="#"><li class="list-group-item"><span class="badge badge-primary"><i class="fa fa-hand-o-left" aria-hidden="true"></i></span><b>EXPENSE REPORT</b></li></a>
				</ul>
			</div>
		</div>
	</div>
</div></br></br>
<!-- <div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading no-border clearfix"> 
				<center><h2 class="panel-title">SALE STATUS</h2></center>	
			</div>
			
		</div>
	</div>
</div> -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix" id="panelbg">
				<center><h3 class="panel-title">SALE STATUS (RS)</h3></center>
				<!-- <ul class="panel-tool-options"> 
					<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
					<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
					<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
				</ul> -->
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead> 
							<tr> 
								<th>TITLE</th> 
								<?php $TotalCashSale =0; $TotalCreditSale =0; $TotalGstSale =0;?>
								@foreach($monthlyCashSale as $Month)
								<th>{{$Month->month}} {{$Month->year}}</th> 
								@endforeach
								<!-- <th>AUG 2019</th> 
								<th>SEP 2019</th> 
								<th>OCT 2019</th> 
								<th>NOV 2019</th> 
								<th>DEC 2019</th> 
								<th>JAN 2020</th> 
								<th>FAB 2020</th> 
								<th>MAR 2020</th> 
								<th>APR 2020</th> 
								<th>MAY 2020</th> 
								<th>JUN 2020</th>  -->
							</tr> 
						</thead> 
						<tbody> 
							<tr> 
								<th scope="row">LOCAL CASH SALES</th> 
								@foreach($monthlyCashSale as $sale)
								<td>{{$sale->total}}</td>
								<?php $TotalCashSale = $TotalCashSale +$sale->total;?> 
								@endforeach								 
							</tr> 
							<tr> 
								<th scope="row">LOCAL CREDIT SALES</th> 
								@foreach($monthlyCreditSale as $Creditsale)
								<td>{{$Creditsale->total}}</td>
								<?php $TotalCreditSale = $TotalCreditSale +$Creditsale->total;?> 
								@endforeach
							</tr> 
							<tr> 
								<th scope="row">GST SALES</th> 
								@foreach($GSTSales as $gstSale)
								<td>{{$gstSale->total}}</td>
								<?php $TotalGstSale = $TotalGstSale +$gstSale->total;?>
								@endforeach

							 </tr>
 
							 <tr id="subpanelbg"> 
								<th scope="row">GRAND TOTAL</th> 
								<td><b><?php echo $TotalCashSale+$TotalCreditSale+$TotalGstSale;?></b></td> 
								
							 </tr>
						</tbody> 
					</table>
				</div>
			</div>
		</div>
	</div>
</div></br></br>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix" id="panelbg">
				<center><h3 class="panel-title">DAY WISE STATUS (RS)</h3></center>
				<!-- <ul class="panel-tool-options"> 
					<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
					<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
					<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
				</ul> -->
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead> 
							<tr> 
								<th>TITLE</th> 
								@foreach($dailyCashSale as $dailyCashSales) 
								<td>{{date("d-m-Y", strtotime($dailyCashSales->date))}}

								</td> 
								@endforeach 
								<!-- <th>2019-06-15</th> 
								<th>2019-06-16</th> 
								<th>2019-06-17</th> 
								<th>2019-06-18</th> 
								<th>2019-06-19</th> 
								<th>2019-06-20</th>  -->
								 
							</tr> 
						</thead> 
						<tbody> 
							<tr> 
								<th scope="row">CASH SALES</th>
								@foreach($dailyCashSale as $dailyCashSales) 
								<td>{{$dailyCashSales->total}}</td> 
								@endforeach
								 
								 
							</tr> 
							<tr> 
								<th scope="row">CREDIT SALES LOCAL</th> 
								@foreach($dailyCreditSale as $dailyCreditSales)
								<td>{{$dailyCreditSales->total}}</td> 
								@endforeach
								 
							</tr> 
							<tr> 
								<th scope="row">GST SALES</th> 
								@foreach($dailyGSTSale as $dailyGSTSales)
								<td>{{$dailyGSTSales->total}}</td> 
								@endforeach 
							 </tr> 
							 <tr> 
								<th scope="row">CASH RECEIPTS</th> 
								@foreach($dailyCashReceipt as $dailyCashReceipts)
								<td>{{$dailyCashReceipts->credit}}</td> 
								@endforeach 
								
							 </tr>
							 <tr> 
								<th scope="row">BANK RECEIPTS</th> 
								@foreach($dailybankReceipt as $dailybankReceipts)
								<td>{{$dailybankReceipts->credit}}</td> 
								@endforeach
							 </tr>
							 <tr> 
								<th scope="row">POST DATED CHEQUE RECEIPT</th>
								@foreach($dailyPostDatedReceipt as $dailyPostDatedReceipts)
								<td>{{$dailyPostDatedReceipts->credit}}</td> 
								@endforeach 
							 </tr>
							 <tr> 
								<th scope="row">CASH PAYMENT</th> 
								@foreach($dailyCashPayment as $dailyCashPayments)
								<td>{{$dailyCashPayments->debit}}</td> 
								@endforeach
							 </tr>
							 <tr> 
								<th scope="row">BANK PAYMENT</th> 
								@foreach($dailyBankPayment as $dailyBankPayments)
								<td>{{$dailyBankPayments->debit}}</td> 
								@endforeach 
							 </tr>
							 <tr> 
								<th scope="row">EXPENSE PAID/CASH/BANK</th> 
								<td>123467</td> 
								<td>123467</td> 
								
							 </tr>
							<!--  <tr style="background: orange;"> 
								<th scope="row">GRAND TOTAL</th> 
								<td><b>123467</b></td> 
								<td><b>123467</b></td> 
								<td><b>123467</b></td> 
								<td><b>123467</b></td> 
								<td><b>123467</b></td> 
								<td><b>123467</b></td> 
								<td><b>123467</b></td> 
							 </tr> -->
						</tbody> 
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix" id="panelbg">
				<center><h3 class="panel-title">CASH FLOW (RS)</h3></center>
				<!-- <ul class="panel-tool-options"> 
					<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
					<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
					<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
				</ul> -->
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead> 
							<tr id="subpanelbg"> 
								<th><b>TITLE</b></th> 
								<th><b>TOTAL BALANCE(RS)</b></th> 
							</tr> 
						</thead> 
						<tbody> 
							@foreach($banks as $bank) 
							<tr> 
								<th scope="row">{{$bank->party_name}}</th> 
								<td>{{$bank->credit-$bank->debit}}</td> 
							</tr> 
							@endforeach
							
						</tbody> 
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!------------------Start tabs------------------------------->
 <!-- <div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading clearfix"> 
				<h3 class="panel-title">Product & Stock</h3> 
			</div> 
<div class="panel-body"> 
	<div class="bs-example">
	<a href="/delivery-challan"><button class="btn btn-danger" type="button">Delivery Clallan</button></a> 
		<a href="/delivery-challan/create"><button class="btn btn-danger" type="button">Add Delivery Clallan</button></a> 
		<a href="/grn"><button class="btn btn-warning" type="button">GRN's</button></a> 
		<a href="/grn/create"><button class="btn btn-warning" type="button">Add GRN</button></a>
		<a href="/products"><button class="btn btn-primary" type="button">Product</button></a> 
		<a href="/products/create"><button class="btn btn-primary" type="button">Add Product</button></a>
		<a href="/purchases"><button class="btn btn-blue" type="button">Purchases</button></a> 
		<a href="/purchases/create"><button class="btn btn-blue" type="button">Add Purchase</button></a> 
		<a href="/sales"><button class="btn btn-black" type="button">Sales</button></a> 
		<a href="/sales/create"><button class="btn btn-black" type="button">Add Sale</button></a>
		<a href="/salestax"><button class="btn btn-black" type="button">Sales Tax</button></a> 
		<a href="/salestax/create"><button class="btn btn-black" type="button">Add Sale Tax</button></a>  
		<a href="/suppliers"><button class="btn btn-danger" type="button">Suppliers/Vendors</button></a> 
		<a href="/suppliers/create"><button class="btn btn-danger" type="button">Add Suppliers</button></a> 
	</div>
</div> 
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading clearfix"> 
				<h3 class="panel-title">Finance & Accounts</h3> 
			</div> 
<div class="panel-body"> 
	<div class="bs-example"> 
		<a href="/ledger"><button class="btn btn-primary" type="button">Client Ledger</button></a> 
		<a href="/ledger/create"><button class="btn btn-primary" type="button">Add Client Ledger</button></a>
		<a href="/ledger/suppliers"><button class="btn btn-blue" type="button">Supplier Ledger</button></a> 
		<a href="/ledger/suppliers/create"><button class="btn btn-blue" type="button">Add Supplier Ledger</button></a> 
		<a href="/expenses/heads"><button class="btn btn-success" type="button">Expense Heads</button></a> 
		<a href="/expenses/heads/create"><button class="btn btn-success" type="button">Add Expense Head</button></a> 
		<a href="/expenses"><button class="btn btn-warning" type="button">Expenses</button></a> 
		<a href="/expenses/create"><button class="btn btn-warning" type="button">Add Expense</button></a>
		 
		  
	</div>
			</div> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix"> 
				<h3 class="panel-title">Vouchers</h3> 
			</div> 
			<div class="panel-body"> 
				<div class="bs-example"> 
					<a href="/parties"><button class="btn btn-black" type="button">Chart Of Account</button></a> 
					<a href="/parties/create"><button class="btn btn-black" type="button">Add Account</button></a> 
					<a href="/general-voucher"><button class="btn btn-success" type="button">General Voucher</button></a> 
					<a href="/general-voucher/create"><button class="btn btn-success" type="button">Add General Voucher</button></a>
					<a href="/bank-payments"><button class="btn btn-primary" type="button">Bank Payment</button></a> 
					<a href="/bank-payments/create"><button class="btn btn-primary" type="button">Add Bank Payment</button></a>
					<a href="/cash-receipts"><button class="btn btn-blue" type="button">Cash Receipt</button></a>
					<a href="/cash-receipts/create"><button class="btn btn-blue" type="button">Add Cash Receipt</button></a> 
					<a href="/cash-payments"><button class="btn btn-black" type="button">Cash Payment</button></a> 
					<a href="/cash-payments/create"><button class="btn btn-black" type="button">Add Cash Payment</button></a> 
					<a href="/cheque-payments"><button class="btn btn-danger" type="button">Cheque Payment</button></a>
					<a href="/cheque-payments/create"><button class="btn btn-danger" type="button">Add Cheque Payment</button></a>
					 <a href="/cash-book-report"><button class="btn btn-black" type="button">Cash Book Report</button></a>
					<a href="/#"><button class="btn btn-warning" type="button">Trail Balance</button></a>
					<a href="/client-all-report"><button class="btn btn-info" type="button">Client Report</button></a> 
					<a href="/profitloss"><button class="btn btn-success" type="button">Profit & Loss</button></a>

				</div>
			</div> 
		</div>
	</div>
		</div> -->
		<!------------------End tabs------------------------------->

		<!------------------Data------------------------------->
		<!-- <div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix"> 
						<div class="panel-title"><h4><b>Total Products</b></h4></div> 
					</div> 
					<div class="panel-body">
						<div class="stack-order"> 
							<h1 class="no-margins"><b>{{$product}}</b></h1>
						</div>
						<div class="bar-chart-icon"></div>
					</div> 
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix"> 
						<div class="panel-title"><h4><b>Total Parties</b></h4></div>  
					</div> 
					<div class="panel-body"> 
						<div class="stack-order">
							<h1 class="no-margins"><b>{{ $party }}</b></h1>
						</div>
						<div class="bar-chart-icon"></div>
					</div> 
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix"> 
						<div class="panel-title"><h4><b>Total Suppliers</b></h4></div> 
					</div> 
					<div class="panel-body"> 
						<div class="stack-order">
							<h1 class="no-margins"><b>{{ $supplier }}</b></h1>
						</div>
						<div class="bar-chart-icon"></div>
					</div> 
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix"> 
						<div class="panel-title"><h4><b>Total Users</b></h4></div> 
					</div> 
					<div class="panel-body"> 
						<div class="stack-order">
							<h1 class="no-margins"><b>{{ $user }}</b></h1>
						</div>
						<div class="bar-chart-icon"></div>
					</div> 
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix"> 
						<div class="panel-title"><h4><b>Today Purchase</b></h4></div> 
					</div>  
					<div class="panel-body">
						<div class="stack-order"> 
							<h1 class="no-margins"><b>{{$totalPurchase}}</b></h1>
						</div>
						<div class="bar-chart-icon"></div>
					</div> 
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix"> 
						<div class="panel-title"><h4><b>Today Sale</b></h4></div>  
					</div> 
					<div class="panel-body"> 
						<div class="stack-order">
							<h1 class="no-margins"><b>{{ $totalSale }}</b></h1>
						</div>
						<div class="bar-chart-icon"></div>
					</div> 
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix"> 
						<div class="panel-title"><h4><b>Total Purchase</b></h4></div> 
					</div> 
					<div class="panel-body"> 
						<div class="stack-order">
							<h1 class="no-margins"><b>{{(int)$purchases }}</b></h1>
						</div>
						<div class="bar-chart-icon"></div>
					</div> 
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix"> 
						<div class="panel-title"><h4><b>Total Sale</b></h4></div> 
					</div> 
					<div class="panel-body"> 
						<div class="stack-order">
							<h1 class="no-margins"><b>{{(int)$sales}}</b></h1>
						</div>
						<div class="bar-chart-icon"></div>
					</div> 
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix"> 
						<div class="panel-title"><h4><b>Gross Profit</b></h4></div> 
					</div> 
					<div class="panel-body">
						<div class="stack-order"> 
							<?php $GrossProfit = $sales - $purchases;?>
							<h1 class="no-margins"><b>{{$GrossProfit}}</b></h1>
						</div>
						<div class="bar-chart-icon"></div>
					</div> 
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix"> 
						<div class="panel-title"><h4><b>Expense</b></h4></div> 
					</div> 
					<div class="panel-body"> 
						<div class="stack-order">
							<h1 class="no-margins"><b>{{(int)$expenses}}</b></h1>
						</div>
						<div class="bar-chart-icon"></div>
					</div> 
				</div>
			</div>
			
			<div class="col-lg-3 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix"> 
						<div class="panel-title"><h4><b>Net Profit</b></h4></div>  
					</div> 
					<div class="panel-body"> 
						<div class="stack-order">
							<?php $NewProfit = $GrossProfit - $expenses;?>
							<h1 class="no-margins"><b>{{ $NewProfit }}</b></h1>
						</div>
						<div class="bar-chart-icon"></div>
					</div> 
				</div>
			</div>
			
			<div class="col-lg-3 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix"> 
						<div class="panel-title"><h4><b>Performance</b></h4></div> 
					</div> 
					<div class="panel-body"> 
						<div class="stack-order">
							<h1 class="no-margins"><b>{{ "Good" }}</b></h1>
						</div>
						<div class="bar-chart-icon"></div>
					</div> 
				</div>
			</div>
		</div> -->
@stop							