<?php
include("header.php");
$crt1="display:none";
$crt2="display:none";
if(isset($_POST["pas"])&&isset($_POST["Rpas"])){
$p=$_POST["pas"];
$r=$_POST["Rpas"];
if($p==$r){
    $r=$con->query("update users SET upass='".$p."' WHERE ulogin='".$login."'");
$crt1="display:none";
$crt2="display:block";
}
else{
    $crt1="display:block";
    $crt2="display:none";
}
}
?>

<div class="container">
<div class="row">
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 p-3"></div>
<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-3">
    <center class="h5 text-primary">Password change</center> 
    <form method="post">
        <div>
            <labe>New Password</label>
            <input type="password" name="pas" id="pas"  class="form-control" required/>
        </div>
        
        <div>
            <labe>Confirm New Password</label>
            <input type="password" name="Rpas" id="Rpas"  class="form-control" required/>
        </div>
        <div style=<?php echo $crt1; ?> 
            <label style="color:red">Password not match</label>
        </div>
        
        <div style=<?php echo $crt2; ?> 
            <label style="color:green">DONE</label>
        </div>
        <input type="submit" value="Update" name="b1" id="b1" class="btn btn-primary m-2"/>
        
    </form>
</div>
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 p-3"></div>
</div>
</div>
<?php
include("footer.php");
?>