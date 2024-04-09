<?php

//use this for security, tokens etc
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');


//create instance of user 
$user = new User($db);

$user->id = isset($_GET['id']) ? $_GET['id'] : die();
$user->read_single();

$user_info = array(
    'id'       => $user->id,
    'username' => $user->username,
    'email'    => $user->email,
    'password'  => $user->password
);

print_r(json_encode($user_info));
