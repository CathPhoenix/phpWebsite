<?php
$pageTitle = "Sitemap";
require_once __DIR__ . '/../templates/_header.php';
?>

    <h1>Site Map</h1>

    <ul>
        <li>
            <a href = "index.php">Home</a>
            <ul>
                <li>
                    <a href="index.php?action=login">Login</a>
                </li>
                <li>
                    <a href="index.php?action=logout">Logout</a>
                </li>
            </ul>
        </li>

        <li>
            <a href = "index.php?action=shop">Shop</a>
            <ul>
                <li>More Product Information</li>
                <?php
                    if(isset($_SESSION['role']) && $_SESSION['role']==2):
                ?>
                <li>Update Product</li>
                <li>Delete Product</li>
                <li>Create Product</li>
                <?php
                    endif;
                ?>
            </ul>
        </li>

        <li>
            <a href = "index.php?action=contact">Contact Us</a>
        </li>
        <li>
            <a href = "index.php?action=showShoppingCart">Shopping Cart</a>
        </li>
        <li>
            <a href = "index.php?action=sitemap">SiteMap</a>
        </li>
        <?php
            if(isset($_SESSION['role']) && $_SESSION['role']==2):
        ?>
        <li>
            <a href = "index.php?action=crudUsers">Admin CRUD Users</a>
            <ul>
                <li>Update User</li>
                <li>Delete User</li>
                <li><a href = "index.php?action=register">Create New User</a></li>
            </ul>
        </li>
        <?php
            endif;
        ?>
    </ul>
<?php
require_once __DIR__ . '/../templates/_footer.php';