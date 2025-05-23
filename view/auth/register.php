<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PET VALLEY - REGISTER</title>
    <link rel="stylesheet" href="../../public/styles/login.css">
    <style>
        .form-select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
            background-color: white;
        }

        .form-select:focus {
            border-color: #4CAF50;
            outline: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Create Account</h1>
            <p>Join Pet Valley Today</p>
        </div>
        
        <form action="../../control/auth/RegisterControl.php" method="post">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required placeholder="Enter your full name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div>
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required placeholder="Choose a username">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required placeholder="Enter your phone number">
            </div>
            
            <div class="form-group">
                <label for="userType">Register As</label>
                <select id="userType" name="userType" class="form-select" required>
                    <option value="">Select Role</option>
                    <option value="buyer">Buyer</option>
                    <option value="seller">Seller</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Create a password">
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm your password">
            </div>
            
            <button type="submit" class="submit-btn">Create Account</button>
            
            <div class="register-link">
                <p>Already have an account? <a href="../auth/login.php">Login here</a></p>
            </div>
        </form>
    </div>
</body>
</html>