<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');


$discount = new Discounts($db);
$result = $discount->read();

// Check if any discounts were found
if ($result->rowCount() > 0) {
    // Initialize array to store discounts
    $discounts_arr = array();
    $discounts_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $discount_item = array(
            'id' => $id,
            'code' => $code,
            'percentage' => $percentage,
            'expiry_date' => $expiry_date
        );

        // Push discount item to discounts array
        array_push($discounts_arr['data'], $discount_item);
    }

    echo json_encode($discounts_arr);
} else {
    // No discounts found
    echo json_encode(array('message' => 'No discounts found'));
}

?>
