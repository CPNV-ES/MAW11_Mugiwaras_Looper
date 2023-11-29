<header class="heading managing">
    <section class="container">
        <a href="/"><img src="/img/logo.png" alt=""/></a>
        <span class="exercise-label">exercise : <strong class="bolded"><?= $data['exercise']['title_exercise'] ?></strong></span>
    </section>
</header>
<body>
<main class="container">
    <h1>Your take</h1>
    <p>If you'd like to come back later to finish, simply submit it with blanks</p>

    <form action="/exercises/<?= $data['exercise']['id_exercise'] ?>/fulfillments" accept-charset="UTF-8" method="post">
        <?php
        foreach ($data['fields'] as $field): ?>
        <div class="field">
            <label for="fulfillment_answers_attributes__value"><?= $field['label'] ?></label>
            <input type="<?= $field['value_kind'] ?>" name="fulfillment[answers_attributes][][value]" id="fulfillment_answers_attributes__value">
        </div>
        <?php
        endforeach; ?>
        <div class="actions">
            <input type="submit" name="commit" value="Save" data-disable-with="Save">
        </div>
    </form>
</main>

</body>