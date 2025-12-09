<style>
#memmonth .no-data {
    font-size: 14px;      
    font-weight: normal;    
    color: #333;           
    text-align: center;
    padding: 10px 0;
}
</style>
<?php
require '../../include/db_conn.php';
$month=$_GET['mm'];
$year=$_GET['yy'];
$flag=$_GET['flag'];

$query="";


if($flag==0)
	$query="select * from users u INNER JOIN address a on u.userid=a.id where u.joining_date like '".$year."-".$month."___'";
else if($flag==1)
	$query="select * from users u INNER JOIN address a on u.userid=a.id where u.joining_date like '".$year."______'";
  

$res=mysqli_query($con,$query);
echo "<tbody border=1>";

$sno    = 1;

if (mysqli_affected_rows($con) != 0) {

	echo "<thead>
				<tr>
					<th>Sl.No</th>
					<th>Member ID</th>
					<th>Name</th>
					<th>Contact</th>
					<th>Gender</th>
					<th>State</th>
					<th>City</th>
					<th>DOB</th>
					<th>Joining_Date</th>
				</tr>
	</thead>";

    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
      

                echo "<tr><td>".$sno."</td>";
                
                echo "<td>" . $row['userid'] . "</td>";

                echo "<td width='25%'>" . $row['username'] . "</td>";

                echo "<td>" . $row['mobile'] . "</td>";


                echo "<td>" . $row['gender'] . "</td>";

                echo "<td>" . $row['state'] . "</td>";

                echo "<td>" . $row['city'] . "</td>";

                echo "<td>" . $row['dob'] . "</td>";

                echo "<td>" . $row['joining_date'] ."</td></tr>";
                
                $sno++;
            
        
    }

}
else {
    $colspan = 9; 
    if($flag==0){
        $monthName = date("F", mktime(0, 0, 0, $month, 10));
        echo "<tr><td colspan='$colspan' style='text-align:center; font-size:14px; font-weight:normal; color:#333;'>No Data found on ".$monthName." ".$year."</td></tr>";
    }
    else if($flag==1){
        echo "<tr><td colspan='$colspan' style='text-align:center; font-size:14px; font-weight:normal; color:#333;'>No Data found on ".$year."</td></tr>";
    }
}
echo "</tbody>";


?>
