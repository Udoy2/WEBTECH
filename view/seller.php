<html>
<head>
    <title>Pet Valley</title>
    <link rel="stylesheet" href="../styles/seller.css">

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

    <script src="../js/validation.js"></script>
</body>
</html>
