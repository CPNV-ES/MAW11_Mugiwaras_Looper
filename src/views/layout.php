<?php
require 'headers/layoutHead.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Exercise Looper</title>
    <?= $layoutHead ?? '' ?>
    <script src="/js/manageExercises.js"></script>
</head>
<body>
<?= $dynamicHeader ?? '' ?>
<?= $content ?? '' ?>
</body>
</html>