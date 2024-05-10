<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Check if the product ID is set in the POST data
$productName = ''; 
if (isset($_POST["productName"])) {
$productName = $_POST["productName"];
}
$productPrice = 0;
if (isset($_POST["price"])) {
$productPrice = $_POST["price"];
}
$productId = 0;
if (isset($_POST["product_id"])) {
$productId = $_POST["product_id"];
}
$buyer = 'user1';
require "dbconn.php";


$sql = "INSERT INTO add_to_cart (id, product_name, price, buyer) VALUES ('$productId', '$productName', '$productPrice', '$buyer')";

// Execute the query
if (mysqli_query($conn, $sql)) {
// If the query was successful, return success message
echo "Product added to cart successfully!";
} else {
// If the query fails, return an error message
echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
} else {
// If product_id is not set in POST data, return an error message
echo "Error: Product ID is not set";
}
// } else {
// // If the request method is not POST, return an error message
// echo "Error: Invalid request method";
// }
?>

