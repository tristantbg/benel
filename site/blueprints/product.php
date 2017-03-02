<?php if(!defined('KIRBY')) exit ?>

title: Product
pages: false
files:
  sortable: true
fields:
  title:
    label: Title
    type:  text
    width: 3/4
  price:
    label: Price
    type:  text
    width: 1/4
  featured:
    label: Image
    type:  image
    width: 1/4
  soldout:
    label: Produit épuisé
    type: toggle
    default: no
    width: 1/4
  text:
    label: Text
    type:  textarea