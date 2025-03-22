<?php
include("header.php");
?>
<div class="container">
    <table style="border: 1px solid black;  " class="table table-bordered table-striped">
        <thead style=" ">
            <tr >
                <th>Date</th>
                <th>Amount credit</th>
                <th>Amount Debit</th>
                <th>details</th>
                <th>before Balance</th>
                <th>After Balance</th>
            </tr>    
        </thead>
        
        <tbody >

            <?php
                $cuubal=0;
                $res = $con->query("SELECT * FROM banktransactions WHERE accountno ='".$login."'");
                while ($row = $res->fetch_assoc()) {
                    
                    $c=$row["ttype"]=='C'?$row["amount"]:" ";
                    $d=$row["ttype"]=='D'?$row["amount"]: " ";
                    echo "<tr >";
                    echo "<td>".$row["tdate"]."</td>";
                    echo '<td style="color:green;">'.$c.'</td>';
                    echo '<td style="color:red;">'.$d.'</td>';
                    echo "<td>".$row["tdetails"]."</td>";
                    echo "<td>".$cuubal."</td>";
                    $cuubal = $cuubal + ($row["ttype"] == 'C' ? $row["amount"] : $row["amount"] * -1);
                    echo "<td><b>".$cuubal."</b></td>";
                    echo "</tr>";
            }
            ?>
        </tbody>
        <thead style="border: 1px solid black; border-collapse: collapse; ">
            <tr >
                <td colspan="5"><center><b>Total</b></center></td>
                <td><b><?=$balance?></b></td>
            </tr>    
        </thead>
    </table>
    <button class="btn btn-success mt-3 ms-4" onClick="window.print()">print</button>
</div>
<?php
include("footer.php");
?>
