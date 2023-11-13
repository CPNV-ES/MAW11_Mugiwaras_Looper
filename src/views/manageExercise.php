<?php require 'headers/manageHeader.php'; ?>
<main class="container">
    <!DOCTYPE html>
    <html>
<div class="row results">
    <?php foreach (['Building', 'Answering', 'Closed'] as $status): ?>
        <section class="column">
            <h1><?= htmlspecialchars($status) ?></h1>
            <table class="records">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($categorizedExercises[$status])): ?>
                    <?php foreach ($categorizedExercises[$status] as $exercise): ?>
                        <tr>
                            <td><?= htmlspecialchars($exercise['title_exercise']) ?></td>
                            <td>
                                <a title="Manage fields" href="/exercises/<?= $exercise['id_exercise'] ?>/fields"><i class="fa fa-edit"></i></a>
                                <a data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete" href="/exercises/<?= $exercise['id_exercise'] ?>"><i class="fa fa-trash"></i></a>
                                <?php if ($status != 'Closed'): ?>
                                    <a title="Be ready for answers" rel="nofollow" data-method="put" href="/exercises/<?= $exercise['id_exercise'] ?>?exercise%5Bstatus%5D=answering"><i class="fa fa-comment"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">No exercises in <?= htmlspecialchars($status) ?> status.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </section>
    <?php endforeach; ?>
</div>
    </html>
</main>
