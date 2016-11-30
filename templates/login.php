<?php
$pageTitle = "Login Page";
require_once __DIR__ . '/../templates/_header.php';
?>

    <h1>Login</h1>

    <form action="/index.php?action=processLogin" method="post">

        <p>Username:
            <input type="text" name="username" size="20" maxlength="20" required>
        </p>
        <p>Password:
            <input type="password" name="password" size="21" maxlength="20" required>
        </p>
        <input type ="submit" value="LogIn">
        <input type = "reset">

    </form>

<?php
require_once __DIR__ . '/../templates/_footer.php';