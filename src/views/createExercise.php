<?= $this->layout("headers/createExerciseHeader"); ?>
<?= $this->startSection('body'); ?>
<body>
<main class="container">
    <h1>New Exercise</h1>

    <form action="/exercises" accept-charset="UTF-8" method="post">


        <div class="field">
            <label for="exercise_title">Title</label>
            <input type="text" name="exerciseTitle" id="exercise_title"/>
        </div>

        <div class="actions">
            <input type="submit" value="Create Exercise" data-disable-with="Create Exercise"/>
        </div>
    </form>
</main>
</body>
<?= $this->endSection(); ?>
