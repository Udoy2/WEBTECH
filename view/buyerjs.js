function validateForm() {
  const name = document.getElementById("name").value;
  const email = document.getElementById("email").value;
  const address = document.getElementById("address").value;
  const genderSelected = document.querySelector(".form-radio:checked");

  const errorDiv = document.getElementById("error");
  errorDiv.innerText = "";

  let errorMessage = "";

  if (!name || name.length < 3) {
    errorMessage += "Name must be at least 3 characters long.\n";
  }

  if (!email || !email.includes("gmail")) {
    errorMessage += "Please give a valid email.\n";
  }

  if (!address) {
    errorMessage += "Address is required.\n";
  }

  if (!genderSelected) {
    errorMessage += "Please select a gender.\n";
  }

  if (errorMessage) {
    errorDiv.innerText = errorMessage;
    return false;
  }

  return true;
}
