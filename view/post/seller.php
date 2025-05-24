<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}
// Display errors if any
$errors = isset($_SESSION['seller_errors']) ? $_SESSION['seller_errors'] : [];
unset($_SESSION['seller_errors']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pet Valley</title>
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/seller.css">
</head>
<body>
    <?php include_once '../component/navbar.php'; ?>
    <h1 style="margin-top: 5rem;">Welcome to the official website of Pet Valley</h1>
    <h2>Biggest Marketplace to buy or sell pets</h2>
    <h3>Please fill up the form to sell your pets</h3>

    <?php if (!empty($errors)): ?>
        <div class="error-message">
            <ul>
                <?php foreach($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="../../control/post/SellerController.php" enctype="multipart/form-data">
        <fieldset>
            <legend><strong>Seller Registration</strong></legend>
            <table>
                <tr>
                    <td><label for="seller_name">Full Name:</label></td>
                    <td><input type="text" id="seller_name" name="seller_name" ></td>
                </tr>
                <tr>
                    <td><label for="business_name">Business Name:</label></td>
                    <td><input type="text" id="business_name" name="business_name" ></td>
                </tr>
                <tr>
                    <td><label for="contact_number">Contact Number:</label></td>
                    <td><input type="text" id="contact_number" name="contact_number" ></td>
                </tr>
                <tr>
                    <td><label for="pet_category">Pet Category:</label></td>
                    <td>
                        <select id="pet_category" name="pet_category">
                            <option value="">--Select--</option>
                            <option value="mammals" >Mammals</option>
                            <option value="birds" >Birds</option>
                            <option value="reptiles" >Reptiles</option>
                            <option value="aquatic" >Aquatic</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="price_range">Price Range:</label></td>
                    <td><input type="text" id="price_range" name="price_range" ></td>
                </tr>
                <tr>
                    <td><label for="description">Description:</label></td>
                    <td><textarea id="description" name="description" rows="3"></textarea></td>
                </tr>
                <tr>
                    <td><label>Availability:</label></td>
                    <td>
                        <input type="radio" id="available" name="availability" value="available" >
                        <label for="available">Available</label><br>
                        <input type="radio" id="not_available" name="availability" value="not_available">
                        <label for="not_available">Not Available</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="pet_image">Pet Image:</label></td>
                    <td><input type="file" id="pet_image" name="pet_image" required accept="image/*"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button type="submit">Register</button>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
    <?php include_once '../component/footer.php'; ?>
    <script src="../js/validation.js"></script>
</body>
</html>

