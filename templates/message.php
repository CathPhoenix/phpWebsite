<?php

$pageTitle = 'Message Page';
require_once __DIR__ . '/../templates/_header.php';

?>

    <h2>Message</h2>

    <p>
        <?= $message ?>
    </p>
<?php
require_once __DIR__ . '/../templates/_footer.php';