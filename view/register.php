<?php
session_start();
$data = $_SESSION['register_data'] ?? [];
$name = $data['name'] ?? '';
$email = $data['email'] ?? '';
$pet = $data['pet'] ?? '';
$gender = $data['gender'] ?? '';
$address = $data['address'] ?? '';
$desired_items = $data['desired_items'] ?? [];
$errors = $data['errors'] ?? [];
unset($_SESSION['register_data']); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pet Valley - Register</title>
    <link rel="stylesheet" href="./buyerstyle.css">
</head>
<body>
    <h1>Welcome to Pet Valley</h1>
    <h2>Biggest Marketplace to buy or sell pets</h2>
    <h3>Please fill up the form to get new pets</h3>

    <div id="error" class="error">
        <?php
        foreach ($errors as $error) {
            echo htmlspecialchars($error) . "<br>";
        }
        ?>
    </div>

    <form method="POST" action="../control/registercontroller.php">
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
                        <input type="radio" name="gender" value="male" id="male" <?php if ($gender == 'male') echo 'checked'; ?>>
                        <label for="male">Male</label>
                        <input type="radio" name="gender" value="female" id="female" <?php if ($gender == 'female') echo 'checked'; ?>>
                        <label for="female">Female</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><textarea id="address" name="address" rows="3"><?php echo htmlspecialchars($address); ?></textarea></td>
                </tr>
                <tr>
                    <td><label for="desired_items">Select Desired Items:</label></td>
                    <td>
                        <?php
                        $items = ['pets', 'pet_food', 'pet_accessories', 'pet_nest'];
                        foreach ($items as $item) {
                            $checked = in_array($item, $desired_items) ? 'checked' : '';
                            echo "<input type='checkbox' name='desired_items[]' value='$item' $checked> <label>" . ucwords(str_replace('_', ' ', $item)) . "</label><br>";
                        }
                        ?>
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
