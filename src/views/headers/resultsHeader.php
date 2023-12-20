<?= $this->layout('layout') ?>
<?= $this->startSection('header'); ?>
<header class="heading results">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>
        <span class="exercise-label">Exercise: <a href="/exercises/<?=$exerciseTitle[0]['id_exercise']?>/results"><?= $exerciseTitle[0]['title_exercise'] ?></a></span>
    </section>
</header>';
<?= $this->endSection(); ?>