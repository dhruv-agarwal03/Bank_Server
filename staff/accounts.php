<?php

include("header.php");
include("../db.php");
$actno="";
$password="";
$abc1="display:block";
$abc2="display:none";
$accno="";
$accType="";
$fname="";
$lname="";
$dob="";
$father="";
$mother="";
$spouse="";
$add="";
$state="";
$city="";
$pincode="";
$mobile="";
$email="";
$gender="";
$aadhar="";
$pan="";
$nomine="";
$nominerelation="";
$nomineDOB="";
$photo="../images/c1.jpeg";
$adhar="../images/c2.png";
$panimg="../images/c4.jpeg";
$sign="../images/c3.png";

if(isset($_POST["btnSearch"])){
	$accno=$_POST["txtAcNo"];
	$res=$con->query("Select * from customers where accountno ='".$accno."'");
	if($row=$res->fetch_row()){
		$accType=substr($accno,5,7);
		$fname=$row[1];
		$lname=$row[2];
		$dob=$row[3];
		$father=$row[4];
		$mother=$row[5];
		$spouse=$row[6];
		$add=$row[7];
		$state=$row[8];
		$city=$row[9];
		$pincode=$row[10];
		$mobile=$row[11];
		$email=$row[12];
		$gender=$row[13];
		$aadhar=$row[14];
		$pan=$row[15];
		$nomine=$row[16];
		$nominerelation=$row[17];
		$nomineDOB=$row[18];
	}
	$res=$con->query("Select * from customerdocuments where accountno ='".$accno."'");
	while($row=$res->fetch_assoc()){
		if($row["doctype"]=="photo")	$photo="data:image/png;base64,".$row["document"];
		else if($row["doctype"]=="sign")	$sign="data:image/png;base64,".$row["document"];
		else if($row["doctype"]=="aadhar")	$adhar="data:image/png;base64,".$row["document"];
		else if($row["doctype"]=="pan")	$panimg="data:image/png;base64,".$row["document"];
	}
}

