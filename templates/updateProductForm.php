<?php
$pageTitle = "Update Product";
require_once __DIR__ . '/../templates/_header.php';

if(isset($_SESSION['role']) && $_SESSION['role']==2):
?>
    <h1>Update Product</h1>
    <form action="index.php?action=updateProduct" method="POST">

        <!-- ****** send ID, but don't let user see this ***** -->
        <input type="hidden" name="productId" value="<?= $product['productId'] ?>" required>

        <p>
            <label class="formLabel">Product Name: </label>
            <input type="text" name="productName" value="<?= $product['productName'] ?>" required>
        </p>

        <p>
            <label class="formLabel">Description: </label>
            <textarea rows="4" cols="50" name="description"><?= $product['description'] ?></textarea>
        </p>
        <p>
            <label class="formLabel">Price:</label>
            <input type="number" name="price" min="0.01" step="0.01" value="<?= $product['price'] ?>" required>
        </p>
        <p>
            <label class="formLabel">Rating out of 5:</label>
            <input type="number" name="rating" min="0" max="5" value="<?= $product['rating'] ?>" required>
        </p>

        <input type="submit" value="Update Product">
    </form>

    <?php
else:
    ?>
    <p>Opps, we don't know how you got here, but this is an admin only page.</p>
    <p><a href="/index.php">Back to Home</a></p>
    <?php
endif;
require_once __DIR__ . '/../templates/_footer.php';