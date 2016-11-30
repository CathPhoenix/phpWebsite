<?php
$pageTitle = "Change Background";
require_once __DIR__ . '/../templates/_header.php';
?>
    Choose what colour you would like the background:
    <ul>
        <li>
            <a href="/index.php?action=setBackgroundColorPink">Pink</a>
        </li>

        <li>
            <a href="/index.php?action=setBackgroundColorYellow">Yellow</a>
        </li>

        <li>
            <a href="/index.php?action=setBackgroundColorGreen">Green</a>
        </li>
    </ul>
<?php
require_once __DIR__ . '/../templates/_footer.php';