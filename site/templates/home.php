<?php snippet('header') ?>

<div id="container">

<div class="inner home" 
<?php if($page->featured()->isNotEmpty()): ?>
style="background-image: url('<?= resizeOnDemand($page->featured()->toFile(), 2000) ?>');"
<?php endif ?>
>

</div>
	
</div>

<?php snippet('footer') ?>