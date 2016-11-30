<?php
$pageTitle = "Add User";
require_once __DIR__ . '/../templates/_header.php';


if(isset($_SESSION['role']) && $_SESSION['role']==2):
    ?>
    <h1>Create New User</h1>

    <form action="index.php?action=createNewUser" method="POST">


        <label class="formLabel">
            Username:
        </label>
        <input type="text" name = "username" required>
        <br>
        <br>

        <label class="formLabel">
            Password:
        </label>
        <input type="password" name = "registerPassword1" size="20" maxlength="20" required>
        <br>
        <br>
        <label class="formLabel">
            Re-enter Password:
        </label>
        <input type="password" name = "registerPassword2" size="20" maxlength="20" required>

        <br>
        <br>
        <label class="formLabel">
            Set Users Role, 1 for customer or 2 for admin
        </label>
        <input type="number" min="1" max="2" name="role" value="1" required>
        <br>

        <input type="hidden" name="userImage" value="elsa.jpg">
        <br>

        <input type ="submit" value="Add User">
        <input type = "reset">

    </form>
    <?php
else:
    ?>
    <p>Opps, we don't know how you got here, but this is an admin only page.</p>
    <p><a href="/index.php">Back to Home</a></p>
    <?php
endif;

require_once __DIR__ . '/../templates/_footer.php';