<?php require "dbconn.php" ?>
<!doctype html>
<html>
        <meta charset="UTF-8">
        <title>
            Home
        </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>  
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <style>
            body{
                margin: 0;
                font-family: Arial, sans-serif;
            }
            .navbar{
                width:100%;
                float: left;
                display: block;
                color: white;
                text-align:center;
                background-color: #333;
                padding: 40px 30px 20px 0;
                text-decoration:none;
            }
            .navbar a:hover{
                background-color:#ddd;
                color:black;
            }

            .footer{
            position: fixed;
            height: 50px;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            }
        .product_grid{
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
        }
        .product{
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .product img{
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
            object-fit: cover;
            object-position: center;
        }
        .product h2{
            margin-top: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .product p{
            font-size: 14px;
            color: #777;
        }
        .modal {
            display: none;
            position: fixed; 
            z-index: 1; 
            left: 50%; 
            top: 50%; 
            transform: translate(-50%, -50%); 
            width: 500px;
            height: 500px; 
            background-color: #fff; 
            border: 1px solid #000; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); 
        }
        .modal-content {
            padding: 20px; 
            text-align: center; 
        }

        
        .close {
            position: absolute; 
            top: 5px; 
            right: 10px; 
            cursor: pointer;
        }
        </style>
    </head>
    <body>
        <div class="navbar">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="my_cart.php">My Cart</a>
        </div>
        <div style="padding: 40px;">
            
       
            <?php 
            
            $q = "SELECT * FROM `product_details`;";
            $result = mysqli_query($conn, $q);

            if (!$result) {
                echo "Error: " . mysqli_error($conn);
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    // print_r($row);?>
                    <div class="product_grid">
                    <div class="product" id="product_<?php echo $row['id']; ?>">
                        <img src="products/cart.png" alt="Product Image">
                        <a href="#" onclick="productClicked(<?php echo $row['id']; ?>); return false;">
                            <h2><?php echo $row['product_name']; ?></h2>
                            <p><?php echo $row['price']; ?></p>
                        </a>
                    </div>
                    </div>
                    <?php

                }
            }

            mysqli_free_result($result);

            mysqli_close($conn);
            ?>
             </div>
             <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Product Details</h2>
                    <p>Description: Lorem ipsum dolor sit amet.</p>
                    <p>Price: $100</p>
                </div>
            </div>

        <div class="footer">
            <h1>About us</h1>
            <p>Quick Links</p>
            <h3>Lorem Ipsum is simply dummy</h3>
            <h4>Link1</h4>
            <h3>Lorem Ipsum is simply dummy</h3>
            <h4>Link1</h4>
            <h3>Lorem Ipsum is simply dummy</h3>
            <h4>Link1</h4>
            <h3>industry's standard dummy text ever since the 1500</h3>
            <h4>Link1</h4>

        </div>
        <script>

        $(document).ready(function() {
            $(document).on('click', function(event) {
                if ($(event.target).closest('.modal').length === 0 && !$(event.target).hasClass('modal')) {
                    $('.modal').hide();
                }
            });

            $('#close_modal').click(function() {
                $('.modal').hide();
            });
        });

    function productClicked(productId) {
        $( "#product_"+productId ).click(function( event ) {
            event.preventDefault();
            // alert(productId);

            $.ajax({
            url: 'product_details.php',
            type: 'POST',
            data: { productId: productId },
            success: function(response) {
                // Handle successful response here
                $('#myModal').html(response);
                $('.modal').show();

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

        });
    }
    $('#close_modal').click(function() {
            $('.modal').hide();
        });

        function addToCart(product_id){
            var productName = $('#detailed_product_name_' + product_id).text();
            var price = $('#detailed_product_price_' + product_id).text();
            console.log('added'+product_id);
            $( "#detailed_product_"+product_id ).click(function( event ) {
            event.preventDefault();
            // alert(productId);
            $.ajax({
            url: 'add_to_cart.php',
            type: 'POST',
            data: { 
            productId: product_id,
            productName: productName,
            price: price
            },
            success: function(response) {
                $('#myModal').html(response);
                $('.modal').show();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
            
        });


        }
        
        function buyNow(product_name){
            alert('Thank you for shopping with us! We appreciate your business and hope you enjoy your recent purchase of.'+product_name);
        }
</script>
    </body>
</html>

