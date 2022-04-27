<?php
session_start();
$qrenc = $_POST["QR"];
if(!isset($_SESSION['Conflict_Count'])){
    $_SESSION['Conflict_Count']=0;
}
include("../php/connection.php");
include("../php/functions.php");

date_default_timezone_set('Asia/Kolkata');

if (isset($_COOKIE["Auth"])) {
    $timestamp = substr($_COOKIE["Auth"], 8);
}
$connect = mysqli_connect("localhost", "root", "", "aps");
$sql = "SELECT * FROM ucode";
$result = mysqli_query($connect, $sql);


while ($row = mysqli_fetch_array($result)) {
    if (password_verify($row["unique_code"], $qrenc) == true) {
        $autofill = $row["unique_code"];
        $query = "SELECT * from ucode WHERE unique_code=$autofill";
        $main = mysqli_query($connect, $query);
        $data = (mysqli_fetch_row($main));
        $found = 1;
        break;
    } else {
        continue;
        $found = 0;
    }
}
if ($found == 0) {
    header("Location: scanner.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "SITS_", $data[1], "_", $data[3] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Martel&family=Montserrat:wght@500&family=Yantramanav:wght@500&display=swap" rel="stylesheet">
    <style>
        html{
            height: 100%;
            width: 100%;
        }
        body {

            font-size: 3.2vmin !important;
        }
    </style>
    <link href="/css/loader.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/js/notify.js"></script>

</head>

<body>
    <div id="noty-holder"></div>
    <?php include("header.php") ?>
    <center>
        <table>
            <tr>
                <!-- <td>
                    <img src="../admin/Sinh.png">
                </td> -->
                <td bgcolor="yellow" style="padding: 15px;border-radius:20px">
                    <p style="font-size:2.4vmin !important;text-justify:inter-cluster"><i class="fa-solid fa-triangle-exclamation fa-fade"></i> Important Notice <br>To avoid proxy, System has limited single <br> response per device. In case of IP Conflict,<br> All entries from that particular ip<br>will be discarded</p>
                </td>

            </tr>
        </table>
        <br>
        <h4><?php echo $data[1], " ", $data[3] ?></h4>
        <form action="javascript:void(0);" method="post" style="width:100%;max-width:max-content;" >
            <table style="margin:0.2em;width:100%">
                <tr>
                    <td>Attendance Status</td>
                    <?php if (isset($_COOKIE["Auth"])) { ?>
                        <script>
                            createNoty("Attendance Marked Successfully", 'success');
                        </script>
                        <td style="background-color:green;border-radius:5px">
                            <p style="color:white;text-align:center;margin:0.2em">MARKED</p>
                        </td>
                    <?php } else { ?>
                        <td style="background-color:red;text-align:center;border-radius:5px">
                            <p style="color:white;margin:0.2em;">NOT MARKED</p>
                        </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>Unique Code Status</td>
                    <td style="background-color:green;border-radius:5px">
                        <p style="color:white;text-align:center;margin:0.2em">VERIFIED</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Division</span>
                    </td>
                    <td>
                        <span>
                            <select style="width:100%;border:ridge;" id="division" name="division" id="division">
                                <option value="SA1">SA1</option>
                                <option value="SA2">SA2</option>
                                <option value="SA3">SA3</option>
                                <option value="SB1">SB1</option>
                                <option value="SB2">SB2</option>
                                <option value="SB3">SB3</option>
                            </select>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Email Address</td>
                    <td><input style="border:ridge" type="text" id="email" name="email" placeholder="Email"></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><input style="border:ridge" type="text" id="name" name="name" placeholder="Name"></td>
                </tr>
                <tr>
                    <td>Roll Number</td>
                    <td><input style="border:ridge" type="text" id="rollnum" name="rollnum" placeholder="Roll Number"></td>
                    <input type="text" id="hash" name="hash" value="<?php echo $qrenc ?>" hidden>
                    <input type="text" id="sub_code" name="sub_code" value="<?php echo $data[0] ?>" hidden>
                    <input type="text" id="subject" name="subject" value="<?php echo $data[1] ?>" hidden>
                    <input type="text" id="ip" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']   ?>" hidden>
                </tr>
            </table>
        </form>
        <?php if (isset($_COOKIE["Auth"])) { ?>
            <script>
                var timeleft = <?php echo $timestamp - time() ?>;
                var downloadTimer = setInterval(function() {
                    if (timeleft <= 0) {
                        clearInterval(downloadTimer);
                        document.getElementById("buttonmsg").innerHTML = "Please Refresh";
                        window.location.replace("scanner.php");
                    } else {
                        document.getElementById("buttonmsg").innerHTML = "Service Blocked for next " + timeleft + " Seconds";
                    }
                    timeleft -= 1;
                }, 1000);
            </script>
        <?php } ?>
                    <button <?php if (isset($_COOKIE["Auth"])) {
                                echo "disabled class='btn btn-danger' ";
                            } else {
                                echo ' class="btn btn-success" ';
                            } ?>type="submit" id="button" name="button" onclick="gen()" style="margin-top:20px;font-size:3.2vmin;margin-bottom:30px;" value="Submit" /> <span id="buttonmsg">Submit</span><span class="loader fa-2sm" id="loader" hidden style="z-index:2;position:relative;margin-top:20px">
                            <i id="loads" style="--fa-animation-duration: 0.5s;" class="fa-solid fa-spinner fa-spin-pulse"></i>
                        </span></button>
        <script>
            function gen() {
                document.getElementById('loader').hidden = false;
                document.getElementById('button').disabled = true;
                document.getElementById('buttonmsg').className = "fa-fade";
                document.getElementById('buttonmsg').innerHTML = "Processing";
                $.post("MarkAttendance.php", {
                    rollnum: document.getElementById('rollnum').value,
                    division: document.getElementById('division').value,
                    hash: document.getElementById('hash').value,
                    sub_code: document.getElementById('sub_code').value,
                    subject: document.getElementById('subject').value,
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    ip: document.getElementById('ip').value,
                    
                },
                function(data, status) {
                    location.reload()
                }).fail(function(response, TextStat, fail) {
                    createNoty("Error: " + response.statusText, 'danger');
                    document.getElementById('loader').hidden = true;
                    document.getElementById('button').disabled = false;
                    document.getElementById('buttonmsg').className = "";
                    document.getElementById('buttonmsg').innerHTML = "Submit";
                })
            }
            </script>
    </center>
    <script>
        var loader =document.getElementById("preloader");
        window.addEventListener("load",function(){
            loader.style.display="none";
        })
    </script>
</body>

</html>