<?php if(!defined('KIRBY')) exit ?>

title: Page
pages: true
files: true
fields:
  title:
    label: Title
    type:  text
    width: 3/4
  showinmenu:
      label: In menu
      type: toggle
      default: yes
      width: 1/4
  text:
    label: Text
    type:  textarea