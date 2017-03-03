<?php snippet('header') ?>

<div id="container">

	<div class="inner products">
		
		<div class="page-content">
			<?php foreach($page->children()->visible()->flip() as $product): ?>
					
					<?php $image = $product->featured()->toFile(); ?>
					<div class="content-item shop-item">
							<a href="<?php echo $product->url() ?>">
							<img 
							src="<?= thumb($image, array('width'=>1000))->url() ?>" 
							class="" 
							alt="<?= $product->title()->html().' — © '.$site->title()->html(); ?>" 
							height="100%" width="auto">
							</a>
							<div class="item-caption">
								<?php if($product->soldout() != 'true'): ?>
								<div class="flex">
									<a href="<?php echo $product->url() ?>">
									<button class="btn"><?php echo $product->title()->html() ?></button>
									<button class="btn"><?php echo $product->price() ?><?php echo $site->currency_symbol() ?></button>
									</a>
								</div>
								<?php else: ?>
								<div class="flex">
									<a href="<?php echo $product->url() ?>">
									<button class="btn"><?php echo $product->title()->html() ?></button>
									<button class="btn">Sold out</button>
									</a>
								</div>
								<?php endif ?>
							</div>
					</div>

			<?php endforeach ?>
		</div>
	
		<div id="slide-caption"></div>
	</div>
	
</div>


<?php snippet('footer') ?>