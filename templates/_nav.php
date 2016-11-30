<?php
if(!isset($indexLinkClass)){
    $indexLinkClass = '';
}
if(!isset($shopLinkClass)){
    $shopLinkClass = '';
}
if(!isset($contactLinkClass)){
    $contactLinkClass = '';
}
if(!isset($sitemapLinkClass)){
    $sitemapLinkClass = '';
}
if(!isset($cartLinkClass)){
    $cartLinkClass = '';
}
if(!isset($crudUsersLinkClass )){
    $crudUsersLinkClass ='';
}

?>

<nav>
    <ul>
        <li>
            <a href = "/index.php" class="<?= $indexLinkClass ?>">Home</a>
        </li>

        <li>
            <a href = "/index.php?action=shop" class="<?= $shopLinkClass ?>">Shop</a>
        </li>

        <li>
            <a href = "/index.php?action=contact" class="<?= $contactLinkClass ?>">Contact Us</a>
        </li>

        <li>
            <a href = "/index.php?action=sitemap" class="<?= $sitemapLinkClass ?>">SiteMap</a>
        </li>

        <li>
            <a href = "/index.php?action=showShoppingCart" class="<?= $cartLinkClass ?>">Shopping Cart</a>
        </li>
        <?php
        if(isset($_SESSION['role']) && $_SESSION['role']==2):
        ?>
        <li>
            <a href = "/index.php?action=crudUsers" class="<?= $crudUsersLinkClass ?>">Admin CRUD Users</a>
        </li>
        <?php
        endif;
        ?>
    </ul>
</nav>
