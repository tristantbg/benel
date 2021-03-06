<?php
function get_cart() {
    s::start();
    $cart = s::get('cart', array());
    return $cart;
}

function cart_logic($cart) {

    if (isset($_REQUEST['action'])) {
      $action = $_REQUEST['action'];
      $id = $_REQUEST['id'];
      switch ($action) {
          case 'add':
              if (isset($cart[$id])) {
                  $cart[$id]++;
              } else {
                  $cart[$id] = 1;
              }
              break;
          case 'remove':
              if (isset($cart[$id])) {
                  $cart[$id]--;
              } else {
                  $cart[$id] = 1;
              }
              break;
          case 'update':
              if (isset($_REQUEST['quantity'])) {
                  $quantity = intval($_REQUEST['quantity']);
                  if ($quantity < 1) {
                      unset($cart[$id]);
                  } else {
                      $cart[$id] = $quantity;                
                  }
              }
              break;
          case 'delete':
              if (isset($cart[$id])) {
                  unset($cart[$id]);
              }
              break;
      }
      s::set('cart', $cart);
    }
    
//    if (count($cart) == 0) {
//    	go(url('products'));        
//    }
    
    return $cart;
}

function cart_count($cart) {
    $count = 0;
    foreach ($cart as $id => $quantity) {
        $count += $quantity;
    }
    return $count;
}

function cart_postage($total) {
    $postage;
    switch ($total) {
    	case ($total <= 0):
    		$postage = 0;
            break;
        case ($total <= 15):
            $postage = 8;
            break;
        case ($total <= 30):
            $postage = 12;
            break;
        case ($total <= 60):
            $postage = 20;
            break;
        case ($total <= 100):
            $postage = 30;
            break;
        case ($total <= 300):
            $postage = 40;
            break;
        default:
            $postage = 50;
    }
    return $postage;
}