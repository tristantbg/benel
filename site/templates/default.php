<?php snippet('header') ?>

<div id="container">

<div class="inner page">

<?php if($page->text()->isNotEmpty()): ?>
<section>
	<?= $page->text()->kt() ?>
</section>
<?php endif ?>

</div>
	
</div>

<?php snippet('footer') ?>