<?= $this->layout("headers/fulfillmentsHeader");
    $this->section("exercise",$exercise);
    ?>
<?= $this->startSection('body'); ?>
<main class="container">
    <h1>Fulfillments for </h1>

    <table>
        <thead>
        <tr>
            <th>Taken at</th>
            <th colspan="3"></th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($exerciseFullfillments as $fulfillment): ?>
            <tr>
                <td><?= $fulfillment['submited_at'] ?></td>
                <td><a href="/exercises/<?= $fulfillment['id_exercise'] ?>/fulfillments/<?= $fulfillment['id_fulfillment'] ?>">Show</a></td>
                <td><a href="/exercises/<?= $fulfillment['id_exercise'] ?>/fulfillments/<?= $fulfillment['id_fulfillment'] ?>/edit">Edit</a></td>
                <td>
                    <a
                        data-confirm="Are you sure?"
                        rel="nofollow"
                        data-method="delete"
                        href="/exercises/<?= $fulfillment['id_exercise'] ?>/fulfillments/<?= $fulfillment['id_fulfillment'] ?>">Destroy</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?= $this->endSection(); ?>