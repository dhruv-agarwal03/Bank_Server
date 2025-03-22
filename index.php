<?php
include("db.php");
$msg="";
if(isset($_POST["b1"]))
{
	$con=mysqli_connect($dbhost,$dblogin,$dbpass,$dbname);
	$utype="";
	$s1=$_POST["t1"];
	$s2=$_POST["t2"];
	$result=$con->query("Select * from users where ulogin='$s1' and upass='$s2' and status='Y'");
	if($row=$result->fetch_assoc())
	{
		if(isset($_POST["c1"]))
		{
			setcookie("LOGIN",$s1,time()+(7*24*60*60));
		}
		session_start();
		$_SESSION["LOGIN"]=$s1;
		$_SESSION["BRANCH"]=$row["branch"];
		$utype=$row["utype"];
		$_SESSION["UTYPE"]=$utype;
		$dt=date('Y-m-d');
		$con->query("update users set lastlogindate='$dt' where ulogin='$s1'");
	}
	else
	{
		$msg="Invalid Login/Password!!!";
	}
	$con->close();
	if($utype=="Administrator")
	{
		header("location:admin/index.php");
	}
	if($utype=="Staff")
	{
		header("location:staff/index.php");
	}
	if($utype=="customer")
	{
		header("location:customer/index.php");
	}
}
$uname="";
if(isset($_COOKIE["LOGIN"]))
{
	$uname=$_COOKIE["LOGIN"];
}
?>

<html>
	<head>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2 col-sm-1 col-12"></div>
		<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-sm-10 col-12">
			<div class="border shadow rounded-3 p-3 mt-5">
				<div class="h5 text-center text-primary">User Authentication</div>
				<form method="post">
					<div class="form-group">
						<label>User Name</label>
						<input type="text" name="t1" id="t1" value="<?=$uname?>" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="t2" id="t2" class="form-control" required />
					</div>
					<input type="checkbox" name="c1" id="c1" class="mt-3 mb-3" /> Remember Me<br/>
					<input type="submit" value="Login" name="b1" id="b1" class="btn btn-primary"> &nbsp;&nbsp; <span class="text-danger"><?=$msg?></span>
				</form>
			</div>
		</div>
		<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2 col-sm-1 col-12"></div>
	</div>
</div>
</body>
</html>
