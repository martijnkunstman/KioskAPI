<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST"); // Using POST for compatibility, but intended as UPDATE
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));

// make sure id is set
if (!empty($data->id)) {

    // Construct dynamic update query (only update fields provided)
    $fields = [];
    $params = [":id" => $data->id];

    if (isset($data->name)) {
        $fields[] = "name=:name";
        $params[":name"] = htmlspecialchars(strip_tags($data->name));
    }
    if (isset($data->price)) {
        $fields[] = "price=:price";
        $params[":price"] = htmlspecialchars(strip_tags($data->price));
    }
    if (isset($data->description)) {
        $fields[] = "description=:description";
        $params[":description"] = htmlspecialchars(strip_tags($data->description));
    }
    if (isset($data->category_id)) {
        $fields[] = "category_id=:category_id";
        $params[":category_id"] = htmlspecialchars(strip_tags($data->category_id));
    }
    if (isset($data->image_id)) {
        $fields[] = "image_id=:image_id";
        $params[":image_id"] = $data->image_id;
    }
    if (isset($data->kcal)) {
        $fields[] = "kcal=:kcal";
        $params[":kcal"] = $data->kcal;
    }
    if (isset($data->available)) {
        $fields[] = "available=:available";
        $params[":available"] = $data->available;
    }

    if (count($fields) > 0) {
        $query = "UPDATE products SET " . implode(", ", $fields) . " WHERE product_id = :id";

        $stmt = $db->prepare($query);

        if ($stmt->execute($params)) {
            http_response_code(200);
            echo json_encode(array("message" => "Product was updated."));
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Unable to update product."));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "No data provided for update."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to update product. ID is missing."));
}
?>