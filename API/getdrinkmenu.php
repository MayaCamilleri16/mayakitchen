<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include database initialization
include_once('../core/initialize.php');
$drinks = new Drinks($db);

// Call the getDrinkMenu method to get a list of all drinks
$drinks_list = $drinks->getDrinkMenu();

// Set the content type to JSON
header('Content-Type: application/json');

// Return the list of drinks as JSON
echo json_encode($drinks_list);

?>
