<?php snippet('header') ?>

<?php $images = $page->medias()->toStructure() ?>
<?php

$title = $page->title()->html();

?>

<div id="container">

	<div class="inner project">
		
		<div class="page-content slider">
			<?php foreach ($images as $key => $image): ?>
					
					<?php $image = $image->toFile(); ?>
					<div class="content-item image-item" data-caption="<?= $image->caption()->kt()->escape() ?>">

							<img 
							src="<?= thumb($image, array('width'=>200, 'quality'=> 8))->url() ?>" 
							data-flickity-lazyload="<?= resizeOnDemand($image, 1500) ?>" 
							class="lazyimg lazyload" 
							alt="<?= $title.' — © '.$page->date("Y").', '.$site->title()->html(); ?>" 
							height="100%" width="auto">
							<noscript>
								<img src="<?= resizeOnDemand($image, 1500) ?>" alt="<?= $title.' — © '.$page->date("Y").', '.$site->title()->html(); ?>" width="100%" height="auto" />
							</noscript>
					</div>

			<?php endforeach ?>
		</div>
	
	<div id="slide-caption"></div>
	</div>
	
</div>

<?php snippet('footer') ?>