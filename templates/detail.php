<?php

$pageTitle = 'Detail Page';
require_once __DIR__ . '/../templates/_header.php';

?>

    <h1>Details of Product</h1>
    <dl>
    <dt>ID</dt>
        <dd><?= $product['productId'] ?></dd>
<br>
    <dt>Product</dt>
        <dd><?= $product['productName'] ?></dd>
<br>
    <dt>Description</dt>
        <dd><?= $product['description'] ?></dd>
<br>
    <dt>Price</dt>
        <dd><?= $product['price'] ?></dd>
<br>
    <dt>Rating out of Five</dt>
        <dd><?= $product['rating'] ?></dd>
    </dl>

    <a href="/index.php?action=addToCart&id=<?= $product['productId'] ?>">Add to Cart</a>


<?php
require_once __DIR__ . '/../templates/_footer.php';