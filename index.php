<?php
session_start();
require_once './model/PostModel.php';

// Get all seller posts
$posts = getSellerPosts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Valley - Available Pets</title>
    <link rel="stylesheet" href="./public/styles/main.css">
</head>
<body>
    <?php include_once './view/component/navbar.php'; ?>

    <div class="products-container">
        <?php foreach ($posts as $post): ?>
            <div class="product-card">
                <img 
                    src="./<?php echo htmlspecialchars($post['image_path']); ?>" 
                    alt="<?php echo htmlspecialchars($post['business_name']); ?>"
                    class="product-image"
                >
                <div class="product-info">
                    <h3 class="product-title"><?php echo htmlspecialchars($post['business_name']); ?></h3>
                    <p class="product-category"><?php echo htmlspecialchars($post['pet_category']); ?></p>
                    <p class="product-price"><?php echo htmlspecialchars($post['price_range']); ?></p>
                    <p><?php echo htmlspecialchars($post['description']); ?></p>
                    <span class="product-availability <?php echo $post['availability']; ?>">
                        <?php echo ucfirst($post['availability']); ?>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php include_once './view/component/footer.php'; ?>
</body>
</html>