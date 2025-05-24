<?php
session_start();
require_once '../../model/PostModel.php';

// Check if user is logged in and is a seller
if (!isset($_SESSION['user_id']) || $_SESSION['userType'] !== 'seller') {
    header("Location: ../auth/login.php");
    exit();
}

// Check if post ID is provided
if (!isset($_GET['id'])) {
    header("Location: ./seller_dashboard.php");
    exit();
}

// Get post details
$post = getSellerPostById($_GET['id'], $_SESSION['user_id']);

// If post doesn't exist or doesn't belong to user
if (!$post) {
    header("Location: ./seller_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - Pet Valley</title>
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/dashboard.css">
</head>
<body>
    <?php include_once '../component/navbar.php'; ?>

    <div class="dashboard-container">
        <h1>Edit Post</h1>

        <form method="POST" action="../../control/post/EditPostController.php" enctype="multipart/form-data">
            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
            <input type="hidden" name="action" value="update">

            <div class="form-group">
                <label for="seller_name">Seller Name</label>
                <input type="text" id="seller_name" name="seller_name" value="<?php echo htmlspecialchars($post['seller_name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="business_name">Business Name</label>
                <input type="text" id="business_name" name="business_name" value="<?php echo htmlspecialchars($post['business_name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="text" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($post['contact_number']); ?>" required>
            </div>

            <div class="form-group">
                <label for="pet_category">Pet Category</label>
                <select id="pet_category" name="pet_category" required>
                    <option value="dog" <?php echo $post['pet_category'] === 'dog' ? 'selected' : ''; ?>>Dog</option>
                    <option value="cat" <?php echo $post['pet_category'] === 'cat' ? 'selected' : ''; ?>>Cat</option>
                    <option value="bird" <?php echo $post['pet_category'] === 'bird' ? 'selected' : ''; ?>>Bird</option>
                </select>
            </div>

            <div class="form-group">
                <label for="price_range">Price Range</label>
                <input type="text" id="price_range" name="price_range" value="<?php echo htmlspecialchars($post['price_range']); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($post['description']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="availability">Availability</label>
                <select id="availability" name="availability" required>
                    <option value="available" <?php echo $post['availability'] === 'available' ? 'selected' : ''; ?>>Available</option>
                    <option value="not_available" <?php echo $post['availability'] === 'not_available' ? 'selected' : ''; ?>>Not Available</option>
                </select>
            </div>

            <div class="form-group">
                <label for="pet_image">Pet Image</label>
                <img src="../../<?php echo htmlspecialchars($post['image_path']); ?>" alt="Current Image" class="preview-image">
                <input type="file" id="pet_image" name="pet_image" accept="image/*">
                <small>Leave empty to keep current image</small>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">Update Post</button>
                <a href="./seller_dashboard.php" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>

    <?php include_once '../component/footer.php'; ?>
</body>
</html>