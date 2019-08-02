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
      <a class="navbar-brand" href="/dashboard" style="font-family: cursive;"><?php echo $quee["system_name"];?></a></a>
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
            <li><a href="/parties">ADD PARTY/ACCOUNT</a></li>
            <li><a href="/catagories">ADD ITEM CATAGORY</a></li>
            <li><a href="/products">ADD ITEM</a></li>
            <!-- <li><a href="/expenses/heads">ADD EXPENSE HEAD</a></li> -->
            <li role="separator" class="divider"></li>
            <li><a href="#">CHANGE PASSWORD</a></li>
            
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
                  <li><a href="/expenses">EXPENSES</a></li>
                  <li class="divider"></li>
                  <!-- <li><a href="#">One more separated link</a></li> -->
                </ul>
              </li>

            <li role="separator" class="divider"></li>
                <li class="dropdown">
                <a href="#">SALE/PURCHASE TRANS<span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="/purchases">PURCHASE BILL</a></li>
                  <!-- <li><a href="/purchases">PURCHASE INVOICE(TAX)</a></li>
                  <li><a href="#">DEBIT NOTE(Purhase Return)</a></li>
                  <li class="divider"></li>
                  <li><a href="/delivery-challan">DELIVERY CHALLAN</a></li> -->
                  <li><a href="/sales">SALE BILL</a></li>
                  <!-- <li><a href="/salestax">SALES INVOICE</a></li>
                  <li><a href="#">CREDIT NOTE(SALE RETURN)</a></li> -->
                  <li><a href="/sales-return">RETURN SALE BILL</a></li>
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
                </ul>
              </li>
              <li class="dropdown">
                <a href="#">ACCOUNT REPORTS 2<span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="/ledger">LEDGER VIEW</a></li>
                  <li><a href="/expense-head-report/create">MONTHLY EXPENSES SHEET</a></li>
                  <li class="divider"></li>
                  <li><a href="/profitloss">PROFIT & LOSS ACCOUNT</a></li>
                  <li><a href="/balance-sheet">BALANCE SHEET</a></li>
                 
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
                <a href="#">PURCHASES REPORTS<span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="#">PURCHASE REGISTER</a></li>
                  <li><a href="#">PURCHASE REGISTER (SPECIFIC PARTY)</a></li>
                   <li class="divider"></li>
                  <li><a href="/single-party-purchase-report/create">PURCHASE REPORT (SPECIFIC PARTY)</a></li>
                  <li><a href="/all-party-purchase-report/create">PURCHASE REPORT (ALL)</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#">SALES REPORTS<span class="caret"></span></a>
                <ul class="dropdown-menu dropdownhover-right">
                  <li><a href="/sales-report/single-party/create">SALE BILL SPECIFIC PARTY</a></li>
                  <li><a href="/sales-report/all-party/create">SALE BILL</a></li>
                  <li class="divider"></li>
                  <li><a href="/ledger-detail-wise">LEDGER(ITEMWISE DETAIL)</a></li>
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