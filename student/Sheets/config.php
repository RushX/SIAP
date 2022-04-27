<?php
require __DIR__ . '/vendor/autoload.php';
require  'class-db.php';
  
define('GOOGLE_CLIENT_ID', '645987741856-cn5g5ng8agtucgthjke69edffat0atpk.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
  
$config = [
    'callback' => 'http://localhost/Sheets/callback.php',
    'keys'     => [
                    'id' => '645987741856-cn5g5ng8agtucgthjke69edffat0atpk.apps.googleusercontent.com',
                    'secret' => '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'
                ],
    'scope'    => 'https://www.googleapis.com/auth/spreadsheets',
    'authorize_url_parameters' => [
            'approval_prompt' => 'force', // to pass only when you need to acquire a new refresh token.
            'access_type' => 'offline'
    ]
];
