<header class="heading managing">
    <section class="container">
        <a href="/"><img src="/img/logo.png" alt=""/></a>
        <span class="exercise-label">exercise : <strong class="bolded"><?= $data['exercise']['title_exercise'] ?></strong></span>
    </section>
</header>
<body>
<main class="container">
    <h1>Your take</h1>
    <p>Bookmark this page, it's yours. You'll be able to come back later to finish.</p>

    <form action="/exercises/<?= $data['exercise']['id_exercise'] ?>/fulfillments" accept-charset="UTF-8" method="post">
        <?php
        $i = 0;
        foreach ($data['fields'] as $field): ?>
        <div class="field">
            <label for="fulfillment_answers_attributes__value"><?= $field['label'] ?: 'Value'  ?></label>
            <input type="<?= $field['value_kind'] ?>" value="<?= $data['answers'][$i]['answer'] ?>" name="answer_<?=$field['id_field']?>" id="fulfillment_answers_attributes__value">
        </div>
        <?php
        $i++;
        endforeach; ?>
        <div class="actions">
            <input type="submit" value="Save" data-disable-with="Save">
        </div>
    </form>
</main>

</body>
