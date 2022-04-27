<?php 
session_start();

include("../php/connection.php");
include("../php/functions.php");



	$user_data = check_login($con);

$connect = mysqli_connect("localhost","root","","aps");
$sql = "SELECT * FROM ucode";  
$result = mysqli_query($connect, $sql);
?>
<html>  
 <head>  
  <title>Data Manager</title>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Martel&family=Montserrat:wght@500&family=Yantramanav:wght@500&display=swap" rel="stylesheet">

  <link href="/css/loader.css" rel="stylesheet" >
  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
  function sessupdate(subject){
    index=subject+"_"+document.getElementById("exp_"+subject).value;  
    gid={"MP_A":"0","MP_B":"1803917907","SE_A":"353191565","SE_B":"123990146","DSA_A":"2101871465","DSA_B":"1582655078","M3_A":"570649533","M3_B":"1323333116","PPL_A":"1958667930","PPL_B":"431991843"}
    gid_final=gid[index];
    url="https://docs.google.com/spreadsheets/d/<?php echo $sheetid?>/export?format=xlsx&gid="+gid_final;
    window.location=url;
     
  }
</script> 
</head>  
 <body>
  <?php 
  include("header.php");
  ?>
  <div class="container">  
   <br />  
   <br />  
   <br />  
   <div class="table-responsive" >  
    <h2 align="center">Data Export</h2><br /> 
    <table class="table table-responsive table-bordered table-striped table-hover" style="text-align:center;">
     <thead >  
                         <th style="text-align:center;">Subject Code</th>  
                         <th style="text-align:center;">Subject Name</th>  
                         <th style="text-align:center;">Division</th>
                         <th style="text-align:center;">Download Sheet</th>
                         
     </thead>
     <?php
     while($row = mysqli_fetch_array($result))  
     { 
      echo '  
     <tr >  
       <td>'.$row["sub_code"].'</td>  
       <td>'.$row["subject"].'</td> 
       <td><select id="exp_'.$row["subject"].'"><option value="A">A</option><option value="B">B</option></select></td>
       <td><input type="Submit" name="update" class="btn btn-success" value="Download" onclick=sessupdate("'.$row["subject"].'")></td>
       </tr>  
      '
      ;  
   
     }
     ?>
    </table>
    <br /> 
   </div>  
  </div>  
  <script>
        var loader =document.getElementById("preloader");
        window.addEventListener("load",function(){
            loader.style.display="none";
        })
    </script>
    <?php
    include("../php/footer.php") ?>
 </body>  
</html>
