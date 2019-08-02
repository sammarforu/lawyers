	<nav class="navbar navbar-default" style="margin-bottom: 0px; background-color:#ffffff;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/dashboard" style="font-family: cursive;"><?php echo $quee["system_name"];?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!-- <li class="active" style="font-family: monospace;"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li style="font-family: monospace;"><a href="#">Sammar</a></li> -->


<!------------Starting Dropdown------------------------->

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="font-family: monospace;">CODE <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <!-- <li><a href="#">Action</a></li> -->
            <li class="dropdown">
                <a href="#">ACCOUNT CODE <span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="/parties">ADD CHART OF ACCOUNT</a></li>
                  <li><a href="#">ADD ACCOUNT BUDGET PLAN</a></li>
                  <li class="divider"></li>
                  <li><a href="#">ADD PURCHASE PARTY CODE</a></li>
                  <li><a href="#">ADD SALE PARTY CODE</a></li>
                  <li><a href="#">APPROVE VOUCHERS</a></li>
                  <li class="divider"></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#">STORE CODING <span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="#">ADD DEPARTMENT NAME</a></li>
                  <li class="divider"></li>
                  <li><a href="/catagories">ADD ITEM HEAD</a></li>
                  <li><a href="/account-group">ADD ACCOUNT GROUP</a></li>
                  <!-- <li><a href="#">ADD SUB HEAD CODE</a></li> -->
                  <li><a href="/expenses/heads">ADD EXPENSE HEAD</a></li>
                  <li><a href="/products">ADD STORE ITEM</a></li>
                  <!-- <li class="dropdown">
                    <a href="#">Another dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                      <li class="divider"></li>
                      <li><a href="#">One more separated link</a></li>
                    </ul>
                  </li> -->
                </ul>
              </li>
            <li role="separator" class="divider"></li>
            <li><a href="#">CHANGE PASSWORD</a></li>
            <li role="separator" class="divider"></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="font-family: monospace;">TRANSCTION <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class="dropdown">
                <a href="#">ACCOUNT VOUCHERS <span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="/general-voucher/create">JOURNAL VOUCHER</a></li>
                  <li><a href="/cash-receipts/create">CASH RECEIPT VOUCHER [CREDIT]</a></li>
                  <li><a href="/cash-payments/create">CASH PAYMENT VOUCHER [DEBIT]</a></li>
                  <li class="divider"></li>
                  <!-- <li><a href="#">BANK RECEIPT VOUCHER</a></li> -->
                  <li><a href="/bank-receipts/create">BANK RECEIPT VOUCHER [BD]</a></li>
                  <li><a href="/bank-payments/create">BANK PAYMENT VOUCHER [BP]</a></li>
                  <li><a href="/expenses">Expenses</a></li>
                  <li class="divider"></li>
                  <!-- <li><a href="#">One more separated link</a></li> -->
                </ul>
              </li>
              <li class="dropdown">
                <a href="#">STORE TRANSCTION <span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="#">PURCHASE REQUISTION</a></li>
                  <li><a href="#">PURCHASE ORDER</a></li>
                  <li><a href="#">INWARD GATEPASS</a></li>
                  <li><a href="/grn">GOODS RECEIPT NOTE</a></li>
                  <li><a href="/sales">SAMPLES ISSUE NOTE</a></li>
                  <!-- <li class="dropdown">
                    <a href="#">Another dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                      <li class="divider"></li>
                      <li><a href="#">One more separated link</a></li>
                    </ul>
                  </li> -->
                  <li class="divider"></li>
                  <li><a href="/purchase-return">PURCHASE RETURN</a></li>
                  <li class="divider"></li>
                  <li><a href="#">SAMPLE RETURN</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#">PRODUCTION <span class="caret"></span></a>
                <!-- <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="#">PURCHASE REQUISTION</a></li>
                  <li><a href="#">PURCHASE ORDER</a></li>
                  <li><a href="#">INWARD GATEPASS</a></li>
                  <li><a href="#">GOODS RECEIPT NOTE</a></li>
                  <li><a href="#">SAMPLES ISSUE NOTE</a></li>
                  <li class="divider"></li>
                  <li><a href="#">PURCHASE RETURN</a></li>
                  <li class="divider"></li>
                  <li><a href="#">SAMPLE RETURN</a></li>
                </ul> -->
              </li>
            <li role="separator" class="divider"></li>
                <li class="dropdown">
                <a href="#">SALE/PURCHASE TRANS<span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="/purchases">PURCHASE BILL</a></li>
                  <li><a href="/purchases">PURCHASE INVOICE(TAX)</a></li>
                  <li><a href="#">DEBIT NOTE(Purhase Return)</a></li>
                  <li class="divider"></li>
                  <li><a href="/delivery-challan">DELIVERY CHALLAN</a></li>
                  <li><a href="/sales">SALE BILL</a></li>
                  <li><a href="/salestax">SALES INVOICE</a></li>
                  <li><a href="#">CREDIT NOTE(SALE RETURN)</a></li>
                  <li><a href="/sales-return">RETURN SALE BILL</a></li>
                  <!-- <li class="dropdown">
                    <a href="#">Another dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                      <li class="divider"></li>
                      <li><a href="#">One more separated link</a></li>
                    </ul>
                  </li> -->
                </ul>
              </li>
          </ul>
        </li>
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="font-family: monospace;">EDIT/DELETE<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class="dropdown">
                <a href="#">EDIT/DELETE ACC TRANS<span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="/purchases">EDIT/DELETE PURCHASE PARTY CODE</a></li>
                  <li><a href="/sales">EDIT/DELETE SALE PARTY CODE</a></li>
                  <li class="divider"></li>
                  <li><a href="/vouchers">EDIT/DELETE ACCOUNT VOUCHER</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#">EDIT/DELETE STORE TRANS<span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="/parties">EDIT/DELETE MAIN HEAD CODE</a></li>
                  <li><a href="#">EDIT/DELETE SUBHEAD CODE</a></li>
                  <li><a href="/products">EDIT/DELETE STORE ITEM CODE</a></li>
                  <li class="divider"></li>
                  <li><a href="#">EDIT/DELETE INWARD GATEPASS</a></li>
                  <li><a href="#">EDIT/DELETE PURCHASE REQUISTION</a></li>
                  <li><a href="/grn">EDIT/DELETE GOODS RECEIPT NOTE</a></li>
                  <li><a href="#">EDIT/DELETE ISSUE SAMPLES</a></li>
                  <li class="divider"></li>
                  <li><a href="#">EDIT/DELETE PURCHASE RETURN</a></li>
                  <li><a href="#">EDIT/DELETE RETURN SAMPLES BACK</a></li>

                </ul>
              </li>
              <li class="dropdown">
                <a href="#">EDIT/DELETE SALE TRANS<span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="#">EDIT/DELETE ITEM CODE</a></li>
                  <li><a href="#">EDIT/DELETE PURCHASE INVOICE(TAX)</a></li>
                  <li><a href="#">EDIT/DELETE PURCHASE BILL</a></li>
                  <li><a href="#">EDIT/DELETE DELIVERY CHALLAN</a></li>
                  <li><a href="#">EDIT/DELETE SALE BILL</a></li>
                  <li><a href="#">EDIT/DELETE SALES TAX INVOICE</a></li>
                  <li><a href="#">EDIT/DELETE RETURN SALE BILL</a></li>
                  <li class="divider"></li>
                  <li><a href="#">EDIT/DELETE DEBIT NOTE(Purchase Return)</a></li>
                  <li><a href="#">EDIT/DELETE CREDIT NOTE(Sale Return)</a></li>
                </ul>
              </li>
              <!-- <li class="dropdown">
                <a href="#">Another dropdown 2 <span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li class="dropdown">
                    <a href="#">Another dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                      <li class="divider"></li>
                      <li><a href="#">One more separated link</a></li>
                    </ul>
                  </li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                  <li class="divider"></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li> -->
          </ul>
        </li>
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="font-family: monospace;">REPORT <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class="dropdown">
                <a href="#">ACCOUNT REPORTS <span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="/cash-book-report">DAILY BOOK</a></li>
                  <li><a href="/cash-book-report">DAILY CASH & BANK BALANCE</a></li>
                  <li><a href="#">PRINT VOUCHERS</a></li>
                  <li class="divider"></li>
                  <li><a href="/parties">CHART OF ACCOUNT</a></li>
                  <li><a href="/general-voucher">JOURNAL REGISTER</a></li>
                  <li><a href="/client-all-report">ACCOUNT LEDGER</a></li>
                  <li><a href="#">LEDGER MULTIPLE ACCOUNTS</a></li>
                  <li><a href="#">CASH BOOK (2 COLUMN)</a></li>
                  <li><a href="#">CASH BOOK (1 COLUMN)</a></li>
                  <li><a href="#">CASH BOOK (VOUCHER WISE)</a></li>
                  <li><a href="#">TRAIL BALANCE LEVEL 1 (6 COLUMN)</a></li>
                  <li><a href="#">TRAIL BALANCE LEVEL 2 (6 COLUMN)</a></li>
                  <li><a href="#">TRAIL BALANCE LEVEL 3 (6 COLUMN)</a></li>
                  <li><a href="/trial-balance">TRAIL BALANCE(2 COLUMN)</a></li>
                  <li><a href="#">TRAIL BALANCE(SPECIFIC HEAD)</a></li>
                  <!-- <li class="divider"></li>
                  <li><a href="/ledger">LEDGER VIEW</a></li>
                  <li><a href="#">AGING REPORT</a></li>
                  <li><a href="/expense-head-report/create">MONTHLY EXPENSES SHEET</a></li>
                  <li><a href="#">SALE EXPENSE (Monthwise)</a></li>
                  <li class="divider"></li>
                  <li><a href="/profitloss">PROFIT & LOSS ACCOUNT</a></li>
                  <li><a href="#">PROFIT SHEET</a></li>
                  <li><a href="#">BALANCE SHEET</a></li>
                  <li class="divider"></li>
                  <li><a href="/single-party-purchase-report/create">BUDGET & PURCHASE REPORT</a></li>
                  <li><a href="/all-party-purchase-report/create">PURCHASE REPORT (ALL)</a></li>
                  <li><a href="#">ACCOUNT BUDJET PLAN SHEET</a></li>
                  <li><a href="#">PARTY PAYMENT SCHEDULE</a></li>
                  <li><a href="#">CASH FLOW STATEMENT</a></li> -->
                </ul>
              </li>
              <li class="dropdown">
                <a href="#">ACCOUNT REPORTS 2<span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <!-- <li><a href="/cash-book-report">DAILY BOOK</a></li>
                  <li><a href="/cash-book-report">DAILY CASH & BANK BALANCE</a></li>
                  <li><a href="#">PRINT VOUCHERS</a></li>
                  <li class="divider"></li>
                  <li><a href="/parties">CHART OF ACCOUNT</a></li>
                  <li><a href="/general-voucher">JOURNAL REGISTER</a></li>
                  <li><a href="/client-all-report">ACCOUNT LEDGER</a></li>
                  <li><a href="#">LEDGER MULTIPLE ACCOUNTS</a></li>
                  <li><a href="#">CASH BOOK (2 COLUMN)</a></li>
                  <li><a href="#">CASH BOOK (1 COLUMN)</a></li>
                  <li><a href="#">CASH BOOK (VOUCHER WISE)</a></li>
                  <li><a href="#">TRAIL BALANCE LEVEL 1 (6 COLUMN)</a></li>
                  <li><a href="#">TRAIL BALANCE LEVEL 2 (6 COLUMN)</a></li>
                  <li><a href="#">TRAIL BALANCE LEVEL 3 (6 COLUMN)</a></li>
                  <li><a href="#">TRAIL BALANCE(2 COLUMN)</a></li>
                  <li><a href="#">TRAIL BALANCE(SPECIFIC HEAD)</a></li> 
                  <li class="divider"></li>-->
                  <li><a href="/ledger">LEDGER VIEW</a></li>
                  <li><a href="#">AGING REPORT</a></li>
                  <li><a href="/expense-head-report/create">MONTHLY EXPENSES SHEET</a></li>
                  <li><a href="#">SALE EXPENSE (Monthwise)</a></li>
                  <li class="divider"></li>
                  <li><a href="/profitloss">PROFIT & LOSS ACCOUNT</a></li>
                  <li><a href="#">PROFIT SHEET</a></li>
                  <li><a href="/balance-sheet">BALANCE SHEET</a></li>
                  <li class="divider"></li>
                  <li><a href="/single-party-purchase-report/create">BUDGET & PURCHASE REPORT</a></li>
                  <li><a href="/all-party-purchase-report/create">PURCHASE REPORT (ALL)</a></li>
                  <li><a href="#">ACCOUNT BUDJET PLAN SHEET</a></li>
                  <li><a href="#">PARTY PAYMENT SCHEDULE</a></li>
                  <li><a href="#">CASH FLOW STATEMENT</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#">STORE REPORTS <span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="#">INWARD/OURWARD GATEPASS</a></li>
                  <li><a href="#">INWARD/OURWARD REGISTER</a></li>
                  <li><a href="#">LAST RATE PURCHASE REGISTER</a></li>
                  <li><a href="/products">CHART OF ITEM</a></li>
                  <li><a href="#">CHART REQUISTION (DEMAND)</a></li>
                  <li><a href="#">PURCHASE REQUISTION RECEIPT</a></li>
                  <li><a href="#">PURCHASE REQUISTION REGISTER</a></li>
                  <!-- <li class="dropdown">
                    <a href="#">Another dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                      <li class="divider"></li>
                      <li><a href="#">One more separated link</a></li>
                    </ul>
                  </li> -->
                  
                  <li class="divider"></li>
                  <li><a href="/grn">PRINT GRN</a></li>
                  <li><a href="/grn">GRN REGISTER</a></li>
                  <li><a href="#">GRN REGISTER SPECIFIC PARTY</a></li>
                  <li><a href="#">GRN REGISTER SPECIFIC ITEM</a></li>
                  <li><a href="#">PURCHASE RETURN NOTE</a></li>
                  <li><a href="#">PURCHASE RETURN REGISTER</a></li>
                  <li class="divider"></li>
                  <li><a href="/purchases">PRINT PURCHASE BILL</a></li>
                  <li><a href="/purchases">PURCHASE BILL REGISTER</a></li>
                  <li><a href="#">PURCHASE BILL SPECIFIC REGISTER</a></li>
                  <li class="divider"></li>
                  <li><a href="/sample-bills-report">SAMPLE ISSUE NOTE</a></li>
                  <li><a href="#">RETURN SAMPLE ISSUE NOTE</a></li>
                  <li><a href="#">DAILY ISSUENCE REPORT</a></li>
                  <li><a href="#">S.I.N REGISTER</a></li>
                  <li><a href="#">MATERIAL ISSUE REGISTER</a></li>
                  <li><a href="#">ISSUE REGISTER SPECIFIC DEPARTMENT</a></li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#">STOCK REPORTS<span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="#">ALL ITEMS STOCK</a></li>
                  <li><a href="/stock-register-specific-item">STOCK REGISTER SPECIFIC ITEM</a></li>
                  <li><a href="/stock-report/all-items">STOCK REGISTER ALL ITEM</a></li>
                  <li role="separator" class="divider"></li>

                </ul>
              </li>

              <li class="dropdown">
                <a href="#">SALES TAX REPORTS<span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="#">PURCHASE REGISTER</a></li>
                  <li><a href="#">PURCHASE REGISTER SPECIFIC PARTY</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="/sales-report/single-party/create">PRINT SALE BILL SPECIFIC PARTY</a></li>
                  <li><a href="/sales-report/single-party/create">SALE BILL SPECIFIC PARTY</a></li>
                  <li><a href="/sales-report/all-party/create">SALE BILL</a></li>
                  <li><a href="#">PRINT SALE BILL (RETURN)</a></li>
                  <li><a href="#">SALE BILL REGISTER (RETURN)</a></li>
                  <li><a href="/salestax">PRINT SALE TAX INVOICE</a></li>
                  <li class="divider"></li>
                  <li><a href="/ledger-detail-wise">LEDGER(ITEMWISE DETAIL)</a></li>
                  <li><a href="/salestax">SALES REGISTER</a></li>
                  <li><a href="#">PRINT CREDIT NOTE</a></li>
                  <li><a href="#">SALES REGISTER/SPECIFIC PARTY</a></li>
                  <li class="divider"></li>
                  <li><a href="#">PURCHASE SUMMARY/PARTY WISE</a></li>
                  <li><a href="#">SALE SUMMARY/PARTY WISE</a></li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#">DELIVERY REPORTS<span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="/delivery-challan">PRINT DELIVERY CHALLAN NO</a></li>
                  <li><a href="/delivery-challan">DELIVERY CHALLAN VOUCHER</a></li>
                  <li><a href="/delivery-challan">DELIVERY CHALLAN REGISTER</a></li>
                  <li><a href="#">DELIVERY CHALLAN SPECIFIC PARTY</a></li>
                </ul>
              </li>
          </ul>
        </li>
<!--          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="font-family: monospace;">UTILITIES <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">

            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li> -->
         <li class="dropdown">
          <a href="/roles" role="button" aria-haspopup="true" aria-expanded="false" style="font-family: monospace;">USERS <!-- <span class="caret"></span> --></a>
        </li>
      </ul>
      <!-- <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form> -->
      <ul class="nav navbar-nav navbar-right">
        <!-- <li><a href="#">Link</a></li> -->
        <li class="dropdown" style="font-family: monospace;">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/account/{{ Auth::user()->id }}/edit"><i class="icon-user"></i>Account Setting</a></li>
             <li><a href="/settings/1/edit"><i class="icon-cog"></i>System settings</a></li>
				  <!-- <li><a href="#/"><i class="icon-mail"></i>Messages</a></li>
				  <li><a href="#"><i class="icon-clipboard"></i>Tasks</a></li> -->
				  <li class="divider"></li>
				 
				  <li><a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>