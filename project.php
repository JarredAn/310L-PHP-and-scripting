<?php
// Start session to persist quantities
session_start();

// Initialize session quantities if not set
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

// Ensure all products have an entry in the session
$productKeys = ["xbox", "playstation", "nintendo", "psp", "gameboy"];
foreach ($productKeys as $key) {
    if (!isset($_SESSION['products'][$key])) {
        $_SESSION['products'][$key] = 0;
    }
}

// Product Catalog - Gaming Consoles
$products = [
    "xbox" => [
        "productID" => "0100",
        "name" => "Xbox Series X",
        "description" => "Gaming console from Microsoft featuring an X logo",
        "cost" => 499.99
    ],
    "playstation" => [
        "productID" => "0200",
        "name" => "PlayStation 5",
        "description" => "Gaming console from Sony featuring PS logo",
        "cost" => 499.99
    ],
    "nintendo" => [
        "productID" => "0300",
        "name" => "Nintendo Switch",
        "description" => "Handheld gaming console from Nintendo featuring two controllers as logo",
        "cost" => 299.99
    ],
    "psp" => [
        "productID" => "0400",
        "name" => "PlayStation Portable",
        "description" => "Portable gaming console from Sony featuring PSP as logo .",
        "cost" => 149.99
    ],
    "gameboy" => [
        "productID" => "0500",
        "name" => "Game Boy Nintendo",
        "description" => "Classic portable gaming console from Nintendo featuring Gameboy as logo .",
        "cost" => 99.99
    ]
];

// Handle form submission to update quantity
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && isset($_POST['action'])) {
    $productID = $_POST['product_id'];
    $action = $_POST['action'];
    
    // Ensure this product exists in session
    if (!isset($_SESSION['products'][$productID])) {
        $_SESSION['products'][$productID] = 0;
    }
    
    if ($action === 'add') {
        $_SESSION['products'][$productID]++;
    } elseif ($action === 'subtract') {
        $_SESSION['products'][$productID]--;
        // Ensure quantity doesn't go below 0
        if ($_SESSION['products'][$productID] < 0) {
            $_SESSION['products'][$productID] = 0;
        }
    } elseif ($action === 'delete') {
        $_SESSION['products'][$productID] = 0;
    }
    
    // Redirect to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<html>

<head> 
    <title>Jarand5122 project</title>
</head>

<body>

<?php
// Display Catalog
echo "<h1>Gaming Console Catalog</h1>\n";
echo "<table border='1' cellpadding='10'>\n";
echo "<tr><th>Product ID</th><th>Name</th><th>Description</th><th>Cost</th><th>Add to cart</th><th>Cart</th></tr>\n";

foreach ($products as $productKey => $product) {
    $currentQuantity = isset($_SESSION['products'][$productKey]) ? $_SESSION['products'][$productKey] : 0;
    
    echo "<tr>\n";
    echo "<td>" . htmlspecialchars($product["productID"]) . "</td>\n";
    echo "<td>" . htmlspecialchars($product["name"]) . "</td>\n";
    echo "<td>" . htmlspecialchars($product["description"]) . "</td>\n";
    echo "<td>\$" . number_format($product["cost"], 2) . "</td>\n";
    
    // Add to cart buttons
    echo "<td>\n";
    echo "<form method='POST' style='display: flex; gap: 5px;'>\n";
    echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($productKey) . "'>\n";
    echo "<button type='submit' name='action' value='add'>Add</button>\n";
    echo "<button type='submit' name='action' value='subtract'>Subtract</button>\n";
    echo "<button type='submit' name='action' value='delete'>Delete</button>\n";
    echo "</form>\n";
    echo "</td>\n";
    
    // Cart column displays saved quantity
    echo "<td>" . $currentQuantity . "</td>\n";
    
    echo "</tr>\n";
}

echo "</table>\n";
?>

</body>
</html>