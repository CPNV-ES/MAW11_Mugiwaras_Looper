<?= $this->layout("headers/fulfillmentsHeader");
    $this->section("exercise",$exercise);
?>
<?= $this->startSection('body'); ?>
<body>
<main class="container">
    <h1>Your take</h1>
    <p>If you'd like to come back later to finish, simply submit it with blanks</p>

    <form action="/exercises/<?= $exercise['id_exercise'] ?>/fulfillments" accept-charset="UTF-8" method="post">
        <?php foreach ($fields as $field): ?>
            <div class="field">
                <label for="fulfillment_answers_attributes_value"><?= $field['label'] ?: 'Value' ?></label>
                <?php if ($field['value_kind'] === 'multi_line'): ?>
                    <textarea name="answer_<?= $field['id_field'] ?>" id="fulfillment_answers_attributes_value"></textarea>
                <?php else: ?>
                    <input type="<?= $field['value_kind'] ?>" name="answer_<?= $field['id_field'] ?>" id="fulfillment_answers_attributes_value">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <div class="actions">
            <input type="submit" value="Save" data-disable-with="Save">
        </div>
    </form>
</main>
</body>
<?= $this->endSection(); ?>