<?php snippet('header') ?>

<?php $images = $page->medias()->toStructure() ?>
<?php

$title = $page->title()->html();

$filenames = $page->medias()->split(',');
if(count($filenames) < 2) $filenames = array_pad($filenames, 2, '');
$files = call_user_func_array(array($page->files(), 'find'), $filenames);

?>

<div id="container">

	<div class="inner project">
		
		<div class="page-content slider">
			<?php foreach ($files as $key => $file): ?>
				
					<?php if($file->type() == "image"): ?>
						<div class="content-item image-item" data-caption="<?= $file->caption()->kt()->escape() ?>">
								<img 
								src="<?= resizeOnDemand($file, 100) ?>" 
								data-src="<?= resizeOnDemand($file, 1000, true) ?>" 
								data-flickity-lazyload="<?= resizeOnDemand($file, 1000, true) ?>" 
								class="lazyimg lazyload" 
								alt="<?= $title.' — © '.$page->date("Y").', '.$site->title()->html(); ?>" 
								height="100%" width="auto">
								<noscript>
									<img src="<?= resizeOnDemand($file, 1000) ?>" alt="<?= $title.' — © '.$page->date("Y").', '.$site->title()->html(); ?>" width="100%" height="auto" />
								</noscript>
						</div>
					<?php elseif($file->type() == "video"): ?>
						<div class="content-item video-item" data-caption="<?= $file->caption()->kt()->escape() ?>">
							<video autoplay loop muted>
							  <source src="<?= $file->url() ?>" type="video/mp4">
							  Your browser does not support the video tag.
							</video>
						</div>
					<?php elseif($file->extension() == "text"): ?>
						<div class="content-item text-item title" data-caption="<?= $file->caption()->kt()->escape() ?>">
							<div><?= kirbytext(file_get_contents($file->root())) ?></div>
						</div>
					<?php endif ?>

			<?php endforeach ?>
		</div>
	
	<div id="slide-caption"></div>
	</div>
	
</div>

<?php snippet('footer') ?>