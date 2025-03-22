<?php
include("header.php");
?>
<div class="container">
	<div class="border shadow rounded-3 p-4">
		<form method="post">
			Account/Aadhar/Mobile No: <input type="text" required style="border:solid 1px black;border-radius:5px;width:300px;height:35px;font-weight:bold;font-size:20px;padding:5px;margin-right:10px" />
			<input type="submit" value="Search" class="btn btn-success">
		</form>
	</div>
	<hr/>
	<table class="table table-bordered table-striped">
	<thead>
		<tr><th>S.No.</th><th>Account No</th><th>Account Type</th><th>First Name</th><th>Last Name</th><th>Aadhar</th><th>PAN</th><th>Mobile</th><th></th></tr>
	</thead>
	<tbody>
		<?php
			$result=$con->query("Select * from customers order by fname");
			$i=1;
			while($row=$result->fetch_assoc())
			{
				echo "<tr>";
				echo "<td>$i</td>";
				echo "<td>".$row["accountno"]."</td>";
				echo "<td>T</td>";
				echo "<td>".$row["fname"]."</td>";
				echo "<td>".$row["lname"]."</td>";
				echo "<td>".$row["aadhar"]."</td>";
				echo "<td>".$row["pan"]."</td>";
				echo "<td>".$row["mobile"]."</td>";
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