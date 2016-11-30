<?php
$pageTitle = "Shopping Cart";
require_once __DIR__ . '/../templates/_header.php';
?>

<h1>This is your Shopping Cart</h1>

<table>
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Sub-Total</th>
        <th>Remove</th>
    </tr>

  <?php  $total = 0; // zero grand total before loop
    foreach($shoppingCart as $id=>$quantity):
    //----- use ID to get Product object ------
        $productRepository = new \Itb\ProductRepository();
        $product= new \Itb\Product();

        $product = $productRepository->getOneById($id);


        $subTotal = $product['price'] * $quantity; // calc sub-total for current item
        $total += $subTotal; // add sub-total to grand total
    ?>
        <tr>
            <td><?= $product['productName'] ?></td>
            <td>&euro; <?= $product['price'] ?></td>
            <td><?= $quantity ?></td>
            <td>€ <?= $subTotal ?></td>
            <td>
                <a href="/index.php?action=removeFromCart&id=<?= $product['productId'] ?>">Remove from Cart</a>
            </td>
        </tr>

        <?php
    endforeach;
    ?>

    <tr>
        <td colspan="3">Total</td>
        <td>€ <?= $total?> </td>
    </tr>
    </table>
<br>
<hr>

    <form action="index.php" method="GET">

        <input type="hidden" name="action" value="emptyCart">
        <input type="submit" value="Empty Shopping Cart">

    </form>
<?php
require_once __DIR__ . '/../templates/_footer.php';