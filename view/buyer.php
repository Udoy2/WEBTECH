<html>
<head>
    <title>Pet Valley</title>
</head>
<body>
    <h1>Welcome to the official website of Pet Valley</h1>
    <h2>Biggest Marketplace to buy or sell pets</h2>
    <h3>Please fill up the form to get new pets</h3>

    <form action="register.php" method="POST">
        <fieldset>
            <legend>Buyer Registration</legend>
            <table>
                <tr>
                    <td><label for="name">Full Name:</label></td>
                    <td><input type="text" id="name" name="name" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email" required></td>
                </tr>
                <tr>
                    <td><label for="pet">Select Pet Type:</label></td>
                    <td>
                        <select id="pet" name="pet">
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
                        <input type="radio" name="gender" value="male" id="male">
                        <label for="male">Male</label>
                        <input type="radio" name="gender" value="female" id="female">
                        <label for="female">Female</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><textarea id="address" name="address" rows="3" required></textarea></td>
                </tr>
                <tr>
                    <td><label for="desired_items">Select Desired Items:</label></td>
                    <td>
                        <input type="checkbox" id="pets" name="desired_items" value="pets">
                        <label for="pets">Pets</label><br>
                        <input type="checkbox" id="pet_food" name="desired_items" value="pet_food">
                        <label for="pet_food">Pet Food</label><br>
                        <input type="checkbox" id="pet_accessories" name="desired_items" value="pet_accessories">
                        <label for="pet_accessories">Pet Accessories</label><br>
                        <input type="checkbox" id="pet_nest" name="desired_items" value="pet_nest">
                        <label for="pet_nest">Pet Nest</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="quantity">Number of Pets:</label></td>
                    <td>
                        <input type="range" id="quantity" name="quantity" min="1" max="5" oninput="output.value = quantity.value">
                        <output id="output">3</output>
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
