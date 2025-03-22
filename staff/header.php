<?php
include("../db.php");
session_start()	;
$con=mysqli_connect($dbhost,$dblogin,$dbpass,$dbname);
$login=$_SESSION["LOGIN"];
$branch=$_SESSION["BRANCH"];
$utype=$_SESSION["UTYPE"];

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
	          <a class="nav-link" href="accounts.php">Account</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="customers.php">Customers</a>
	        </li>
	      	<li class="nav-item">
	          <a class="nav-link" href="cashier.php">Cashier</a>
	        </li>
	       <li class="nav-item">
	          <a class="nav-link" href="password.php">Password</a>
	        </li>
	       <li class="nav-item">
	          <a class="nav-link" href="../logout.php">Logout</a>
	        </li>
	      </ul>
	      <form class="d-flex">
	        <input class="form-control me-2" type="text" placeholder="Search">
	        <button class="btn btn-primary" type="button">Search</button>
	      </form>
	    </div>
	  </div>
	</nav>
	<hr/>
