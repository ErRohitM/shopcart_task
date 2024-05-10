<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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


if (mysqli_query($conn, $sql)) {

echo "Product added to cart successfully!";
} else {

echo "Error: " . mysqli_error($conn);
}


mysqli_close($conn);
} else {

echo "Error: Product ID is not set";
}

?>

