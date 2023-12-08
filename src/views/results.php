<?php require 'headers/resultsHeader.php'; ?>

<main class="container">
    <h1>Results</h1>

    <table>
        <thead>
        <tr>
            <th>Take</th>
            <?php foreach ($uniqueFields as $fieldLabel): ?>
                <th><a href="#"><?= $fieldLabel ?></a></th>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($answersByFulfillment as $fulfilled_at => $answers): ?>
            <tr>
                <td><a href="/exercises/<?= $answers[0]['id_exercise'] ?>/fulfillments/<?= $answers[0]['fulfillment_id'] ?>"><?= $fulfilled_at ?></a></td>
                <?php foreach ($uniqueFields as $fieldLabel): ?>
                    <?php $answer = $answers[$fieldLabel] ?? ''; ?>
                    <td class="answer">
                        <?php
                        $answerLength = strlen($answer);
                        if ($answerLength > 0 && $answerLength <= 10): ?>
                            <i class="fa fa-check short"></i>
                        <?php elseif ($answerLength > 10): ?>
                            <i class="fa fa-check-double filled"></i>
                        <?php else: ?>
                            <i class="fa fa-times empty"></i>
                        <?php endif; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
