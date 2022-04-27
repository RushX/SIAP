<?php
session_start();

include("../php/connection.php");
include("../php/functions.php");


$user_data = check_login($con);

$connect = mysqli_connect("localhost", "root", "", "aps");
$sql = "SELECT * FROM ucode";
$result = mysqli_query($connect, $sql);
?>
<html>

<head>
  <title>UID Manager</title>
  <!-- Latest compiled and minified CSS -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Martel&family=Montserrat:wght@500&family=Yantramanav:wght@500&display=swap" rel="stylesheet">

  <link href="/css/loader.css" rel="stylesheet"><!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../js/notify.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
  <?php
  include("header.php");
  ?>
  <div class="container">
    <br />
    <br />
    <br />
    <div class="table-responsive">
      <h2 align="center">Unique Id Management</h2><br />

      <script>
        function sessupdate(sub_code) {
          loader = sub_code + '_loader';
          button = sub_code + '_button';
          buttonmsg = sub_code + '_buttonmsg';
          document.getElementById(loader).hidden = false;
          document.getElementById(button).disabled = true;
          document.getElementById(buttonmsg).className = "fa-fade";
          document.getElementById(buttonmsg).innerHTML = "Processing";

          $.post("sessid_updater.php", {
              sess_id: document.getElementById('sess_' + sub_code).value,
              sub_code: sub_code

            },
            function(data, status) {
              createNoty("Updated Successfully ", 'success')
              document.getElementById(loader).hidden = true;
              document.getElementById(button).disabled = false;
              document.getElementById(buttonmsg).className = "";
              document.getElementById(buttonmsg).innerHTML = "Update";
            }).fail(function(response, TextStat, fail) {
            createNoty("Error: " + response.statusText, 'danger');
            document.getElementById(loader).hidden = true;
            document.getElementById(button).disabled = false;
            document.getElementById(buttonmsg).className = "";
            document.getElementById(buttonmsg).innerHTML = "Update";

          })

        }

        function ucupdater() {
          document.getElementById('loader').hidden = false;
          document.getElementById('button').disabled = true;
          document.getElementById('buttonmsg').className = "fa-fade";
          document.getElementById('buttonmsg').innerHTML = "Processing";
          $.get("uid_updater.php", function(data, status) {
            window.stat = 'success';
            createNoty("Updated Successfully... Please Refresh  ", 'success')
            document.getElementById('loader').hidden = true;
            document.getElementById('button').disabled = false;
            document.getElementById('buttonmsg').className = "";
            document.getElementById('buttonmsg').innerHTML = "Update Unique Code";
          }).fail(function(response, TextStat, fail) {
            createNoty("Error: " + response.statusText, 'danger');
            document.getElementById('loader').hidden = true;
            document.getElementById('button').disabled = false;
            document.getElementById('buttonmsg').className = "";
            document.getElementById('buttonmsg').innerHTML = "Update Unique Code";

          })
    

        }
      </script>


      <table class="table table-responsive table-bordered table-striped table-hover" style="text-align:center;">
        <thead>
          <th style="text-align:center;">Subject Code</th>
          <th style="text-align:center;">Subject Name</th>
          <th style="text-align:center;">Unique Code</th>
          <th style="text-align:center;">Current Session</th>
          <th style="text-align:center;">Update Session</th>

        </thead>



        <?php
        while ($row = mysqli_fetch_array($result)) {
          echo '  
     <tr>  
       <td>' . $row["sub_code"] . '</td>  
       <td>' . $row["subject"] . '</td>  
       <td>' . $row["unique_code"] . '</td>
       <td><input style="width:100px" id="sess_' . $row["sub_code"] . '" type="text" value="' . $row["current_sess"] . '"></td>
       <td><button id="' . $row["sub_code"] . '_button" type="submit" class="btn btn-success" name="button" onclick=sessupdate(' . $row["sub_code"] . ') value="Submit" /> <span id="' . $row["sub_code"] . '_buttonmsg">Update</span><span class="loader fa-2sm" id="' . $row["sub_code"] . '_loader" hidden style="z-index:2;position:relative;margin-top:20px">
       <i id="' . $row["sub_code"] . '_loads" style="--fa-animation-duration: 0.5s;" class="fa-solid fa-spinner fa-spin-pulse"></i></button></td>
       </tr>  
      ';
        }
        ?>
      </table>
      <br />
      <center>
        <button type="submit" id="button" class="btn btn-success" name="button" onclick="ucupdater()" value="Submit" /> <span id="buttonmsg">Update Unique Code</span><span class="loader fa-2sm" id="loader" hidden style="z-index:2;position:relative;margin-top:20px">
          <i id="loads" style="--fa-animation-duration: 0.5s;" class="fa-solid fa-spinner fa-spin-pulse"></i>
        </span></button>
      </center>
    </div>
  </div>
  <script>
    var loader = document.getElementById("preloader");
    window.addEventListener("load", function() {
      loader.style.display = "none";
    })
  </script>
  <?php
    include("../php/footer.php") ?>
</body>

</html>