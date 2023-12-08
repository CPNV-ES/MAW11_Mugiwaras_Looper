<?php
require 'headers/manageHeader.php'; ?>
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
                            <a title="Are you sure?" rel="nofollow" data-method="delete" data-id="<?= $exercise['id_exercise'] ?>" href="/exercises/deleteExercise"><i class="fa fa-trash"></i></a>
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
                        <td class="doubleIcons">
                            <a class="icon-link" title="Show results" href="/exercises/<?= $exercise['id_exercise'] ?>/results"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>
                            <a class="icon-link" title="Close" rel="nofollow" data-method="put" href="/exercises/<?= $exercise['id_exercise'] ?>?exercise%5Bstatus%5D=closed"><i class="fa fa-minus-circle"></i></a>
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
                        <td class="doubleIcons">
                            <a class="icon-link" title="Show results" href="/exercises/<?= $exercise['id_exercise'] ?>/results"><i class="fa fa-bar-chart"></i></a>
                            <a class="icon-link" data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete" href="/exercises/<?= $exercise['id_exercise'] ?>"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</main>
