<main class="container">
    <ul class="answering-list">
        <?php foreach ($exercises as $exercise): ?>
            <li class="row">
                <div class="column card">
                    <div class="title"><?= htmlspecialchars($exercise['title_exercise']) ?></div>
                    <a class="button" href="/exercises/<?= htmlspecialchars($exercise['id']) ?>/fulfillments/new">Take it</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</main>