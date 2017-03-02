<?php snippet('header') ?>

<div id="container">

	<div class="inner project">
		
		<div class="page-content slider">
			<?php foreach($page->children()->visible()->flip() as $product): ?>
					
					<?php $image = $product->featured()->toFile(); ?>
					<div class="content-item shop-item">

							<img 
							src="<?= thumb($image, array('width'=>200, 'quality'=> 8))->url() ?>" 
							data-flickity-lazyload="<?= thumb($image, array('width'=>1000))->url() ?>" 
							class="lazyimg lazyload" 
							alt="<?= $product->title()->html().' — © '.$site->title()->html(); ?>" 
							height="100%" width="auto">
							<div class="item-caption">
								<?php if($product->soldout() != 'true'): ?>
								<div class="flex">
									<a href="<?php echo $product->url() ?>">
									<button class="btn"><?php echo $product->price() ?><?php echo $site->currency_symbol() ?></button>
									<button class="btn">Buy</button>
									</a>
								</div>
								<?php else: ?>
								<div class="flex">
									<a href="<?php echo $product->url() ?>">
									<button class="btn"><?php echo $product->price() ?><?php echo $site->currency_symbol() ?></button>
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