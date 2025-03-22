<?php
include("header.php");
$acno=$_GET["acno"];
$res=$con->query("Select document from customerdocuments where doctype='sign' and accountno='$acno'");
$data="data:image/jpg;base64, ";
if($row=$res->fetch_array())
{
	$data=$data.$row[0];
}
?>
<div class="text-center">
	<img src="<?=$data?>" class="w-75">
</div>
<?php
include("footer.php");
?>