 <?php
class CartModel {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

   public function saveOrders($cartItems, $buyer_id) {
    $stmt = $this->conn->prepare("INSERT INTO orders (buyer_id, product_name, quantity, price) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Prepare failed: (" . $this->conn->errno . ") " . $this->conn->error);
    }

    foreach ($cartItems as $item) {
        $stmt->bind_param("isid", $buyer_id, $item['product_name'], $item['quantity'], $item['price']);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        }
    }
    $stmt->close();
}


}
