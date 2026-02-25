<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

// get product id
$data = json_decode(file_get_contents("php://input"));

// make sure id is set
if (!empty($data->id)) {

    $query = "DELETE FROM products WHERE product_id = ?";
    $stmt = $db->prepare($query);

    // bind id
    $stmt->bindParam(1, $data->id);

    // execute query
    if ($stmt->execute()) {
        http_response_code(200);
        echo json_encode(array("message" => "Product was deleted."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete product."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to delete product. ID is missing."));
}
?>