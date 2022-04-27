<html>

<head>
    <title>SIAP | SCANNER</title>
    <script src="https://kit.fontawesome.com/16d37616d9.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Martel&family=Montserrat:wght@500&family=Yantramanav:wght@500&display=swap" rel="stylesheet">

    <link href="/css/loader.css" rel="stylesheet">

</head>

<body>
    <?php
    $data = ["", "QR Scanner", "", ""];
    include("header.php") ?>

    <center>
        <table>
            <tr style="border: none;">
                <td>
                    <img src="../admin/Sinh.png">
                </td>
                <td>
                    <h1>Sinhgad Institutes</h1>
                </td>

            </tr>
        </table>

        <h1>QR SCANNER</h1>
        <div id="qr-reader" style="width:500px;"></div>
        <div id="qr-reader-results"></div>
    </center>
    <form id="forward" action="AttendanceForm.php" method="post">
        <input hidden name="QR" id="QR">
    </form>
    <script>
        var loader = document.getElementById("preloader");
        window.addEventListener("load", function() {
            loader.style.display = "none";
        })
    </script>
    <?php
    include("../php/footer.php") ?>

</body>

<script src="qr.js"></script>
<script>
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete" ||
            document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function() {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                document.getElementById('QR').value = decodedText
                document.getElementById('forward').submit()
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: 250
            });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>

</html>