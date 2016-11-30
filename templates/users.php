<?php

$pageTitle = "Users in Database";
require_once __DIR__.'/../templates/_header.php';


if(isset($_SESSION['role']) && $_SESSION['role']==2):
?>


    <h2>Users in database</h2>
    <p>Role 1 = Customer</p>
    <p>Role 2 = Admin</p>
    <table>
        <tr>
            <th> Profile Picture </th>
            <th> ID </th>
            <th> Name </th>
            <th> Password </th>
            <th> Role </th>
            <th> Update </th>
            <th> Delete </th>

        </tr>

        <?php


        //--------------------------
        foreach($users as $user):
            //--------------------------
            ?>

            <tr>
                <td><img src="/images/<?=$user->getUserImage()?>"height="196" width="196"> </td>

                <td> <?= $user->getId() ?> </td>
                <td> <?= $user->getUsername() ?> </td>
                <td> <?= $user->getPassword() ?> </td>
                <td> <?= $user->getRole() ?> </td>

                <td>
                    <a href="index.php?action=showUpdateUserForm&id=<?= $user->getId() ?>">(UPDATE)</a>
                </td>

                <td>
                    <a href="/index.php?action=deleteUser&id=<?= $user->getId() ?>">(DELETE)</a>
                </td>



            </tr>

            <?php
            //--------------------------
        endforeach;
        //--------------------------
        ?>
    </table>
    <form action="index.php" method="GET">

        <input type="hidden" name="action" value="register">
        <br>
        <input type="submit" value="Create New User">

    </form>


    <?php
else:
    ?>
    <p>Opps, we don't know how you got here, but this is an admin only page.</p>
    <p><a href="/index.php">Back to Home</a></p>
    <?php
endif;
require_once __DIR__.'/../templates/_footer.php';