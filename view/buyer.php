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

            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>
            <br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br><br>

            <label for="pet">Select Pet Type:</label>
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
            <br><br>

            <label>Gender:</label>
            <input type="radio" name="gender" value="male" id="male">
            <label for="male">Male</label>
            <input type="radio" name="gender" value="female" id="female">
            <label for="female">Female</label>
            <br><br>

            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="3" required></textarea>
            <br><br>

            <label for="desired_items">Select Desired Items:</label><br>

<input type="checkbox" id="pets" name="desired_items" value="pets">
<label for="pets">Pets</label><br>

<input type="checkbox" id="pet_food" name="desired_items" value="pet_food">
<label for="pet_food">Pet Food</label><br>

<input type="checkbox" id="pet_accessories" name="desired_items" value="pet_accessories">
<label for="pet_accessories">Pet Accessories</label><br>

<input type="checkbox" id="pet_nest" name="desired_items" value="pet_nest">
<label for="pet_nest">Pet Nest</label>

            <br><br>

            <label for="quantity">Number of Pets:</label>
            <input type="range" id="quantity" name="quantity" min="1" max="5" oninput="output.value = quantity.value">
            <output id="output">3</output>
            <br><br>

            <button type="submit">Register</button>
        </fieldset>
    </form>
</body>
</html>
