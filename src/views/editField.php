<?= $this->layout("headers/newFieldsHeader");
$this->section("exercise",$exercise);
?>
<?= $this->startSection('body'); ?>
<body>
<main class="container">
    <h1>New Exercise</h1>
    <form action="/exercises/<?= $exercise['id_exercise'] ?>/fields/<?= $field['id_field'] ?>" accept-charset="UTF-8" method="post">
        <div class="exercise-label">
            <label for="label">Label</label>
            <input type="text" name="fieldLabel" value="<?= $field['label']?>" id="field_label"/>
        </div>
        <div class="field_kind">
            <label for="label">Value kind</label>
            <select name="fieldKind" id="field_kind">
                <option <?= ($field['value_kind'] == "single_line") ? 'selected="selected"' : ''; ?> value="single_line">Single line text</option>
                <option <?= ($field['value_kind'] == "single_line_list") ? 'selected="selected"' : ''; ?>value="single_line_list">List of single lines</option>
                <option <?= ($field['value_kind'] == "multi_line") ? 'selected="selected"' : ''; ?>value="multi_line">Multi-line text</option>
            </select>
        </div>
        <div class="actions">
            <input type="submit" value="Update field"/>
        </div>
    </form>
</main>
</body>
<?= $this->endSection(); ?>
