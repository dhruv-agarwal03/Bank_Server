<?php
include("header.php");
$name="";
$father="";
$aadhar="";
$pan="";
$balance=0;
$acno=$_SESSION["LOGIN"];
$msg="";
if(isset($_POST["btnSave"])){
    
    $acno1=$_POST["txtAcNo"];
	$res=$con->query("Select sum(amount) from banktransactions where accountno='$acno' and ttype='C'");
	if($row=$res->fetch_array())
	{
		$balance=$row[0];
	}
	$res=$con->query("Select sum(amount) from banktransactions where accountno='$acno' and ttype='D'");
	if($row=$res->fetch_array())
	{
		$balance=$balance-$row[0];
	}
	$pr='D';
	$amount=$_POST["amount"];
	$tdetails=$_POST["remark"]." Online";
	if($amount>$balance)	$msg="Low Amount";
	else{
		$tdate = date("Y-m-d", time() + 19800); 
		$query1 = "INSERT INTO banktransactions (tdate, accountno, amount, ttype, tdetails)	VALUES ('$tdate', '$acno', '$amount', '$pr', '$tdetails')";
		$res=$con->query($query1);
        $pr='C';
        $query1 = "INSERT INTO banktransactions (tdate, accountno, amount, ttype, tdetails)	VALUES ('$tdate', '$acno1', '$amount', '$pr', '$tdetails')";
		$res=$con->query($query1);
	}
}
?>
<div class="container">
	<div class="row">
		<div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-1 col-12"></div>
		<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-10 col-12">
			<div class="card shadow rounded">
				<div class="card-header text-center bg-info h4">Account Debit/Credit</div>
				<div class="card-body p-3">
					<form method="post">
						<div class="row">
							<div class="form-group col-4">
								<label>Account No</label>
								<input type="text"  name="txtAcNo" class="form-control" />
							</div>
							
							<div class="form-group col-4">
								<label>Amount</label>
								<input type="number" name="amount" id="amount" class="form-control">
							</div>
							<div class="form-group col-5"></div>
							<div class="form-group col-12">
								<label>Remark</label>
								<textarea  name="remark" id="remark" class="form-control"></textarea>
							</div>
						</div>
						<?=$msg?>
						<input type="submit" name="btnSave" value="Save" class="btn btn-success mt-3">
					</form>
				</div>
				<div class="card-footer"></div>
			</div>
		</div>
		<div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-1 col-12"></div>
	</div>
</div>
<?php
include("footer.php");
?>