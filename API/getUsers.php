<?php

//use this for security, tokens etc
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/Initialize.php');

//create instance of user 
$user = new User($db);

// call a function from user instance 
$result = $user->read();

$num = $result->rowCount();

if($num > 0){
$user_list = array();
$user_list['data'] = array();

while($row = $result->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $user_item = array(
        'id' => $id,
        'username' => $username,
        'email' => $email,
        'password' => $password
    );
    
    // add current user into list
    array_push($user_list['data'], $user_item);
}
echo json_encode($user_list);
}

else{
    echo json_encode(array('message'=>'No Users found.'));
}
