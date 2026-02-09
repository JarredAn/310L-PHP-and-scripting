<html>

<head> 
    Jarand5122 project 
</head>

<?php
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

// Display Catalog
echo "<h1>Gaming Console Catalog</h1>\n";
echo "<table border='1' cellpadding='10'>\n";
echo "<tr><th>Product ID</th><th>Name</th><th>Description</th><th>Cost</th></tr>\n";

foreach ($products as $productID => $product) {
    echo "<tr>\n";
    echo "<td>" . htmlspecialchars($product["productID"]) . "</td>\n";
    echo "<td>" . htmlspecialchars($product["name"]) . "</td>\n";
    echo "<td>" . htmlspecialchars($product["description"]) . "</td>\n";
    echo "<td>\$" . number_format($product["cost"], 2) . "</td>\n";
    echo "</tr>\n";
}

echo "</table>\n";
?>

</html>