<?= $this->layout("headers/resultsHeader");
    $this->section("exercise",$exercise);
?>
<?= $this->startSection('body'); ?>
<main class="container">
    <h1><?= $exercise[0]['title_exercise'] ?></h1>

    <table>
        <thead>
            <tr>
                <th>Take</th>
                <th>Content</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($answers as $answer) : ?>
                <tr>
                    <td><a href="/exercises/<?=$exercise[0]['id_exercise']?>/fulfillments/<?=$answer['id_fulfillment']?>"><?= $answer['submited_at'] ?> UTC</a></td>
                    <td><?= $answer['answer'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?= $this->endSection(); ?>