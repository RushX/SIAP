<?php  
//export.php  
$connect = mysqli_connect("localhost","root","","aps");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * from sits";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Roll Number</th>  
                         <th>Subject Code</th>  
                         <th>Unique Code</th>  
       <th>IP Address</th>
       <th>Time Stamp</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
    <td>'.$row["Roll_Number"].'</td>  
    <td>'.$row["Subject_Code"].'</td>  
    <td>'.$row["Unique_Code"].'</td>  
    <td>'.$row["IP_Address"].'</td>  
    <td>'.$row["Time"].'</td>
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  $name=date("d_M_Y");
  header("Content-Disposition: attachment; filename=$name.xls");
  echo $output;
 }
}
?>
