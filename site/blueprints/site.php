<?php if(!defined('KIRBY')) exit ?>

title: Site
fields:
  generalSettings:
    label: Site Settings
    type: headline
  title:
    label: Title
    type:  text
  description:
    label: Description
    type:  textarea
  keywords:
    label: Keywords
    type:  tags
  customcss:
    label: Custom CSS
    type: textarea
    buttons: false
  googleAnalytics:
    label: Google Analytics ID
    type: text
    icon: code
    help: Tracking ID in the form UA-XXXXXXXX-X. Keep this field empty if you are not using it.
    width: 1/2
  ogimage:
    label: Facebook OpenGraph image
    type: image
    help: 1200x630px minimum
    width: 1/2
  pdf:
    label: PDF File
    type: select
    options: files
    width: 1/2
  cartSettings:
    label: Cartkit Settings
    type: headline
  email:
    label: PayPal Email
    type:  text
    icon: paypal
    required: true
    width: 1/2
  currency_code:
    label: Currency Code
    type:  text
    placeholder: EUR, USD, GBP…
    icon: money
    required: true
    width: 1/4
  currency_symbol:
    label: Currency Symbol
    type:  text
    placeholder: €, $, £…
    icon: money
    required: true
    width: 1/4
  sandbox:
      label: Paypal Sandbox
      type: toggle
      width: 1/2