<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the product ID is set in the POST data
    if (isset($_POST["productId"])) {
        // Include the database connection file
        require "dbconn.php";

        // Sanitize the input to prevent SQL injection
        $productId = mysqli_real_escape_string($conn, $_POST["productId"]);

        // Construct the SQL query
        $sql = "SELECT * FROM `product_details` WHERE id = $productId";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if ($result) {
            // Fetch the data
            $row = mysqli_fetch_assoc($result);
            
            // Format the data into HTML for modal display
            $modalContent = '
                <div class="modal">
                    <div class="modal-content" id="detailed_product_' . $row['id'] . '">
                        <span class="close" id="close_modal">&times;</span>
                        <img src="products/cart.png" alt="Product Image" style="width:100px;">
                        <h2 id="detailed_product_name_' . $row['id'] . '">' . $row['product_name'] . '</h2>
                        <p id="detailed_product_price_' . $row['id'] . '">Price: $' . $row['price'] . '</p>
                        <button onclick="addToCart(' . $row['id'] . ');">Add to Cart</button>
                        <button onclick="buyNow(' . $row['id'] . ');">Buy Now</button>
                        <!-- Add more details as needed -->
                    </div>
                </div>
            ';


            // Return the modal content as the response
            echo $modalContent;
        } else {
            // If the query fails, return an error message
            echo "Error: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        // If productId is not set in POST data, return an error message
        echo "Error: Product ID is not set";
    }
} else {
    // If the request method is not POST, return an error message
    echo "Error: Invalid request method";
}
?>
