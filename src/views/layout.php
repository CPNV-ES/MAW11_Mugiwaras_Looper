<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Exercise Looper" ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body class="<?= $currentPage ?? '' ?>">



    <!-- Dynamic header injection -->
    <?= $dynamicHeader ?? '' ?>
    <!-- Main content injection -->
    <?= $content ?? '' ?>

</body>

</html>