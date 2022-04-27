<?php


include("../php/connection.php");
include("../php/functions.php");
date_default_timezone_set('Asia/Kolkata');


if (!isset($_SERVER['HTTP_REFERER'])) {
    header("Location:/403.html");
    $directaccess = 1;
}

session_start();
include __DIR__ . ('/Sheets/vendor/autoload.php');
include __DIR__ . ('/Sheets/config.php');


$subject = $_POST["subject"];
$email = $_POST["email"];
$name = $_POST["name"];
$rollnum = $_POST["rollnum"];
$division = $_POST["division"];
$hash = $_POST["hash"];
$sub_code = $_POST["sub_code"];
$connect = mysqli_connect("localhost", "root", "", "aps");
$sql = "SELECT * FROM ucode";
$result = mysqli_query($connect, $sql);
















function rollvalidate($service, $sheetid, $rollnum, $subject, $div, $current_sess)
{
    $spreadsheetId = $sheetid;

    $range = "{$subject}_$div!A2:A";
    $requestBody = new Google_Service_Sheets_ValueRange();
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $found = 0;
    $rows = ($response->getValues());



    foreach ($rows as $item) {
        if (in_array($rollnum, $item)) {
            $found = 1;
        }
    }
    if ($found != 1) {
        header("HTTP/1.1 404 Roll Number Not Found");
        die();
    }

    $key = substr($rollnum, -2) + 3;
    $ip = $_POST["ip"];
    update_ip($service, $key, $sheetid, $subject, $div, $current_sess,$ip);
}


function get_sessionkey($service, $sheetid, $current_sess, $subject, $div)
{
    $unit = substr($current_sess, 0, 2);
    $lnum = substr($current_sess, 2, 2);
    $range = "{$subject}_$div!L3:Z3";
    $response = $service->spreadsheets_values->get($sheetid, $range);
    $found = 0;
    $rows = ($response->getValues());

    foreach ($rows as $item) {
        if (in_array($lnum, $item)) {
            $found = 1;
        }
    }
    if ($found != 1) {
        header("HTTP/1.1 404 Lecture Not Found");
        die();
    }
    $range = "{$subject}_$div!H2";
    $response = $service->spreadsheets_values->get($sheetid, $range);
    $found = 0;
    $rows = ($response->getValues());
    foreach ($rows as $item) {
        if (in_array($unit, $item)) {
            $found = 1;
        }
    }
    if ($found != 1) {
        header("HTTP/1.1 404 Unit Not Found");
        die();
    }

    $sessdef = array("L1" => "L", "L2" => "M", "L3" => "N", "L4" => "O", "L5" => "P", "L6" => "Q", "L7" => "R", "L8" => "S", "L9" => "T", "L10" => "U", "L11" => "V", "L12" => "W", "L13" => "X", "L14" => "Y", "L15" => "Z", "L16" => "AA", "L17" => "AB", "L18" => "AC", "L19" => "AD", "L20" => "AE");
    return $sessdef["$lnum"];
}


function update_attendance($service, $key, $sheetid, $subject, $div, $current_sess)
{

    $spreadsheetId = $sheetid;  // TODO: Update placeholder value.

    $found = 0;
    $unit = substr($current_sess, 0, 2);
    $lnum = substr($current_sess, 2, 2);
    $sessionkey = get_sessionkey($service, $spreadsheetId, $current_sess, $subject, $div);
    $range = "{$subject}_$div!$sessionkey$key";
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $rows = ($response->getValues());
    $newattendance = 1;
    $values = [
        [
            $newattendance
        ]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];

    $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
    $cookie_name = "Auth";
    $curr = time() + 900;
    $cookie_value = "SITS_CS_$curr";
    setcookie($cookie_name, $cookie_value, time() + (900), "/"); // 86400 = 1 day
    header("HTTP/1.1 200 Attendance Marked Successfully");
}


function admin_add_total_conducted()
{
}


function update_ip($service, $key, $sheetid, $subject, $div, $current_sess,$ip)

{
    
    $spreadsheetId = $sheetid;
    $range = "{$subject}_$div!B$key";
    $newattendance = $ip;
    $values = [
        [
            $newattendance
        ]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];

    $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);

    $range = "{$subject}_$div!B2:B";
    $requestBody = new Google_Service_Sheets_ValueRange();
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $found = 0;
    $rows = ($response->getValues());

    foreach ($rows as $item) {
        if (in_array("{$ip}", $item)) {
        $found=$found+1;
        }
    }
    if ($found >=2) {
        header("HTTP/1.1 403 IP Blocked ! <br> IP Conflict was detected, Contact Site Administrator to Unblock");
        die();
    }

    else{
    $spreadsheetId = $sheetid;  // TODO: Update placeholder value
    $range = "{$subject}_$div!B$key";
    $newattendance = $ip;
    $values = [
        [
            $newattendance
        ]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];

    $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
    update_attendance($service, $key, $sheetid, $subject, $div, $current_sess);
}
}



// MAIN

while ($row = mysqli_fetch_array($result)) {
    if (password_verify($row["unique_code"], $hash) == TRUE) {
        $autofill = $row["unique_code"];
        $query = "SELECT * from ucode WHERE unique_code=$autofill";
        $main = mysqli_query($connect, $query);
        $data = (mysqli_fetch_row($main));
        if ($data[0] == $sub_code) {
            $found = 1;
            $current_sess = $data[3];
        }
        $found=1;
    } 
    else {
        continue;
        $found = 0;
    }
}
if ($found == 0) {
    header("HTTP/1.1 403 QR Verification Failed");
    die();
}

$current_sess = $data[3];

try {
    $div = substr($division, 1, 1);

    $client = new Google_Client();

    $db = new DB();

    $arr_token = (array) $db->get_access_token();
    $accessToken = array(
        'access_token' => $arr_token['access_token'],
        'expires_in' => $arr_token['expires_in'],
    );


    $client->setAccessToken($accessToken);

    $service = new Google_Service_Sheets($client);
    rollvalidate($service, $sheetid, $rollnum, $subject, $div, $current_sess);
} catch (Exception $e) {
    if (401 == $e->getCode()) {
        $refresh_token = $db->get_refersh_token();

        $client = new GuzzleHttp\Client(['base_uri' => 'https://accounts.google.com']);

        $response = $client->request('POST', '/o/oauth2/token', [
            'form_params' => [
                "grant_type" => "refresh_token",
                "refresh_token" => $refresh_token,
                "client_id" => GOOGLE_CLIENT_ID,
                "client_secret" => GOOGLE_CLIENT_SECRET,
            ],
        ]);

        $data = (array) json_decode($response->getBody());
        $data['refresh_token'] = $refresh_token;

        $db->update_access_token(json_encode($data));

        append_to_sheet($sheetid, $data_append);
    } else {
        echo $e->getMessage(); //print the error just in case your data is not appended.
    }
}
