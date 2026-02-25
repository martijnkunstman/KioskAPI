<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

// query orders with their items
$query = "SELECT 
            o.order_id, o.pickup_number, o.price_total, o.datetime,
            s.description as status,
            p.name as product_name, op.price as item_price
          FROM orders o
          JOIN order_status s ON o.order_status_id = s.order_status_id
          JOIN order_product op ON o.order_id = op.order_id
          JOIN products p ON op.product_id = p.product_id
          ORDER BY o.datetime DESC, o.order_id DESC";

$stmt = $db->prepare($query);
$stmt->execute();

$num = $stmt->rowCount();

if ($num > 0) {
    $orders_arr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $order_id = $row['order_id'];

        if (!isset($orders_arr[$order_id])) {
            $orders_arr[$order_id] = array(
                "order_id" => $order_id,
                "pickup_number" => $row['pickup_number'],
                "price_total" => (float) $row['price_total'],
                "status" => $row['status'],
                "datetime" => $row['datetime'],
                "items" => array()
            );
        }

        $orders_arr[$order_id]["items"][] = array(
            "product_name" => $row['product_name'],
            "price" => (float) $row['item_price']
        );
    }

    // Convert associative array back to indexed array for JSON
    $result = array_values($orders_arr);

    http_response_code(200);
    echo json_encode($result);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No orders found."));
}
?>