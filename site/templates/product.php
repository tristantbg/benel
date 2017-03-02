<?php snippet('header') ?>

<div id="container">

<div class="inner product">
	
	<div class="visual col">
		<?php $image = $page->featured()->toFile(); ?>
		<img 
		src="<?= thumb($image, array('width'=>1000, 'height'=>1500, 'crop'=> true))->url() ?>" 
		class="" 
		alt="<?= $page->title()->html().' — © '.$site->title()->html(); ?>" 
		width="100%" height="auto">
	</div>

	<div class="infos col">

		<h1><?php echo $page->title()->html() ?></h1>
		<br>

	<div class="text">
		<?php echo $page->text()->kirbytext() ?>
	</div>

	<ul class="meta cf">
		<li><?php echo $page->price() ?><?php echo $site->currency_symbol() ?></li>
		<?php if($page->soldout() != 'true'): ?>
		<li>
		<form method="post" action="<?php echo url('cart') ?>">
			<input type="hidden" name="action" value="add">
			<input type="hidden" name="id" value="<?php echo $page->uid() ?>">
			<button class="btn" type="submit">Add to cart</button></p>
		</form>
		</li>
		<?php else: ?>
		<li><button class="btn-disabled" type="submit" disabled="">Sold out</button></p></li>
		<?php endif ?>
	</ul>

	<nav class="nextprev cf" role="navigation">
		<?php if($next = $page->nextVisible()): ?>
		<a class="next" href="<?php echo $next->url() ?>">Previous</a>
		<?php endif ?>
		<?php if($prev = $page->prevVisible()): ?>
		<a class="prev" href="<?php echo $prev->url() ?>">Next</a>
		<?php endif ?>
	</nav>
		
	</div>

</div>
	
</div>

<?php snippet('footer') ?>