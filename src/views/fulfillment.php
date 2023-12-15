<?php require 'headers/resultsHeader.php'; ?>
<body>
<main class="container">
    <h1><?= $data['fulfillment']['submited_at'] ?> </h1>

    <dl class="answer">
        <?php
        $i = 0;
        foreach ($data['fields'] as $field): ?>
            <dt><?= $field['label'] ?></dt>
            <dd><?= $data['answers'][$i]['answer'] ?></dd>
            <?php
            $i++; endforeach; ?>
    </dl>
</main>
</body>