<?= $this->layout('layout') ?>
<?= $this->startSection('header'); ?>
<header class="heading answering">
    <section class="container">
        <a href="/"><img src="/img/logo.png" alt=""/></a>
        <span class="exercise-label">exercise : <strong class="bolded">' . $data['exercise']['title_exercise'] . '</strong></span>
    </section>
</header>';
<?= $this->endSection(); ?>