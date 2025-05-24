<?php
session_start();
include '../db/db.php';  // Your DB connection file

$name = $email = $gender = $address = "";
$pet = "";
$desired_items = [];
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $pet = $_POST['pet'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $address = trim($_POST['address']);
    $desired_items = $_POST['desired_items'] ?? [];

    // Validate inputs
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    if (empty($errors)) {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM buyers WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = "Email is already registered";
            $stmt->close();
        } else {
            $stmt->close();
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Convert desired items array to string
            $items = implode(',', $desired_items);

            // Insert buyer into database
            $stmt = $conn->prepare("INSERT INTO buyers (name, email, password, pet, gender, address, desired_items) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $name, $email, $hashed_password, $pet, $gender, $address, $items);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Registered successfully! Please login.";
                header("Location: login.php");
                exit();
            } else {
                $errors[] = "Registration failed. Please try again.";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pet Valley - Register</title>
    <link rel="stylesheet" href="../assets/buyerstyle.css">
</head>
<body>
    <h1>Welcome to Pet Valley</h1>
    <h2>Biggest Marketplace to buy or sell pets</h2>
    <h3>Please fill up the form to get new pets</h3>

    <div id="error" class="error">
        <?php
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo htmlspecialchars($error) . "<br>";
            }
        }
        ?>
    </div>

    <form method="POST" action="">
        <fieldset>
            <legend><strong>Buyer Registration</strong></legend>
            <table>
                <tr>
                    <td><label for="name">Full Name:</label></td>
                    <td><input type="text" id="name" name="name" class="form-input" value="<?php echo htmlspecialchars($name); ?>"></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email" class="form-input" value="<?php echo htmlspecialchars($email); ?>"></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" class="form-input" required></td>
                </tr>
                <tr>
                    <td><label for="confirm_password">Confirm Password:</label></td>
                    <td><input type="password" id="confirm_password" name="confirm_password" class="form-input" required></td>
                </tr>
                <tr>
                    <td><label for="pet">Select Pet Type:</label></td>
                    <td>
                        <select id="pet" name="pet" class="form-input">
                            <optgroup label="Mammals">
                                <option value="dog" <?php if ($pet == 'dog') echo 'selected'; ?>>Dog</option>
                                <option value="cat" <?php if ($pet == 'cat') echo 'selected'; ?>>Cat</option>
                            </optgroup>
                            <optgroup label="Birds">
                                <option value="parrot" <?php if ($pet == 'parrot') echo 'selected'; ?>>Parrot</option>
                                <option value="pigeon" <?php if ($pet == 'pigeon') echo 'selected'; ?>>Pigeon</option>
                            </optgroup>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Gender:</label></td>
                    <td>
                        <input type="radio" name="gender" value="male" id="male" class="form-radio" <?php if ($gender == 'male') echo 'checked'; ?>>
                        <label for="male">Male</label>
                        <input type="radio" name="gender" value="female" id="female" class="form-radio" <?php if ($gender == 'female') echo 'checked'; ?>>
                        <label for="female">Female</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><textarea id="address" name="address" rows="3" class="form-input"><?php echo htmlspecialchars($address); ?></textarea></td>
                </tr>
                <tr>
                    <td><label for="desired_items">Select Desired Items:</label></td>
                    <td>
                        <input type="checkbox" id="pets" name="desired_items[]" value="pets" class="form-checkbox" <?php if (in_array('pets', $desired_items)) echo 'checked'; ?>>
                        <label for="pets">Pets</label><br>
                        <input type="checkbox" id="pet_food" name="desired_items[]" value="pet_food" class="form-checkbox" <?php if (in_array('pet_food', $desired_items)) echo 'checked'; ?>>
                        <label for="pet_food">Pet Food</label><br>
                        <input type="checkbox" id="pet_accessories" name="desired_items[]" value="pet_accessories" class="form-checkbox" <?php if (in_array('pet_accessories', $desired_items)) echo 'checked'; ?>>
                        <label for="pet_accessories">Pet Accessories</label><br>
                        <input type="checkbox" id="pet_nest" name="desired_items[]" value="pet_nest" class="form-checkbox" <?php if (in_array('pet_nest', $desired_items)) echo 'checked'; ?>>
                        <label for="pet_nest">Pet Nest</label>
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
</body>
</html>
