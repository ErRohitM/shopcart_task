<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["productId"])) {
        require "dbconn.php";

        $productId = mysqli_real_escape_string($conn, $_POST["productId"]);

        $sql = "SELECT * FROM `product_details` WHERE id = $productId";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            
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


            echo $modalContent;
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Error: Product ID is not set";
    }
} else {
    echo "Error: Invalid request method";
}
?>
