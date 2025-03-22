<?php
include("header.php");
$msg="";
$ss1="";$ss2="";$ss3="";
if(isset($_GET["uname"]))
{
	$res=$con->query("Select * from users where ulogin='".$_GET["uname"]."'");
	if($row=$res->fetch_array())
	{
		$ss1=$row[0];
		$ss2=strtoupper($row[3]);
		$ss3=$row[6];
	}
}
if(isset($_POST["b1"]))
{
	$s1=$_POST["txtLogin"];
	$s2=$_POST["txtPassword"];
	$s3=$_POST["cmbType"];
	$res=$con->query("Select * from users where ulogin='$s1'");
	if($row=$res->fetch_array())
	{
		$msg="This Login Already Exists!!!";
	}
	else
	{
		$dt=date("Y-m-d");
		$con->query("Insert into users values('$s1','$s2','$branch','$s3','$dt','$dt','Y')");
		$msg="User Created Successfully";
	}
}
if(isset($_POST["b2"]))
{
	$s1=$_POST["txtLogin"];
	$s2=$_POST["txtPassword"];
	$s3=$_POST["cmbType"];
	$s4=isset($_POST["c1"])?"Y":"N";
	$dt=date("Y-m-d");
	$con->query("update users set utype='$s3',status='$s4' where ulogin='$s1'");
	if($s2!="")
	{
		$con->query("update users set upass='$s2' where ulogin='$s1'");
	}
	$msg="User Updated Successfully";
}
?>
<div class="container">
	<div class="row">
		<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-3">
			<div class="border shadow rounded-3 p-3">
				<center class="h5 text-primary">User Accounts</center>
				<form method="post">
					<div class="form-group">
						<label>Login</label>
						<input type="text" name="txtLogin" value='<?=$ss1?>' class="form-control">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="txtPassword" class="form-control">
					</div>
					<div class="form-group">
						<label>User Type</label>
						<select class="form-control" name="cmbType">
							<option <?=$ss2=="STAFF"?"SELECTED":""?>>Staff</option>
							<option <?=$ss2=="ADMINISTRATOR"?"SELECTED":""?>>Administrator</option>
							<option <?=$ss2=="TELLER"?"SELECTED":""?>>Teller</option>
							<option <?=$ss2=="CUSTOMER"?"SELECTED":""?>>Customer</option>
						</select>
					</div>
					<div class="form-group">
						<input type="checkbox" name="c1" <?=$ss3=="Y"?"checked":""?>> Enable User
					</div>
					<input type="submit" name="b1" value="Save" class="btn btn-primary mt-4">
					<input type="submit" name="b2" value="Update" class="btn btn-success mt-4">
					<input type="reset" name="b3" value="Clear" class="btn btn-info mt-4">
					<br/>
					<div class="text-danger"><?=$msg?></div>
				</form>
			</div>
		</div>
		<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-3">
			<div class="border shadow rounded-3">
				<table class="table table-bordered table-striped">
				<thead>
					<tr><th>S.No.</th><th>User</th><th>User Type</th><th>Last Login</th><th>Active</th><th></th></tr>
				</thead>
				<tbody>
					<?php
						$result=$con->query("Select * from users where branch=".$branch);
						$i=1;
						while($row=$result->fetch_assoc())
						{
							echo "<tr>";
							echo "<td>$i</td>";
							echo "<td>".$row["ulogin"]."</td>";
							echo "<td>".$row["utype"]."</td>";
							echo "<td>".$row["lastlogindate"]."</td>";
							echo "<td>".$row["status"]."</td>";
							echo "<td><a href='staff.php?uname=".$row["ulogin"]."'>Show</a></td>";
							echo "</tr>";
							$i++;
						}
					?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>