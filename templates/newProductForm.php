<?php
$pageTitle = "New Product Form";
require_once __DIR__ . '/../templates/_header.php';

if(isset($_SESSION['role']) && $_SESSION['role']==2):
    ?>
    <h1>Create a new product</h1>
    <form action="index.php?action=createNewProduct" method="POST">

        <p>
            <label class="formLabel">Product Name:</label>
            <input type="text" name="productName" required>
        </p>

        <p>
            <label class="formLabel">Description:</label>
            <textarea rows="4" cols="50" name="description"></textarea>
        </p>
        <p>
            <label class="formLabel">Price:</label>
            <input type="number" min="0.01" step="0.01" name="price" required>
        </p>

        <p>
            <label class="formLabel">Rating out of 5:</label>
            <input type="number" min="0" max="5" name="rating" required>
        </p>

        <input type="submit" value="Create New Product">

    </form>
    <?php
        else:
    ?>
        <p>Opps, we don't know how you got here, but this is an admin only page.</p>
        <p><a href="/index.php">Back to Home</a></p>
    <?php
    endif;

require_once __DIR__ . '/../templates/_footer.php';