<?php include("../../control/validation.php"); ?>

<html>
<head>
    <title>Pet Valley</title>
    <link rel="stylesheet" href="../../styles/buyer.css">
</head>
<body>
    <h1>Welcome to the official website of Pet Valley</h1>
    <h2>Biggest Marketplace to buy or sell pets</h2>
    <h3>Please fill up the form to get new pets</h3>

    <div id="error" class="error">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo htmlspecialchars($error) . "<br>";
                }
            } elseif (isset($successMessage)) {
                echo "<span style='color:green;'>$successMessage</span>";
            }
        }
        ?>
    </div>

    <form method="POST">
        <fieldset>
            <legend><strong>Buyer Registration</strong></legend>
            <table>
                <tr>
                    <td><label for="name">Full Name:</label></td>
                    <td><input type="text" id="name" name="name" class="form-input" value="<?php echo $name; ?>"></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="text" id="email" name="email" class="form-input" value="<?php echo $email; ?>"></td>
                </tr>
                <tr>
                    <td><label for="pet">Select Pet Type:</label></td>
                    <td>
                        <select id="pet" name="pet" class="form-input">
                            <optgroup label="Mammals">
                                <option value="dog">Dog</option>
                                <option value="cat">Cat</option>
                            </optgroup>
                            <optgroup label="Birds">
                                <option value="parrot">Parrot</option>
                                <option value="pigeon">Pigeon</option>
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
                    <td><textarea id="address" name="address" rows="3" class="form-input"><?php echo $address; ?></textarea></td>
                </tr>
                <tr>
                    <td><label for="desired_items">Select Desired Items:</label></td>
                    <td>
                        <input type="checkbox" id="pets" name="desired_items[]" value="pets" class="form-checkbox">
                        <label for="pets">Pets</label><br>
                        <input type="checkbox" id="pet_food" name="desired_items[]" value="pet_food" class="form-checkbox">
                        <label for="pet_food">Pet Food</label><br>
                        <input type="checkbox" id="pet_accessories" name="desired_items[]" value="pet_accessories" class="form-checkbox">
                        <label for="pet_accessories">Pet Accessories</label><br>
                        <input type="checkbox" id="pet_nest" name="desired_items[]" value="pet_nest" class="form-checkbox">
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
