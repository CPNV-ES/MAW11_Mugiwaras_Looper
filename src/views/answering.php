<?php
/** @var array $exercises */
?>
<main class="container">
    <ul class="answering-list">
        <?php if (isset($exercises) && is_array($exercises)): ?>
            <?php foreach ($exercises as $exercise): ?>
                <li class="row">
                    <div class="column card">
                        <div class="title"><?= htmlspecialchars($exercise['title_exercise']) ?></div>
                        <a class="button" href="/exercises/<?= htmlspecialchars($exercise['id']) ?>">Take it</a>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</main>
