<?php require 'headers/resultsHeader.php'; ?>

<main class="container">
    <h1><?= $data['exercise']['title'] ?></h1>

    <table>
        <thead>
            <tr>
                <th>Take</th>
                <th>Content</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['answers'] as $answer) : ?>
                <tr>
                    <td><a href="/exercises/<?=$data['exercise']['id']?>/fulfillments/<?=$answer['id_fulfillment']?>"><?= $answer['submited_at'] ?> UTC</a></td>
                    <td><?= $answer['answer'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>