<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset = "utf-8">
    <title> Frozen - <?=$pageTitle?> </title>
    <style>
        @import "/css/style.css";
        @import "/css/nav.css";
        @import "/css/footer.css";
        body {
            background-color: <?= $backgroundColor?>;
        }
    </style>

</head>

<body>

<header>

    <img src="/images/FrozenBanner.jpg" alt="Frozen Banner" >
   <?php if (isset ($_SESSION['userImage'])):
   ?>
    <img src="/images/<?=$_SESSION['userImage']?>" width="196" height="196">
       <?php
   endif;
   ?>
    <br>
    <div class = 'wrap'>
    <?php
        if($isLoggedIn):
            ?>
            Welcome Back <?= $username ?>!
            <a href="/index.php?action=profilePage&id=<?= $_SESSION['id'] ?>">Your Profile</a>

            <a href="/index.php?action=logout">(Logout)</a>
            <?php
            //----------------------------
        else:
            //----------------------------
            ?>
            <a href="/index.php?action=login">Login</a>
            <?php
        endif;
    ?>

</header>

<?php
require_once __DIR__ . '/_nav.php';
?>
<div class = 'wrap'>

