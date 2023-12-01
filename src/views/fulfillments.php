<?php
require 'headers/fulfillmentsHeader.php'; ?>
<body>
<main class="container">
    <h1>Your take</h1>
    <p>If you'd like to come back later to finish, simply submit it with blanks</p>

    <form action="/exercises/<?= $data['exercise']['id_exercise'] ?>/fulfillments" accept-charset="UTF-8" method="post">
        <?php
        foreach ($data['fields'] as $field): ?>
        <div class="field">
            <label for="fulfillment_answers_attributes_value"><?= $field['label'] ?: 'Value'  ?></label>
            <input type="<?= $field['value_kind'] ?>" name="answer_<?=$field['id_field']?>" id="fulfillment_answers_attributes_value" >
        </div>
        <?php
        endforeach; ?>
        <div class="actions">
            <input type="submit" value="Save" data-disable-with="Save">
        </div>
    </form>
</main>

</body>
