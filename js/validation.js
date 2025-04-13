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