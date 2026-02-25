<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (
    !empty($data->name) &&
    !empty($data->price) &&
    !empty($data->category_id)
) {
    // set product property values
    $name = $data->name;
    $price = $data->price;
    $description = !empty($data->description) ? $data->description : "";
    $category_id = $data->category_id;
    $image_id = !empty($data->image_id) ? $data->image_id : NULL;
    $kcal = !empty($data->kcal) ? $data->kcal : NULL;
    $available = isset($data->available) ? $data->available : 1;

    // query to insert record
    $query = "INSERT INTO products 
                SET 
                    name=:name, 
                    price=:price, 
                    description=:description, 
                    category_id=:category_id, 
                    image_id=:image_id, 
                    kcal=:kcal, 
                    available=:available";

    // prepare query
    $stmt = $db->prepare($query);

    // sanitize
    $name = htmlspecialchars(strip_tags($name));
    $price = htmlspecialchars(strip_tags($price));
    $description = htmlspecialchars(strip_tags($description));
    $category_id = htmlspecialchars(strip_tags($category_id));

    // bind values
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":price", $price);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":category_id", $category_id);
    $stmt->bindParam(":image_id", $image_id);
    $stmt->bindParam(":kcal", $kcal);
    $stmt->bindParam(":available", $available);

    // execute query
    if ($stmt->execute()) {
        // set response code - 201 created
        http_response_code(201);
        echo json_encode(array("message" => "Product was created.", "id" => $db->lastInsertId()));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create product."));
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>