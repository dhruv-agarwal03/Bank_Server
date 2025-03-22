<?php
include("header.php");
$stdate = "2000-01-01"; $enddate = date("Y-m-d",strtotime("+1 day")); $acc="";$qyp="Select * from banktransactions order by tdate desc";
if (isset($_POST["btn1"])) {
    if (isset($_POST["start1"]) && !empty($_POST["start1"])) {
        $stdate = $_POST["start1"];
    }

    if (isset($_POST["start2"]) && !empty($_POST["start2"])) {
        $enddate = $_POST["start2"];
    }
	if (isset($_POST["ac1"])) {
        $acc = $_POST["ac1"];
    }
	$qyp="SELECT * FROM banktransactions WHERE tdate BETWEEN '".$stdate."' AND '". $enddate."' AND accountno = '".$acc."';";

}

?>
<div class="container">
	<div class="border shadow rounded-3 p-4">
		<form method="post">
			Start Date: <input type="date" name="start1" id="start1" style="border:solid 1px black;border-radius:5px;width:150px;height:35px;padding:5px;margin-right:10px" />
			End Date: <input type="date"name="start2" id="start2"  style="border:solid 1px black;border-radius:5px;width:150px;height:35px;padding:5px;margin-right:10px" />
			Account/Aadhar/Mobile No: <input type="info1" name="ac1" id="ac1" style="border:solid 1px black;border-radius:5px;width:300px;height:35px;font-weight:bold;font-size:20px;padding:5px;margin-right:10px" required/>
			<input type="submit" name="btn1" id="btn1" value="Search" class="btn btn-success">
		</form>
	</div>
	<hr/>
	<table class="table table-bordered table-striped">
	<thead>
		<tr><th>S.No.</th><th>Transaction ID</th><th>Account No</th><th>Amount</th><th>Dr/Cr</th><th>Details</th><th></th></tr>
	</thead>
	<tbody>
		<?php
			$result=$con->query($qyp);
			$i=1;
			while($row=$result->fetch_assoc())
			{
				echo "<tr>";
				echo "<td>$i</td>";
				echo "<td>".$row["tid"]."</td>";
				echo "<td>T</td>";
				echo "<td>".$row["accountno"]."</td>";
				echo "<td>".$row["amount"]."</td>";
				echo "<td>".$row["ttype"]."</td>";
				echo "<td>".$row["tdetails"]."</td>";
				echo "<td></td>";
				echo "</tr>";
				$i++;
			}
		?>
	</tbody>
	</table>
</div>
<?php
include("footer.php");
?>