if(isset($_GET["id"])){
	$accno=$_GET["id"];
	$res=$con->query("Select * from customers where accountno ='".$accno."'");
	if($row=$res->fetch_row()){
		$accType=substr($accno,5,7);
		$fname=$row[1];
		$lname=$row[2];
		$dob=$row[3];
		$father=$row[4];
		$mother=$row[5];
		$spouse=$row[6];
		$add=$row[7];
		$state=$row[8];
		$city=$row[9];
		$pincode=$row[10];
		$mobile=$row[11];
		$email=$row[12];
		$gender=$row[13];
		$aadhar=$row[14];
		$pan=$row[15];
		$nomine=$row[16];
		$nominerelation=$row[17];
		$nomineDOB=$row[18];
	}
	$res=$con->query("Select * from customerdocuments where accountno ='".$accno."'");
	while($row=$res->fetch_assoc()){
		if($row["doctype"]=="photo")	$photo="data:image/png;base64,".$row["document"];
		else if($row["doctype"]=="sign")	$sign="data:image/png;base64,".$row["document"];
		else if($row["doctype"]=="aadhar")	$adhar="data:image/png;base64,".$row["document"];
		else if($row["doctype"]=="pan")	$panimg="data:image/png;base64,".$row["document"];
	}
}
if(isset($_POST["b1"]))
{
	$s1=$_POST["txtAcNo"];
	$s2=$_POST["cmbAcType"];
	$s3=$_POST["txtFname"];
	$s4=$_POST["txtLname"];
	$s5=$_POST["txtDOB"];
	$s6=$_POST["txtFather"];
	$s7=$_POST["txtMother"];
	$s8=$_POST["txtSpouse"];
	$s9=$_POST["txtAddress"];
	$s10=$_POST["cmbState"];
	$s11=$_POST["cmbCity"];
	$s12=$_POST["txtPin"];
	$s13=$_POST["txtAadhar"];
	$s14=$_POST["txtPAN"];
	$s15=$_POST["txtMobile"];
	$s16=$_POST["txtEmail"];
	$s17=$_POST["rdGender"];
	$s18=$_POST["txtNominee"];
	$s19=$_POST["txtNRelation"];
	$s20=$_POST["txtNDOB"];
	$res=$con->query("Select count(*)+1 from customers");
	if($row=$res->fetch_row())
	{
		$res1="";
		$res2="";
		$res3="";
		$res4="";
		$res5="";
		$res6="";
		$con->query("start transaction");
		$x1=str_pad($s2,3,"0",STR_PAD_LEFT);
		$x2=str_pad($row[0],6,"0",STR_PAD_LEFT);
		$actno=$branch.$x1.$x2;
		$res1=$con->query("Insert into customers values('$actno','$s3','$s4','$s5','$s6','$s7','$s8','$s9','$s10','$s11','$s12','$s15','$s16','$s17','$s13','$s14','$s18','$s19','$s20')");
		if(isset($_FILES["docPhoto"]))
		{
			$mc=mime_content_type($_FILES["docPhoto"]["tmp_name"]);
			$data=base64_encode(file_get_contents($_FILES["docPhoto"]["tmp_name"]));
			$res2=$con->query("Insert into customerdocuments values('$actno','photo','$data','$mc')");
		}
		if(isset($_FILES["docSign"]))
		{
			$mc=mime_content_type($_FILES["docSign"]["tmp_name"]);
			$data=base64_encode(file_get_contents($_FILES["docSign"]["tmp_name"]));
			$res3=$con->query("Insert into customerdocuments values('$actno','sign','$data','$mc')");
		}
		if(isset($_FILES["docAadhar"]))
		{
			$mc=mime_content_type($_FILES["docAadhar"]["tmp_name"]);
			$data=base64_encode(file_get_contents($_FILES["docAadhar"]["tmp_name"]));
			$res4=$con->query("Insert into customerdocuments values('$actno','aadhar','$data','$mc')");
		}
		if(isset($_FILES["docPAN"]))
		{
			$mc=mime_content_type($_FILES["docPAN"]["tmp_name"]);
			$data=base64_encode(file_get_contents($_FILES["docPAN"]["tmp_name"]));
			$res5=$con->query("Insert into customerdocuments values('$actno','pan','$data','$mc')");
		}
		$dt=date('Y-m-d');
		$password=date('Ymd').rand(154974,999999);
		$res6=$con->query("Insert into users values('$actno','$password','$branch','customer','$dt','$dt','Y')");
		if($res1 && $res2 && $res3 && $res4 && $res5 && $res6)
		{
			$con->query("commit");
			$abc1="display:none";
			$abc2="display:block";
		}
		else
		{
			$con->query("rollback");
		}
	}
}
?>
<head>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/bootstrap.bundle.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
</head>
<div class="container" style="<?=$abc1?>">
	<form method="post" enctype="multipart/form-data">
		<div class="card shadow">
			<div class="card-header h5 text-center bg-info">Customer Account Information</div>
			<div class="card-body">
				<div class="row">
					<div class="col-xxl-9 col-xl-9 col-lg-9 col-12">
						<div class="row">
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>Account No</label>
								<input type="text" name="txtAcNo" id="txtAcNo" value="<?=$accno?>" class="form-control">
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<input type="submit" value="Search" name="btnSearch" class="form-control btn btn-danger mt-4 w-50">
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>Account Type</label>
								<select class="form-control"  name="cmbAcType" id="cmbAcType">
									<?php
										$results=$con->query("Select * from AcountTypes");
										while($row=$results->fetch_row())
										{
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										}
									?>
								</select>
							</div>
							<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12"></div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>First Name</label>
								<input type="text"   name="txtFname" id="txtFname"value="<?=$fname?>" class="form-control">
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>Last Name</label>
								<input type="text" name="txtLname" id="txtLname"value="<?=$lname?>"  class="form-control">
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>Date of Birth</label>
								<input type="date" name="txtDOB" id="txtDOB" value="<?=$dob?>" class="form-control">
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>Father Name</label>
								<input type="text" name="txtFather" id="txtFather" value="<?=$father?>" class="form-control">
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>Mother Name</label>
								<input type="text" name="txtMother" id="txtMother" value="<?=$mother?>" class="form-control">
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>Spouse Name</label>
								<input type="text" name="txtSpouse" id="txtSpouse" value="<?=$spouse?>" class="form-control">
							</div>
							<div class="col-12">
								<label>Full Address</label>
								<input type="text" name="txtAddress" id="txtAddress" value="<?=$add?>" class="form-control">
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>State</label>
								<select class="form-control" name="cmbState" id="cmbState" >
									<?php
										$results=$con->query("SELECT DISTINCT state FROM cities");
										while($row=$results->fetch_row())
										{
											echo "<option>".$row[0]."</option>";
										}
									?>
								</select>
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>City</label>
								<select class="form-control" name="cmbCity" id="cmbCity" >
									<?php
										$results=$con->query("SELECT DISTINCT city_name FROM cities order by city_name");
										while($row=$results->fetch_row())
										{
											echo "<option>".$row[0]."</option>";
										}
									?>
								</select>
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>Pin Code</label>
								<input type="text" name="txtPin" id="txtPin" value="<?=$pan?>" class="form-control">
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>AAdhar No</label>
								<input type="text" name="txtAadhar" id="txtAadhar" value="<?=$aadhar?>" class="form-control">
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>PAN No</label>
								<input type="text" name="txtPAN" id="txtPAN" value="<?=$pan?>" class="form-control">
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>Mobile No</label>
								<input type="text" name="txtMobile" id="txtMobile" value="<?=$mobile?>" class="form-control">
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>Email</label>
								<input type="text" name="txtEmail" id="txtEmail" value="<?=$email?>" class="form-control">
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<div class="mt-4">
									<input type="radio" name="rdGender" value="M" checked> Male
									<input type="radio" name="rdGender" value="F"> Female
									<input type="radio" name="rdGender" value="O"> Other
								</div>
							</div>
							<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12"></div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>Nominee Name</label>
								<input type="text" name="txtNominee" id="txtNominee" value="<?=$nomine?>"  class="form-control">
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>Nominee Relation</label>
								<input type="text" name="txtNRelation" id="txtNRelation" value="<?=$nominerelation?>" class="form-control">
							</div>
							<div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12">
								<label>Nominee DOB</label>
								<input type="date" name="txtNDOB" id="txtNDOB" value="<?=$nomineDOB?>" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-xxl-3 col-xl-3 col-lg-3 col-12 border rounded-3 shadow text-center">
						<img src="<?=$photo?>" class="w-50" /><br/>
						<input type="file" name="docPhoto" id="docPhoto"  ><hr/>
						<img src="<?=$sign?>" class="w-50" /><br/>
						<input type="file" name="docSign" id="docSign" ><hr/>
						<img src="<?=$adhar?>" class="w-50" /><br/>
						<input type="file" name="docAadhar" id="docAadhar" ><hr/>
						<img src="<?=$panimg?>" class="w-50" /><br/>
						<input type="file" name="docPAN" id="docPAN" ><hr/>
					</div>
				</div>
				<input type="submit" name="b1" id="b1" value="Save Details" class="mt-4 btn btn-success">
			</div>
		</div>
	</form>
</div>
<div class="container" style="<?=$abc2?>">
	<div class="shadow border rounded-5 p-5">
		<h4 class='text-center'>Thanks for Opening an Account</h4>
		<h5 class='text-center'>Following are details of the Account</h5>
		<table class='bordered'>
			<tbody>
				<tr><td>Account No:</td><td><?=$actno?></td></tr>
				<tr><td>Internet Login:</td><td><?=$actno?></td></tr>
				<tr><td>Password:</td><td><?=$password?></td></tr>
				<tr><td>Service Branch:</td><td><?=$branch?></td></tr>
				<tr><td></td><td><input type="button" value="Print" onClick="print()" class="btn btn-success mt-4"></td></tr>
			</tbody>
		</table>
	</div>
</div>
