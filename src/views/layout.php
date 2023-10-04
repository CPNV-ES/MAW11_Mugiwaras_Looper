<?php
/** @var string $content */
?>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Sans titre" ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

<header class="container">
    <section class="container">
        <a href="/"><img src="/img/logo.png" alt="Looper"></a>
    </section>
</header>

<!-- Main content injection -->
<?= $content ?? '' ?>

</body>

</html>

