@include("/include.config")
<?php 
$conn = DB::connection()->getPdo();
  $que=$conn->query('SELECT * from system_logos')->fetch();
  $quee=$conn->query('SELECT * from settings')->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from g-axon.com/mouldifi-3.0/dark/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Nov 2016 11:02:52 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Stock & Accounts Solutions - A fully Accounts Software">
<meta name="keywords" content="Stock & Accounts Solutions - A fully Accounts Software">
<title><?php echo $quee["title"]; ?></title>
<!-- Site favicon -->
<link rel='shortcut icon' type='image/x-icon' href='\upload\logo\<?php echo $que["image"]; ?>' />
<!-- /site favicon -->

<!-- Entypo font stylesheet -->
<link href="css/entypo.css" rel="stylesheet">
<!-- /entypo font stylesheet -->

<!-- Font awesome stylesheet -->
<link href="css/font-awesome.min.css" rel="stylesheet">
<!-- /font awesome stylesheet -->

<!-- Bootstrap stylesheet min version -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- /bootstrap stylesheet min version -->

<!-- Mouldifi core stylesheet -->
<link href="css/mouldifi-core.css" rel="stylesheet">
<!-- /mouldifi core stylesheet -->

<link href="css/mouldifi-forms.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
<![endif]-->


</head>
<body class="login-page">
<div class="login-container">
    <div class="login-branding">
        <a href="index.html"><img src="\upload\logo\<?php echo $que["image"]; ?>" style="height: 80px;" alt="<?php echo $quee["title"]; ?>" title="<?php echo $quee["title"]; ?>"></a>
    </div>
    <div class="login-content">
        <h2><strong>Welcome</strong>, please login</h2>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}                        
            <div class="form-group">
                <input id="email" type="email" placeholder="Email" class="form-control" style="color:black;" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>                        
            <div class="form-group">
                <input id="password" type="password" placeholder="password" class="form-control" style="color:black;" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="form-group">
                 <div class="checkbox checkbox-replace">
                    <input type="checkbox" id="remeber">
                    <label for="remeber">Remeber me</label>
                  </div>
             </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block">Login</button>
            </div>
            <!-- <p class="text-center"><a href="forgot-password.html">Forgot your password?</a></p>  -->                       
        </form>
    </div>
</div>
<!--Load JQuery-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

<!-- Mirrored from g-axon.com/mouldifi-3.0/dark/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Nov 2016 11:02:52 GMT -->
</html>
