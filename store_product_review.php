<?php
// including the database connection file
require 'db.php';

// Initialize the response array
$response = [];


// Check if the request method is POST or not
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $response = [
        "status" => "failed",
        "message" => "Method not allowed!",
        "error" => null
    ];
    echo json_encode($response);
    exit;
}

// Get the raw JSON input or form input data
$json_data = file_get_contents("php://input");
if (empty($json_data) && !empty($_POST)) {
    $json_data = json_encode($_POST);
}

if (empty($json_data)) {
    $response = [
        "status" => "failed",
        "message" => "No data provided!",
        "error" => null,
    ];
    echo json_encode($response);
    exit;
}

// Convert the data as an associative array
$data = json_decode($json_data, true);

// Check all required fields are present or not
$required_fields = ['product_id', 'user_id', 'review'];
foreach ($required_fields as $field) {
    if (!isset($data[$field]) || empty($data[$field])) {
        $response = [
            "status" => "failed",
            "message" => "The field '{$field}' is required!",
            "error" => null,
        ];
        echo json_encode($response);
        exit;
    }
}

// Input validation
$user_id = $data['user_id'];
$product_id = $data['product_id'];
$review = $data['review'];

if (!is_numeric($user_id)) {
    $response = [
        "status" => "failed",
        "message" => "User id should be an integer.",
        "error" => null,
    ];
} else if (!is_numeric($product_id)) {
    $response = [
        "status" => "failed",
        "message" => "Product id should be an integer.",
        "error" => null,
    ];
}

if(!empty($response)){
    echo json_encode($response);
    exit;
}

// Insert review data into database
try {
    $stmt = $conn->prepare("INSERT INTO reviews (user_id, product_id, review) VALUES (:user_id, :product_id, :review)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':review', $review);
    $stmt->execute();

    $response = [
        "status" => "success",
        "message" => "Review submitted successfully.",
        "error" => null
    ];
} catch (Exception $e) {
    $response = [
        "status" => "failed",
        "message" => "Request failed!",
        "error" => $e->getMessage()
    ];
} finally {
    echo json_encode($response);
}
?>
