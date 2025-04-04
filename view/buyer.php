
<html>
<head>
    <title>Pet Valley</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fefefe;
            margin: 0;
            padding: 20px;
        }

        h1, h2, h3 {
            text-align: center;
            color: #333;
        }

        form {
            width: 50%;
            margin: 0 auto;
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        legend {
            text-align: center;
            font-size: 1.2em;
            margin-bottom: 10px;
            width: 100%;
        }


        fieldset {
            border: none;
        }

        table {
            width: 100%;
        }

        td {
            padding: 10px;
            vertical-align: top;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 5px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Welcome to the official website of Pet Valley</h1>
    <h2>Biggest Marketplace to buy or sell pets</h2>
    <h3>Please fill up the form to get new pets</h3>

    <form action="register.php" method="POST">
        <fieldset>
            <legend><strong>Buyer Registration</strong></legend>
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
                    <td colspan="2" style="text-align: center;">
                        <button type="submit">Register</button>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>
</html>
