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
        <section class="column">
            <h1>New Field</h1>
            <form action="/exercises/<?= $data['exercise']['id_exercise'] ?>/fields" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="✓"><input type="hidden" name="authenticity_token" value="WXvuF6WS+XWi18dQXkfL/GlaDGgWaE4YdsOF+s5KyAIy8hkoeNcCe/v8rwWvz3jGf2DXJYwJuS765IRkGe96Pw==">

                <div class="field">
                    <label for="field_label">Label</label>
                    <input type="text" name="field[label]" id="field_label">
                </div>

                <div class="field">
                    <label for="field_value_kind">Value kind</label>
                    <select name="field[value_kind]" id="field_value_kind"><option selected="selected" value="single_line">Single line text</option>
                        <option value="single_line_list">List of single lines</option>
                        <option value="multi_line">Multi-line text</option></select>
                </div>

                <div class="actions">
                    <input type="submit" name="commit" value="Create Field" data-disable-with="Create Field">
                </div>
            </form>
        </section>
