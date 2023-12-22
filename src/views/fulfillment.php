<?= $this->layout("headers/resultsHeader");
    $this->section("exercise",$exercise);
?>
<?= $this->startSection('body'); ?>
<body>
<main class="container">
    <h1><?= $fulfillment['submited_at'] ?> </h1>

    <dl class="answer">
        <?php
        $i = 0;
        foreach ($fields as $field): ?>
            <dt><?= $field['label'] ?></dt>
            <dd><?= $answers[$i]['answer'] ?></dd>
            <?php
            $i++; endforeach; ?>
    </dl>
</main>
</body>
<?= $this->endSection(); ?>