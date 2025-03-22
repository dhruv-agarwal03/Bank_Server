<?php
include("header.php");
?>
<div class="container">
    <table style="border: 1px solid black; border-collapse: collapse; width: 100%;">
        <thead style="border: 1px solid black; border-collapse: collapse; ">
            <tr >
                <th>Account number</th>
                <th>Full name</th>
                <th>DOB</th>
                <th>Mobile number</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            
        </thead>
        
        <tbody>

            <?php
                $res = $con->query("SELECT * FROM customers WHERE accountno LIKE '".$branch."%'");
                while ($row = $res->fetch_assoc()) {
                    echo "<tr >";
                    echo "<td>".$row["accountno"]."</td>";
                    echo "<td>".$row["fname"]." ".$row["lname"]."</td>";
                    echo "<td>".$row["dob"]."</td>";
                    echo "<td>".$row["mobile"]."</td>";
                    echo "<td>".$row["email"]."</td>";
                    echo "<td><a href='accounts.php?id=".$row['accountno']."'>View</a></td>"; 
                    echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php
include("footer.php");
?>
