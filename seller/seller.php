<?php
session_start();
if (!isset($_SESSION['buyer_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pet Valley - Products</title>
    <link rel="stylesheet" href="../assets/dashboardstyle.css">
    <style>
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px;
            width: 200px;
            text-align: center;
            background-color: #fff;
        }
        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 4px;
        }
        .product-card h4 {
            margin: 10px 0 5px;
        }
        .product-card p {
            margin: 5px 0;
        }
        .product-card form {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<header>
    <div class="header-container">
        <h1>Pet Valley</h1>
        <nav class="nav-buttons">
            <a href="profile.php" class="btn">My Profile</a>
            <a href="cart.php" class="btn">Go to Cart</a>
            <a href="logout.php" class="btn btn-logout">Logout</a>
        </nav>
    </div>
</header>
<main>
    <section class="dashboard-content">
        <h2>Available Pets</h2>
        <div class="product-grid">
            <?php
            $pets = [
                ['name' => 'Golden Retriever', 'price' => 500, 'image' => 'dog1.jpg'],
                ['name' => 'Persian Cat', 'price' => 300, 'image' => 'cat1.jpg'],
                // Add more pet products here
            ];
            foreach ($pets as $pet) {
                echo '<div class="product-card">';
                echo '<img src="../assets/pets/' . $pet['image'] . '" alt="' . $pet['name'] . '">';
                echo '<h4>' . $pet['name'] . '</h4>';
                echo '<p>Price: $' . $pet['price'] . '</p>';
                echo '<form method="post" action="add_to_cart.php">';
                echo '<input type="hidden" name="product_name" value="' . $pet['name'] . '">';
                echo '<input type="hidden" name="price" value="' . $pet['price'] . '">';
                echo '<button type="submit" class="btn">Add to Cart</button>';
                echo '</form>';
                echo '</div>';
            }
            ?>
        </div>

        <h2>Accessories & Nests</h2>
        <div class="product-grid">
            <?php
            $accessories = [
                ['name' => 'Bird Nest', 'price' => 50, 'image' => 'nest1.jpg'],
                ['name' => 'Cat Toy', 'price' => 20, 'image' => 'accessory1.jpg'],
                // Add more accessory products here
            ];
            foreach ($accessories as $item) {
                echo '<div class="product-card">';
                echo '<img src="../assets/pets/' . $item['image'] . '" alt="' . $item['name'] . '">';
                echo '<h4>' . $item['name'] . '</h4>';
                echo '<p>Price: $' . $item['price'] . '</p>';
                echo '<form method="post" action="add_to_cart.php">';
                echo '<input type="hidden" name="product_name" value="' . $item['name'] . '">';
                echo '<input type="hidden" name="price" value="' . $item['price'] . '">';
                echo '<button type="submit" class="btn">Add to Cart</button>';
                echo '</form>';
                echo '</div>';
            }
            ?>
        </div>
    </section>
</main>
</body>
</html>
