<?= $this->layout('layout') ?>
<?= $this->startSection('header'); ?>
<header class="heading results">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>
        <span class="exercise-label">Exercise: <a href="/exercises/<?=$this->exercise[0]['id_exercise']?>/results"><?= $this->exercise[0]['title_exercise'] ?></a></span>
    </section>
</header>';
<?= $this->endSection(); ?>