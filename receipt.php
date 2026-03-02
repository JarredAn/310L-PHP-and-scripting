<?php
session_start();

$products = [
    "xbox" => [
        "productID" => "0100",
        "name" => "Xbox Series X",
        "cost" => 499.99
    ],
    "playstation" => [
        "productID" => "0200",
        "name" => "PlayStation 5",
        "cost" => 499.99
    ],
    "nintendo" => [
        "productID" => "0300",
        "name" => "Nintendo Switch",
        "cost" => 299.99
    ],
    "psp" => [
        "productID" => "0400",
        "name" => "PlayStation Portable",
        "cost" => 149.99
    ],
    "gameboy" => [
        "productID" => "0500",
        "name" => "Game Boy Nintendo",
        "cost" => 99.99
    ]
];

$cartProducts = isset($_SESSION['products']) ? $_SESSION['products'] : [];
$subtotal = 0;

foreach ($products as $productKey => $product) {
    $quantity = isset($cartProducts[$productKey]) ? (int)$cartProducts[$productKey] : 0;
    if ($quantity > 0) {
        $subtotal += $quantity * $product["cost"];
    }
}

$tariffTax = $subtotal * 0.05;
$shippingHandling = $subtotal * 0.10;
$finalTotal = $subtotal + $tariffTax + $shippingHandling;
?>
<html>

<head>
    <title>Receipt</title>
</head>

<body>
    <h1>Receipt</h1>

    <table border="1" cellpadding="10">
        <tr>
            <th>Product ID</th>
            <th>Item Name</th>
            <th>Cost</th>
            <th>Cart</th>
        </tr>
        <?php
        foreach ($products as $productKey => $product) {
            $quantity = isset($cartProducts[$productKey]) ? (int)$cartProducts[$productKey] : 0;
            if ($quantity > 0) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($product["productID"]) . "</td>";
                echo "<td>" . htmlspecialchars($product["name"]) . "</td>";
                echo "<td>$" . number_format($product["cost"], 2) . "</td>";
                echo "<td>" . $quantity . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>

    <p>Subtotal: $<?php echo number_format($subtotal, 2); ?></p>
    <p>Tariff Tax (5%): $<?php echo number_format($tariffTax, 2); ?></p>
    <p>Shipping &amp; Handling (10%): $<?php echo number_format($shippingHandling, 2); ?></p>
    <p><strong>Total Cost: $<?php echo number_format($finalTotal, 2); ?></strong></p>
    <a href="project.php">Back to Catalog</a>
</body>

</html>
