<?php $cart = cart_logic(get_cart()) ?>
<?php $products = $pages->find('shop')->children()->visible() ?>
<?php snippet('header') ?>

<div id="container">

<div class="inner page">

<?php if(count($cart) == 0): ?>

<main id="cart" class="main black" role="main">
	<div class="text">
		<h1>The cart is empty.</h1>
		<a class="btn-white" href="<?php echo url('shop') ?>">See products</a>
	</div>
</main>

<?php else: ?>

<main id="cart" class="main" role="main">
	<div class="text">
		<?php if($site->sandbox() == 'true'): ?>
		<form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr">
		<?php else: ?>
		<form method="post" action="https://www.paypal.com/cgi-bin/webscr">
		<?php endif ?>
			<input type="hidden" name="cmd" value="_cart">
			<input type="hidden" name="upload" value="1">
			<input type="hidden" name="business" value="<?php echo $site->email() ?>">
			<input type="hidden" name="currency_code" value="<?php echo $site->currency_code() ?>">
			<input type="hidden" name="cbt" value="Return to <?php echo $site->title() ?>">
			<input type="hidden" name="cancel_return" value="<?php echo url('cart') ?>">
			<input type="hidden" name="return" value="<?php echo url('cart/paid') ?>">
			<table cellpadding="6" rules="GROUPS" frame="BOX">
				<thead>
					<tr>
					<th class="head">Product</th>
					<th class="head">Quantity</th>
					<th class="head"></th>
					<th class="head" style="text-align: right;">Price</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=0; $count = 0; $total = 0; ?>
				<?php foreach($cart as $id => $quantity): ?>
				<?php if($product = $products->findByURI($id)): ?>
				<?php $i++; ?>
				<?php $count += $quantity ?>
					<tr>
						<td>
							<input type="hidden" name="item_name_<?php echo $i ?>" value="<?php echo $product->title() ?>" />
							<input type="hidden" name="amount_<?php echo $i ?>" value="<?php echo $product->price() ?>" />
							<a href="<?php echo $product->url() ?>">
							<?php echo kirbytext($product->title(), false) ?>
							</a>
						</td>
						<td>
							<input data-id="<?php echo $product->uid() ?>" data-quantity="<?php echo $quantity ?>" pattern="[0-9]*" class="quantity" type="hidden" name="quantity_<?php echo $i ?>" min="1" value="<?php echo $quantity ?>">
							<?php echo $quantity ?>
							<a class="btn add" href="<?php echo url('cart') ?>?action=add&amp;id=<?php echo $product->uid() ?>">+</a>
							<?php if ($quantity > 1): ?>
							<a class="btn remove" href="<?php echo url('cart') ?>?action=remove&amp;id=<?php echo $product->uid() ?>">–</a>
							<?php endif ?>
							<?php $prodtotal = floatval($product->price()->value)*$quantity ?>
						</td>
						<td><a class="btn-red delete" href="<?php echo url('cart') ?>?action=delete&amp;id=<?php echo $product->uid() ?>">Remove</a></td>
						<td style="text-align: right;"><?php printf('%0.2f', $prodtotal) ?><?php echo $site->currency_symbol() ?></td>
					</tr>
				<?php $total += $prodtotal ?>
				<?php endif; ?>
				<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<td align="left" colspan="3"></td>
						<td style="text-align: right;"><?php printf('%0.2f', $total) ?><?php echo $site->currency_symbol() ?></td>
					</tr>
					<tr>
					<?php $postage = cart_postage($total) ?>
						<td align="left" colspan="3">Shipping</td>
						<td style="text-align: right;"><?php printf('%0.2f', $postage) ?><?php echo $site->currency_symbol() ?></td>
						<input type="hidden" name="shipping_<?php echo $i ?>" value="<?php printf('%0.2f', $postage) ?>" />
					</tr>
					<tr>
						<th align="left" colspan="3">Total</th>
						<th style="text-align: right;"><?php printf('%0.2f', $total+$postage) ?><?php echo $site->currency_symbol() ?></th>
					</tr>
				</tfoot>
			</table>
			<div id="pay"><button class="btn-paypal" type="submit">Checkout</button></div>
		</form>
	</div>
</main>

<?php endif; ?>

</div>
	
</div>

<?php snippet('footer') ?>