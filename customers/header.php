<?php
include("../db.php");
session_start()	;
$con=mysqli_connect($dbhost,$dblogin,$dbpass,$dbname);
$login=$_SESSION["LOGIN"];
$branch=$_SESSION["BRANCH"];
$utype=$_SESSION["UTYPE"];
	$res=$con->query("Select sum(amount) from banktransactions where accountno='$login' and ttype='C'");
	if($row=$res->fetch_array())
	{
		$balance=$row[0];
	}
	$res=$con->query("Select sum(amount) from banktransactions where accountno='$login' and ttype='D'");
	if($row=$res->fetch_array())
	{
		$balance=$balance-$row[0];
	}
    
?>
<html>
	<head>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/bootstrap.bundle.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<title>Welcome <?=$login?></title>
	</head>
	<body>
	<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
	  <div class="container-fluid">
	    <a class="navbar-brand" href="index.php"><img src="../images/logo.jpeg" width="30px"></a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="mynavbar">
	      <ul class="navbar-nav me-auto">
	        <li class="nav-item">
	          <a class="nav-link" href="index.php">Home</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="transaction.php">transaction</a>
	        </li>
	      	<li class="nav-item">
	          <a class="nav-link" href="statement.php">statements</a>
	        </li>
	       <li class="nav-item">
	          <a class="nav-link" href="password.php">Password</a>
	        </li>
	       <li class="nav-item">
	          <a class="nav-link" href="../logout.php">Logout</a>
	        </li>
	      </ul>
	      <form class="d-flex">	        
		  	<div style="color:white" class="mt-2">Rs-<?=$balance?>/-</button>
	      </form>
	    </div>
	  </div>
	</nav>
	<hr/>
