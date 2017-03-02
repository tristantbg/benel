<?php if(!defined('KIRBY')) exit ?>

title: Project
files: true
pages: false
files:
  fields:
    caption:
      label: Caption
      type: textarea
fields:
  prevnext: prevnext
  title:
    label: Title
    type:  text
    width: 1/2
  showinmenu:
      label: In menu
      type: toggle
      default: yes
      width: 1/4
  featured:
    label: Featured image
    type: image
    width: 1/4
  medias: 
    label: Images
    type: gallery
  text:
    label: Description
    type: textarea