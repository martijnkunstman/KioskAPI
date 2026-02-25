<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

// get posted data
$data = json_decode(file_get_contents("php://input"));

/*
Expected JSON format:
{
    "items": [
        {"product_id": 1, "price": 7.50},
        {"product_id": 4, "price": 5.50}
    ],
    "price_total": 13.00
}
*/

// make sure data is not empty
if (
    !empty($data->items) &&
    is_array($data->items) &&
    isset($data->price_total)
) {
    try {
        $db->beginTransaction();

        // 1. Create the order
        // Generate a random pickup number (e.g., between 100 and 999)
        $pickup_number = mt_rand(100, 999);
        $order_status_id = 1; // "Started" status

        $query_order = "INSERT INTO orders (order_status_id, pickup_number, price_total) VALUES (:status, :pickup, :total)";
        $stmt_order = $db->prepare($query_order);

        $stmt_order->bindParam(":status", $order_status_id);
        $stmt_order->bindParam(":pickup", $pickup_number);
        $stmt_order->bindParam(":total", $data->price_total);

        if (!$stmt_order->execute()) {
            throw new Exception("Unable to create order.");
        }

        $order_id = $db->lastInsertId();

        // 2. Link products to the order
        $query_items = "INSERT INTO order_product (order_id, product_id, price) VALUES (:order_id, :product_id, :price)";
        $stmt_items = $db->prepare($query_items);

        foreach ($data->items as $item) {
            $stmt_items->bindParam(":order_id", $order_id);
            $stmt_items->bindParam(":product_id", $item->product_id);
            $stmt_items->bindParam(":price", $item->price);

            if (!$stmt_items->execute()) {
                throw new Exception("Unable to add products to order.");
            }
        }

        $db->commit();

        // set response code - 201 created
        http_response_code(201);
        echo json_encode(array(
            "message" => "Order was placed successfully.",
            "order_id" => $order_id,
            "pickup_number" => $pickup_number
        ));

    } catch (Exception $e) {
        $db->rollBack();

        // set response code - 503 service unavailable
        http_response_code(503);
        echo json_encode(array("message" => $e->getMessage()));
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "Unable to place order. Data is incomplete."));
}
?>