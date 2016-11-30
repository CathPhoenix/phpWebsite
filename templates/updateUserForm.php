<?php
$pageTitle = "Update User";
require_once __DIR__ . '/../templates/_header.php';
if(isset($_SESSION['role']) && $_SESSION['role']==2):
?>
    <h1>Update User</h1>
    <form action="index.php?action=updateUser" method="POST">

        <!-- ****** send ID, but don't let user see this ***** -->
        <input type="hidden" name="id" value="<?= $user->getId()?>">

        <p>
            <label class="formLabel">UserName: </label>
            <input type="text" name="username" value="<?= $user->getUserName() ?>">
        </p>

        <p>
            <label class="formLabel">Users Role, 1 for customer or 2 for admin </label>
            <input type="number" name="role" min="1" max="2" value="<?= $user->getRole() ?>">
        </p>
        <p>
            <label class="formLabel">Password: </label>
            <input type="text" name="password" value="<?= $user->getPassword() ?>">
        </p>
        <p>
            <label class="formLabel">Profile Picture: </label>
            <select name="userImage">
                <option value="elsa.jpg" >Elsa</option>
                <option value="anna.jpg" >Anna</option>
                <option value="olaf.jpg" >Olaf</option>
            </select>

            <p> Current Profile Picture : <?= $user->getUserImage() ?> </p>
            <img src="/images/<?= $user->getUserImage() ?>" height="196" width="196">

        <input type="hidden" name="hashedPassword" value="<?= $user->getPassword()?>">

        <input type="submit" value="Update User">
    </form>

    <?php
else:
    ?>
    <p>Opps, we don't know how you got here, but this is an admin only page.</p>
    <p><a href="/index.php">Back to Home</a></p>
    <?php
endif;
require_once __DIR__ . '/../templates/_footer.php';