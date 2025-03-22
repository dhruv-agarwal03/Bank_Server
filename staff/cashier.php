<?php
include("header.php");
$name="";
$father="";
$aadhar="";
$pan="";
$balance=0;
$acno="";
$msg="";
if(isset($_POST["btnSearch"]))
{
	$acno=$_POST["txtAcNo"];
	$res=$con->query("Select * from customers where accountno='$acno'");
	if($row=$res->fetch_assoc())
	{
		$name=$row["fname"];
		$father=$row["father"];
		$aadhar=$row["aadhar"];
		$pan=$row["pan"];
	}
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
}
if(isset($_POST["btnSave"])){
	$pr=$_POST["r1"];
	$acno=$_POST["txtAcNo"];
	$amount=$_POST["amount"];
	$tdetails=$_POST["remark"]." bank";
	if($pr=='D' && $amount>$balance)	$msg="Low Amount";
	else{
		$tdate = date("Y-m-d", time() + 19800); 
		$query1 = "INSERT INTO banktransactions (tdate, accountno, amount, ttype, tdetails)	VALUES ('$tdate', '$acno', '$amount', '$pr', '$tdetails')";
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
								<input type="text" value='<?=$acno?>' name="txtAcNo" class="form-control" />
							</div>
							<div class="form-group col-8">
								<input type="submit" name="btnSearch" value="Search" class="btn btn-primary mt-4" />
							</div>
							<table class="table table-bordered col-12 mt-3">
								<thead>
									<tr><th>Name</th><th>Father</th><th>Aadhar</th><th>PAN</th><th>Balance</th><th>Signature</th></tr>
								</thead>
								<tbody>
									<tr><td><?=$name?></td><td><?=$father?></td><td><?=$aadhar?></td><td><?=$pan?></td><td><?=$balance?></td><td><a href="#" onclick="open('sign.php?acno=<?=$acno?>','','width=300,height=200,left=800,top=100')">Show</a></td></tr>
								</tbody>
							</table>
							<div class="form-group col-3">
								<label>Amount</label>
								<input type="number" name="amount" id="amount" class="form-control">
							</div>
							<div class="form-group col-9 mt-4 row">
								<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-4 col-sm-12 col-12">Transaction:</div> 
								<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12"><input type="radio" name="r1" value="C" checked> Deposit </div>
								<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12"><input type="radio" name="r1" value="D"> Withdraw</div>
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