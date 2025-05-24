<?php

session_start();
if (!isset($_SESSION['buyer_id'])) {
    header("Location: ./login.php");
    exit();
}

include '../db/db.php';

$id = $_SESSION['buyer_id'];
$query = "SELECT * FROM buyers WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$buyer = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<head>
    <title>Pet Valley Dashboard</title>
    <link rel="stylesheet" href="./dashboardstyle.css" />
</head>
<body>
<header>
    <div class="header-container">
        <h1>Pet Valley Dashboard</h1>
        <nav class="nav-buttons">
           <a href="./profile.php" class="btn">My Profile</a>
          <a href="./cart.php" class="btn">Go to Cart</a>
           <a href="../control/logoutcontrol.php" class="btn btn-logout">Logout</a>
        </nav>
    </div>
</header>

<main>
<section class="dashboard-content">
    <h2>Welcome, <?php echo htmlspecialchars($buyer['name']); ?>!</h2>
    <p>Email: <?php echo htmlspecialchars($buyer['email']); ?></p>
    <p>Pet Interested: <?php echo htmlspecialchars($buyer['pet']); ?></p>
    <p>Items: <?php echo htmlspecialchars($buyer['desired_items']); ?></p>

    <h2>Available Pets</h2>
    <div class="product-grid">
        <?php
        
            $pets = [
    ['name' => 'Golden Retriever', 'price' => 500, 'image' => 'dog1.jpg'],
    ['name' => 'Persian Cat', 'price' => 300, 'image' => 'cat1.jpg'],
    ['name' => 'German Shepherd', 'price' => 550, 'image' => 'dog2.jpg'],
    ['name' => 'Siamese Cat', 'price' => 320, 'image' => 'cat2.jpg'],
    ['name' => 'Parrot', 'price' => 150, 'image' => 'bird1.jpg'],
    ['name' => 'Labrador', 'price' => 480, 'image' => 'dog3.jpg'],
    ['name' => 'British Shorthair', 'price' => 350, 'image' => 'cat3.jpg'],
    ['name' => 'Macaw', 'price' => 600, 'image' => 'bird2.jpg'],
    ['name' => 'Beagle', 'price' => 450, 'image' => 'dog4.jpg'],
    ['name' => 'Cockatiel', 'price' => 200, 'image' => 'bird3.jpg']
            ];
       
        foreach ($pets as $pet) {
            echo '<div class="product-card">';
            echo '<img src="../assets/pets/' . htmlspecialchars($pet['image']) . '" alt="' . htmlspecialchars($pet['name']) . '">';
            echo '<h4>' . htmlspecialchars($pet['name']) . '</h4>';
            echo '<p>Price: $' . htmlspecialchars($pet['price']) . '</p>';
            echo '<form method="post" action="../control/add_to_cart.php">';
            echo '<input type="hidden" name="product_name" value="' . htmlspecialchars($pet['name']) . '">';
            echo '<input type="hidden" name="price" value="' . htmlspecialchars($pet['price']) . '">';
            echo '<button type="submit" class="btn">Add to Cart</button>';
            echo '</form>';
            echo '</div>';
        }
        ?>
    </div>

    <h2 style="margin-top: 40px;">Accessories & Nests</h2>
    <div class="product-grid">
        <?php
        $accessories = [
    ['name' => 'Bird Nest', 'price' => 50, 'image' => 'nest1.jpg'],
    ['name' => 'Cat Toy', 'price' => 20, 'image' => 'accessory1.jpg'],
    ['name' => 'Dog Leash', 'price' => 25, 'image' => 'accessory2.jpg'],
    ['name' => 'Pet Bed', 'price' => 60, 'image' => 'accessory3.jpg'],
    ['name' => 'Scratching Post', 'price' => 45, 'image' => 'accessory4.jpg'],
    ['name' => 'Bird Feeder', 'price' => 30, 'image' => 'accessory5.jpg'],
    ['name' => 'Chew Toy', 'price' => 15, 'image' => 'accessory6.jpg'],
    ['name' => 'Pet Carrier', 'price' => 80, 'image' => 'accessory7.jpg'],
    ['name' => 'Litter Box', 'price' => 40, 'image' => 'accessory8.jpg'],
    ['name' => 'Food Bowl', 'price' => 10, 'image' => 'accessory9.jpg']
];

        foreach ($accessories as $item) {
            echo '<div class="product-card">';
            echo '<img src="../assets/pets/' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['name']) . '">';
            echo '<h4>' . htmlspecialchars($item['name']) . '</h4>';
            echo '<p>Price: $' . htmlspecialchars($item['price']) . '</p>';
            echo '<form method="post" action="../control/add_to_cart.php">';
            echo '<input type="hidden" name="product_name" value="' . htmlspecialchars($item['name']) . '">';
            echo '<input type="hidden" name="price" value="' . htmlspecialchars($item['price']) . '">';
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
