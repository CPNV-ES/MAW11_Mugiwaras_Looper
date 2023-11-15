<?php require 'headers/createExerciseHeader.php'; ?>
<div class="container dashboard">
    Future new field exercise page
</div>        <a href="/"><img src="/img/logo.png"  alt=""/></a>
        <span class="exercise-label">exercise : <strong class="bolded"><?= $data['exercise']['title_exercise'] ?></strong></span>
    </section>
</header>
                <?php foreach ($data['fields'] as $field): ?>
                    <tr>
                        <td><?= $field['label']?></td>
                        <td><?= $field['value_kind']?></td>
                        <td>
                            <a title="Edit" href="/exercises/<?= $data['exercise']['id_exercise'] ?>/fields/<?= $field['id_field'] ?>/edit"><i class="fa fa-edit"></i></a>
                            <a data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete" href="/exercises/<?= $data['exercise']['id_exercise'] ?>/fields/<?= $field['id_field'] ?>"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
