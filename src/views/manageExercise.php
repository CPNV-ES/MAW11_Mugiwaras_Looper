<?= $this->layout("headers/manageHeader"); ?>
<?= $this->startSection('body'); ?>
<main class="container">
    <div class="row">
        <!-- Building Section -->
        <section class="column">
            <h1>Building</h1>
            <table class="records">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($categorizedExercises['Building'] as $exercise): ?>
                    <tr>
                        <td><?= htmlspecialchars($exercise['title_exercise']) ?></td>
                        <td>
                            <a title="Be ready for answers" rel="nofollow" data-method="put" href="/exercises/<?= $exercise['id_exercise']?>?status=answering"><i class="fa fa-comment"></i></a>
                            <a title="Manage fields" href="/exercises/<?= $exercise['id_exercise'] ?>/fields"><i class="fa fa-edit"></i></a>
                            <a data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete" href="/exercises/<?= $exercise['id_exercise']?>"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <!-- Answering Section -->
        <section class="column">
            <h1>Answering</h1>
            <table class="records">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($categorizedExercises['Answering'] as $exercise): ?>
                    <tr>
                        <td><?= htmlspecialchars($exercise['title_exercise']) ?></td>
                        <td>
                            <a class="doubleIcons" title="Show results" href="/exercises/<?= $exercise['id_exercise'] ?>/results"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>
                            <a class="doubleIcons" title="Close" rel="nofollow" data-method="put" href="/exercises/<?= $exercise['id_exercise']?>?status=closed""><i class="fa fa-minus-circle"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <!-- Closed Section -->
        <section class="column">
            <h1>Closed</h1>
            <table class="records">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($categorizedExercises['Closed'] as $exercise): ?>
                    <tr>
                        <td><?= htmlspecialchars($exercise['title_exercise']) ?></td>
                        <td>
                            <a class="doubleIcons" title="Show results" href="/exercises/<?= $exercise['id_exercise'] ?>/results"><i class="fa fa-bar-chart"></i></a>
                            <a class="doubleIcons" data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete" href="/exercises/<?= $exercise['id_exercise'] ?>"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</main>
<?= $this->endSection(); ?>