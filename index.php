
<html>
<head>
    <title>Pet Valley</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fefefe;
            text-align: center;
            padding: 50px;
        }

        h1, h2, h3 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: inline-block;
            margin: 10px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 25px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Welcome to the official website of Pet Valley</h1>
    <h2>Biggest Marketplace to buy or sell pets</h2>
    <h3>Choose your role</h3>

    <form action="./view/post/seller.php" method="GET">
        <button>Seller</button>
    </form>
    
    <form action="./view/post/buyer.php" method="GET">
        <button>Buyer</button>
    </form>
</body>
</html>
