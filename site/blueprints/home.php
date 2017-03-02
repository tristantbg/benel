<?php if(!defined('KIRBY')) exit ?>

title: Page
pages: true
files: true
fields:
  title:
    label: Title
    type:  text
    width: 3/4
  featured:
      label: Featured
      type: image
      width: 1/4
  text:
    label: Text
    type:  textarea