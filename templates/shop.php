<?php

$pageTitle = "Shopping";
require_once __DIR__.'/../templates/_header.php';
?>


<h2>Our Products Available Today</h2>

    <table>
    <tr>
        <th>More  </th>
        <th> ID </th>
        <th> Name </th>
        <th> Price </th>
        <th> Rating </th>
        <th> Add to Cart </th>
        <?php
if(isset($_SESSION['role']) && $_SESSION['role']==2):
    ?>
        <th> Update </th>
        <th> Delete </th>
    <?php
endif;
?>
    </tr>

    <?php


    //--------------------------
    foreach($products as $product):
        //--------------------------
        ?>

        <tr>
            <td>
                <a href="/index.php?action=detail&id=<?= $product->getProductId() ?>">More Info</a>
            </td>
            <td> <?= $product->getProductId() ?> </td>
            <td> <?= $product->getProductName() ?> </td>
            <td>&euro; <?= $product->getPrice() ?> </td>
            <td> <?= $product->getRating() ?> </td>
            <td>
                <a href="/index.php?action=addToCart&id=<?= $product->getProductId() ?>">Add to Cart</a>
            </td>
        <?php
        if(isset($_SESSION['role']) && $_SESSION['role']==2):
            ?>
            <td>
                <a href="index.php?action=showUpdateProductForm&id=<?= $product->getProductId() ?>">(UPDATE)</a>
            </td>

            <td>
                <a href="/index.php?action=delete&id=<?= $product->getProductId() ?>">(DELETE)</a>
            </td>
            <?php
            endif;
            ?>


        </tr>

        <?php
        //--------------------------
    endforeach;
    //--------------------------
    ?>
</table>
<?php
if(isset($_SESSION['role']) && $_SESSION['role']==2):

?>
    <form action="index.php" method="GET">

        <input type="hidden" name="action" value="showNewProductForm">
        <input type="submit" value="Create New Product">

    </form>
    <?php
    endif;
    ?>
<hr>
    <form action="index.php" method="GET">

        <input type="hidden" name="action" value="showShoppingCart">
        <input type="submit" value="Go to Shopping Cart">

    </form>


<?php
require_once __DIR__.'/../templates/_footer.php';