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
    <title>QR Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Martel&family=Montserrat:wght@500&family=Yantramanav:wght@500&display=swap" rel="stylesheet">

    <link href="/css/loader.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        function genqr() {
            
            $.ajax({
                url: "../php/qrgen.php",
                type: 'GET',
                data: {
                    "qrval": document.getElementById('selector').value
                },
                success: function(res) {
                    document.getElementById('qr').innerHTML = res;
                }
            });
        }

        function starttimer(duration) {
            display = document.querySelector('#timer');
            var timer = duration,
                minutes, seconds;
            setInterval(function() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);
                minutes = minutes < 10 ? "0" + minutes : seconds;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                display.textContent = minutes + ":" + seconds;
                if (--timer < 0) {
                    time = duration;
                    document.getElementById('qr').hidden = true;
                    document.getElementById('maintimer').innerHTML = "TIMEOUT";

                }

            }, 1000);
        }
    </script>
</head>

<body>
    <?php
    include("header.php");
    ?>
    <br>
    <br>
    <center>
        <table>
            <tr>
                <td>
                    <h4 class="titles">SELECT THE SUBJECT</h4>
                </td>
                <td style="padding-left:20px">

                    <select class="form-select" id='selector' default="MP">
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo ' 
       <option value=' . $row["unique_code"] . '>' . $row["subject"] . '_' . $row["current_sess"] . '</option> 
      ';
                        }
                        ?>
                    </select>
                </td>
        </table>
        <input type="submit" onclick="genqr();starttimer(60);" name="update" class="btn btn-success" style="margin-top:20px;" value="Generate QR" />

        <div id='qr'>

        </div>
        <br>
        <div id="maintimer" class="timer">
            <h4>QR VALID TILL <span id="timer">15:00</span> MINUTES</h4>
        </div>


    </center>
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