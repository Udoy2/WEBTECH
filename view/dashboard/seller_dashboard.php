<?php
session_start();
require_once '../../model/PostModel.php';

// Check if user is logged in and is a seller
if (!isset($_SESSION['user_id']) || $_SESSION['userType'] !== 'seller') {
    header("Location: ../auth/login.php");
    exit();
}

$posts = getSellerPostsByUserId($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard - Pet Valley</title>
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/dashboard.css">
</head>
<body>
    <?php include_once '../component/navbar.php'; ?>

    <div class="dashboard-container">
        <h1>Seller Dashboard</h1>
        <a href="../post/seller.php" class="add-post-btn">Add New Post</a>

        <?php if (isset($_SESSION['dashboard_message'])): ?>
            <div class="success-message">
                <?php 
                    echo $_SESSION['dashboard_message'];
                    unset($_SESSION['dashboard_message']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['dashboard_error'])): ?>
            <div class="error-message">
                <?php 
                    echo $_SESSION['dashboard_error'];
                    unset($_SESSION['dashboard_error']);
                ?>
            </div>
        <?php endif; ?>

        <div class="posts-grid">
            <?php foreach ($posts as $post): ?>
                <div class="post-card">
                    <img 
                        src="../../<?php echo htmlspecialchars($post['image_path']); ?>" 
                        alt="<?php echo htmlspecialchars($post['business_name']); ?>"
                        class="post-image"
                    >
                    <div class="post-info">
                        <h3><?php echo htmlspecialchars($post['business_name']); ?></h3>
                        <p class="category"><?php echo htmlspecialchars($post['pet_category']); ?></p>
                        <p class="price"><?php echo htmlspecialchars($post['price_range']); ?></p>
                        <p class="description"><?php echo htmlspecialchars($post['description']); ?></p>
                        <span class="availability <?php echo $post['availability']; ?>">
                            <?php echo ucfirst($post['availability']); ?>
                        </span>
                        
                        <div class="post-actions">
                            <button onclick="editPost(<?php echo $post['id']; ?>)" class="edit-btn">Edit</button>
                            <button onclick="deletePost(<?php echo $post['id']; ?>)" class="delete-btn">Delete</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include_once '../component/footer.php'; ?>

    <script>
        function deletePost(postId) {
            if (confirm('Are you sure you want to delete this post?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '../../control/dashboard/SellerDashboardController.php';
                
                const actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = 'delete';
                
                const postIdInput = document.createElement('input');
                postIdInput.type = 'hidden';
                postIdInput.name = 'post_id';
                postIdInput.value = postId;
                
                form.appendChild(actionInput);
                form.appendChild(postIdInput);
                document.body.appendChild(form);
                form.submit();
            }
        }

        function editPost(postId) {
            window.location.href = `edit_post.php?id=${postId}`;
        }
    </script>
</body>
</html>