<!DOCTYPE html>
<html lang="en" class="no-js">
<head>

	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="dns-prefetch" href="//www.google-analytics.com">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="canonical" href="<?php echo html($page->url()) ?>" />
	<?php if($page->isHomepage()): ?>
		<title><?= $site->title()->html() ?></title>
	<?php else: ?>
		<title><?= $page->title()->html() ?> | <?= $site->title()->html() ?></title>
	<?php endif ?>
	<?php if($page->isHomepage()): ?>
		<meta name="description" content="<?= $site->description()->html() ?>">
	<?php else: ?>
		<meta name="DC.Title" content="<?= $page->title()->html() ?>" />
		<?php if(!$page->text()->empty()): ?>
			<meta name="description" content="<?= $page->text()->excerpt(250) ?>">
			<meta name="DC.Description" content="<?= $page->text()->excerpt(250) ?>"/ >
			<meta property="og:description" content="<?= $page->text()->excerpt(250) ?>" />
		<?php else: ?>
			<meta name="description" content="">
			<meta name="DC.Description" content=""/ >
			<meta property="og:description" content="" />
		<?php endif ?>
	<?php endif ?>
	<meta name="robots" content="index,follow" />
	<meta name="keywords" content="<?= $site->keywords()->html() ?>">
	<?php if($page->isHomepage()): ?>
		<meta itemprop="name" content="<?= $site->title()->html() ?>">
		<meta property="og:title" content="<?= $site->title()->html() ?>" />
	<?php else: ?>
		<meta itemprop="name" content="<?= $page->title()->html() ?> | <?= $site->title()->html() ?>">
		<meta property="og:title" content="<?= $page->title()->html() ?> | <?= $site->title()->html() ?>" />
	<?php endif ?>
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= html($page->url()) ?>" />
	<?php if($page->content()->name() == "project"): ?>
		<?php if (!$page->featured()->empty()): ?>
			<meta property="og:image" content="<?= resizeOnDemand($page->image($page->featured()), 1200) ?>"/>
		<?php endif ?>
	<?php else: ?>
		<?php if(!$site->ogimage()->empty()): ?>
			<meta property="og:image" content="<?= $site->ogimage()->toFile()->width(1200)->url() ?>"/>
		<?php endif ?>
	<?php endif ?>

	<meta itemprop="description" content="<?= $site->description()->html() ?>">
	<link rel="shortcut icon" href="">
	<link rel="icon" href="" type="image/x-icon">

	<?php 
	echo css('assets/css/build/build.min.css');
	echo js('assets/js/vendor/modernizr.min.js');
	?>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?= url('assets/js/vendor/jquery.min.js') ?>">\x3C/script>')</script>

	<?php if(!$site->customcss()->empty()): ?>
		<style type="text/css">
			<?php echo $site->customcss()->html() ?>
		</style>
	<?php endif ?>

</head>
<body
<?php $template = $page->template(); ?>
<?php e($page->isHomepage(), " class='home'") ?>
<?php e($template == "cart", " class='shop'") ?>
<?php e($template == "default", " class='page'") ?>
<?php e($template == "products", " class='shop products'") ?>
<?php e($template == "product", " class='shop'") ?>
<?php e($template == "project", " class='project'") ?>
>

<div id="outdated">
	<div class="inner">
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser.
	<br>Please <a href="http://outdatedbrowser.com" target="_blank">upgrade your browser</a> to improve your experience.</p>
	</div>
</div>

<div class="loader">
	<div class="spinner">
		<svg class="circular" viewBox="25 25 50 50">
		<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10"></circle>
		</svg>
	</div>
</div>

<?php

// main menu items
$items = $pages->visible();
$shop = $pages->find('shop');

// only show the menu if items are available
if($items->count()):

?>
<nav id="main-menu" class="menu">
  <a href="<?php echo $site->url() ?>">
  <h1<?php e($site->homePage()->isOpen(), ' class="active"') ?>><?= $site->title()->html() ?></h1>
  </a>
  <?php if($template == 'shop' || $template == 'products' || $template == 'product' || $template == 'cart'): ?>
  <a href="<?php echo $shop->url() ?>">
  <h1 id="shop-link-l"<?php e($template == 'shop' || $template == 'products' || $template == 'product' || $template == 'cart', ' class="active"') ?>><?= $shop->title()->html() ?></h1>
  </a>
  <?php endif ?>
  <ul>
    <?php foreach($items as $item): ?>
    <?php if($item->showinmenu()->bool()): ?>
    <li><a<?php e($item->isOpen(), ' class="active"') ?> href="<?php echo $item->url() ?>"><?php echo $item->title()->html() ?></a></li>
    <?php endif ?>
    <?php endforeach ?>
    <?php if($site->pdf()->isNotEmpty()): ?>
    <li><a href="<?= $site->pdf()->toFile()->url() ?>" target='_blank' download>pdf</a></li>
	<?php endif ?>
  </ul>
</nav>

<?php endif ?>

<nav id="shop-menu" class="menu">
  
  <a href="<?php echo $shop->url() ?>"><h1 id="shop-link-r"><?= $shop->title()->html() ?></h1></a>
  <!-- <ul>
  	<?php $cart = $pages->find('cart') ?>
    <li><a<?php e($cart->isOpen(), ' class="active"') ?> href="<?php echo $cart->url() ?>"><?php echo $cart->title()->html() ?></a></li>
  </ul> -->
</nav>