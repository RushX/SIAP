<?php
require_once 'config.php';
  

function expandHomeDirectory($path)
{
    $homeDirectory = getenv('HOME');
    if (empty($homeDirectory)) {
        $homeDirectory = getenv('HOMEDRIVE') . getenv('HOMEPATH');
    }
    return str_replace('~', realpath($homeDirectory), $path);
}

try {
    $path=expandHomeDirectory('token.json');
    $db = new DB();
    $db->update_access_token(json_encode(file_get_contents($path)));
    echo "Access token inserted successfully.";
}
catch( Exception $e ){
    echo $e->getMessage() ;
}