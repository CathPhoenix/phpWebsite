<?php

$pageTitle = 'Profile Page';
require_once __DIR__ . '/../templates/_header.php';

?>

    <h1>Profile</h1>
    <dl>
        <dt>Profile Picture</dt>
        <dd><img src="/images/<?= $user->getUserImage() ?>" height="196" width="196"></dd>

        <dt>ID</dt>
        <dd><?= $user->getId() ?></dd>

        <dt>Username</dt>
        <dd><?= $user->getUsername() ?></dd>


    </dl>


    <h1>Change your Profile Picture</h1>
    <form action="index.php?action=pickImage&id=<?= $user->getId() ?>" method="POST">

        <input type="hidden" name="id" value="<?= $user->getId() ?>">

            <?php foreach ($userImages as $userImage): ?>


                <input type="radio" name="picture" value="<?= $userImage?>" required>
                <img src="/images/<?= $userImage ?>">

            <?php endforeach; ?>
        <br>
        <input type="submit" value="Submit" name="submit">
    </form>


    <hr>

    <form action="index.php?action=changeProfileImage&id=<?= $user->getId() ?>" method="POST" enctype="multipart/form-data">

        <p>Or Select image to upload:</p>
        <input type="file" name="picture" required>
        <input type="submit" value="Upload Image" name="submit">

    </form>



<?php
require_once __DIR__ . '/../templates/_footer.php';