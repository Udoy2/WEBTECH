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
        input[type="tel"],
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
    <h3>Please fill up the form to sell your pets</h3>

    <form action="register.php" method="POST" onsubmit="return validateForm()">
        <fieldset>
            <legend><strong>Seller Registration</strong></legend>
            <table>
                <tr>
                    <td><label for="seller_name">Full Name:</label></td>
                    <td><input type="text" id="seller_name" name="seller_name"></td>
                </tr>
                <tr>
                    <td><label for="business_name">Business Name:</label></td>
                    <td><input type="text" id="business_name" name="business_name"></td>
                </tr>
                <tr>
                    <td><label for="contact_number">Contact Number:</label></td>
                    <td><input type="text" id="contact_number" name="contact_number"></td>
                </tr>
                <tr>
                    <td><label for="pet_category">Pet Category:</label></td>
                    <td>
                        <select id="pet_category" name="pet_category">
                            <option value="">--Select--</option>
                            <option value="mammals">Mammals</option>
                            <option value="birds">Birds</option>
                            <option value="reptiles">Reptiles</option>
                            <option value="aquatic">Aquatic</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="price_range">Price Range:</label></td>
                    <td><input type="text" id="price_range" name="price_range"></td>
                </tr>
                <tr>
                    <td><label for="description">Description:</label></td>
                    <td><textarea id="description" name="description" rows="3"></textarea></td>
                </tr>
                <tr>
                    <td><label>Availability:</label></td>
                    <td>
                        <input type="radio" id="available" name="availability" value="available">
                        <label for="available">Available</label><br>
                        <input type="radio" id="not_available" name="availability" value="not_available">
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

    <script>
        function validateForm() {
            var name = document.getElementById('seller_name').value.trim();
            var business = document.getElementById('business_name').value.trim();
            var contact = document.getElementById('contact_number').value.trim();
            var category = document.getElementById('pet_category').value;
            var price = document.getElementById('price_range').value.trim();
            var description = document.getElementById('description').value.trim();
            var availability = document.querySelector('input[name="availability"]:checked');

            if (name === "" || business === "" || contact === "" || category === "" || price === "" || description === "" || !availability) {
                alert("Please fill in all the fields.");
                return false;
            }

            if (name.length < 3) {
                alert("Full Name must be at least 3 characters long.");
                return false;
            }

            if (!/^\d{11}$/.test(contact)) {
                alert("Contact Number must be exactly 11 digits.");
                return false;
            }

            if (isNaN(price) || Number(price) < 1) {
                alert("Price must be a number greater than 0.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
