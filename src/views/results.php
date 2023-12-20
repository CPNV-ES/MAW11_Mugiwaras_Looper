<?= $this->layout("headers/resultsHeader"); ?>
<?= $this->startSection('body'); ?>
<main class="container">
    <h1>Results</h1>

    <table>
        <thead>
        <tr>
            <th>Take</th>
            <?php foreach ($uniqueFields as $field): ?>
                <th>
                    <a href="/exercises/<?= $exerciseTitle[0]['id_exercise'] ?>/results/<?= $field['id'] ?>">
                        <?= $field['label'] ?>
                    </a>
                </th>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($answersByFulfillment as $fulfilledAt => $answersGroup): ?>
            <tr>
                <td>
                    <?php $fulfilledAtDisplayed = false; ?>
                    <?php foreach ($answersGroup as $fieldLabel => $answerData): ?>
                        <?php if (!$fulfilledAtDisplayed): ?>
                            <a href="/exercises/<?= $exerciseTitle[0]['id_exercise'] ?>/fulfillments/<?= $answerData['fulfillmentId'] ?>">
                                <?= $fulfilledAt ?>
                            </a>
                            <?php $fulfilledAtDisplayed = true; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </td>
                <?php foreach ($uniqueFields as $field): ?>
                    <?php $answerData = $answersGroup[$field['label']] ?? null; ?>
                    <td class="answer">
                        <?php if ($answerData): ?>
                            <?php $answerLength = strlen($answerData['answer']); ?>
                            <?php if ($answerLength > 0 && $answerLength <= 10): ?>
                                <i class="fa fa-check short"></i>
                            <?php elseif ($answerLength > 10): ?>
                                <i class="fa fa-check-double filled"></i>
                            <?php else: ?>
                                <i class="fa fa-times empty"></i>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?= $this->endSection(); ?>