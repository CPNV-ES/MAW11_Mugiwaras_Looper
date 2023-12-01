<?php
require 'headers/layoutHead.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Exercise Looper</title>
    <?= $layoutHead ?? '' ?>
</head>
<body>
<?= $dynamicHeader ?? '' ?>
<?= $content ?? '' ?>
</body>
</html>