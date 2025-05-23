<?php
$errors = [];
$name = $business = $contact = $category = $price = $description = $availability = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['seller_name']);
    $business = trim($_POST['business_name']);
    $contact = trim($_POST['contact_number']);
    $category = $_POST['pet_category'];
    $price = trim($_POST['price_range']);
    $description = trim($_POST['description']);
    $availability = isset($_POST['availability']) ? $_POST['availability'] : '';

    if (empty($name) || empty($business) || empty($contact) || empty($category) || empty($price) || empty($description) || empty($availability)) {
        $errors[] = "Please fill in all the fields.";
    }

    if (strlen($name) < 3) {
        $errors[] = "Full Name must be at least 3 characters long.";
    }

    if (!preg_match('/^\d{11}$/', $contact)) {
        $errors[] = "Contact Number must be exactly 11 digits.";
    }

    if (!is_numeric($price) || $price < 1) {
        $errors[] = "Price must be a number greater than 0.";
    }

    if (empty($errors)) {
        echo "<p style='color: green; text-align: center;'>Form submitted successfully!</p>";
        $name = $business = $contact = $category = $price = $description = $availability = "";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pet Valley</title>
    <link rel="stylesheet" href="../../styles/seller.css">
</head>
<body>
    <h1>Welcome to the official website of Pet Valley</h1>
    <h2>Biggest Marketplace to buy or sell pets</h2>
    <h3>Please fill up the form to sell your pets</h3>

    <?php
    if (!empty($errors)) {
        echo "<ul style='color: red;'>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
    ?>

    <form method="POST">
        <fieldset>
            <legend><strong>Seller Registration</strong></legend>
            <table>
                <tr>
                    <td><label for="seller_name">Full Name:</label></td>
                    <td><input type="text" id="seller_name" name="seller_name" value="<?php echo htmlspecialchars($name); ?>"></td>
                </tr>
                <tr>
                    <td><label for="business_name">Business Name:</label></td>
                    <td><input type="text" id="business_name" name="business_name" value="<?php echo htmlspecialchars($business); ?>"></td>
                </tr>
                <tr>
                    <td><label for="contact_number">Contact Number:</label></td>
                    <td><input type="text" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($contact); ?>"></td>
                </tr>
                <tr>
                    <td><label for="pet_category">Pet Category:</label></td>
                    <td>
                        <select id="pet_category" name="pet_category">
                            <option value="">--Select--</option>
                            <option value="mammals" <?php if ($category == 'mammals') echo 'selected'; ?>>Mammals</option>
                            <option value="birds" <?php if ($category == 'birds') echo 'selected'; ?>>Birds</option>
                            <option value="reptiles" <?php if ($category == 'reptiles') echo 'selected'; ?>>Reptiles</option>
                            <option value="aquatic" <?php if ($category == 'aquatic') echo 'selected'; ?>>Aquatic</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="price_range">Price Range:</label></td>
                    <td><input type="text" id="price_range" name="price_range" value="<?php echo htmlspecialchars($price); ?>"></td>
                </tr>
                <tr>
                    <td><label for="description">Description:</label></td>
                    <td><textarea id="description" name="description" rows="3"><?php echo htmlspecialchars($description); ?></textarea></td>
                </tr>
                <tr>
                    <td><label>Availability:</label></td>
                    <td>
                        <input type="radio" id="available" name="availability" value="available" <?php if ($availability == 'available') echo 'checked'; ?>>
                        <label for="available">Available</label><br>
                        <input type="radio" id="not_available" name="availability" value="not_available" <?php if ($availability == 'not_available') echo 'checked'; ?>>
                        <label for="not_available">Not Available</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button type="submit">Register</button>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>

    <script src="../js/validation.js"></script>
</body>
</html>
