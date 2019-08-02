@include("/include.config")
<?php	
	$que="select * from system_logos";
	$run=@mysql_query($que);

	$row=@mysql_fetch_array($run);
	$image = $row['image'];
	
	$que="select * from settings";
	$run=@mysql_query($que);

	$row=@mysql_fetch_array($run);
	$ntn = $row['state'];
	$name = $row['system_name'];
?>
<html>
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body onload="window.print();">
	  <div class="content-wrapper">
        <section class="content">
		<div class="row">
		<div class="col-sm-6">
		<center><b><?php echo $name; ?></b></center>
		</div>
		<div class="col-sm-3">
		
		</div>
		<div class="col-sm-3">
			<span style="float: right;margin-top: -19px;"><?php $t=time(); ($t . "<br>"); echo(date("d-m-Y",$t));?></span>
		</div>
		
		</div>
		<!---<center><span class="user-name"><img src="/upload/logo/<?php echo $image;?>" style="width: 400px;"></span></center>--->
			<div class="panel panel-default">
				<div class="panel-heading"><b>All Books Information</b></div>
				
				<div class="panel-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								 <th>S.NO.</th>
								  <th>Code</th>
								  <!--<th>Book&nbsp;Title</th>--->
								  <th>Book Title</th>
								  <th>Author</th>
								  <th>Publisher</th>
								  <th>Year</th>
								  <th>Price</th>
							 </tr>
						</thead>
 <tbody>
						  <?php 
						  $count = 1;
						  $total=0;
						  ?>
						  @foreach($products as $product)
						   
							<tr>
								<td><?php echo $count;?></td>
								<td class="center">{{$product->product_code}}</td>
								<!---<td class="center">{{$product->product_name}}</td>-->
								<td class="center">{{$product->product_english}}</td>
								<td class="center">{{$product->author}}</td>
								<td class="center">{{$product->publisher_detail->name}}</td>
								<td class="center">{{date("d/m/Y", strtotime($product->year))}}</td>
								<td class="center">{{$product->product_price}}</td>
							</tr>
							<?php $count = $count + 1;?>
							 
							@endforeach
						  </tbody>

						</table>
					
				</div>
			</div> 
			<h5 style="float:right;">© 2018 Developed By Sammar 0321-4197290</h5>
		 </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	</body>
	
</html>

