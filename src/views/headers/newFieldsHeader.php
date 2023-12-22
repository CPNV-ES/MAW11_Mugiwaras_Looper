
<?= $this->layout('layout'); ?>
<?= $this->startSection('header'); ?>
<header class="heading managing">
    <section class="container">
        <a href="/"><img src="/img/logo.png" alt="" /></a>
        <span class="exercise-label">Exercise: <a href="/exercises/<?= $this->exercise['id_exercise'] ?>/fields"><?= $this->exercise['title_exercise'] ?></a></span>
    </section>
</header>';
<?= $this->endSection(); ?>