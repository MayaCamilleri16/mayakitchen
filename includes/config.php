<?php

//database
$db_user = 'root';
$db_password = 'root';
$db_name = 'mayakitchen'; 

//creating an object which represent the database
$db = new PDO('mysql: host=127.0.0.1;dbname='.$db_name.';charset=utf8',
$db_user,
$db_password);


//SET ATTRIBUTE TO WORK THE SAME MODE 
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Creating a constant which never changes
define('APP_NAME','restaurant booking system');

