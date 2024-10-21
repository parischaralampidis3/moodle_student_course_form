<?php

require_once(__DIR__ ."/.././config.php");

global $DB;

if(isset($GET['token'])){
    $token = $_GET['token'];

$user = $DB->get_record('user_register',['verification_token'=>$token]);
}

if(!$user){
    echo "Invalid or expired token";
}

$token_lifetime = 24*60*60;

if(time() - $user->token_created_at  > $token_lifetime){
    echo 'Token is expired';
    exit;
}

$user->verified = 1;
$user->verification_token = null;
$DB->update_record('user_register',$user);

echo "Your email has been verified! You can now log in!";
?>