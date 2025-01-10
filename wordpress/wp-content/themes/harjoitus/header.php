<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <style>
    body {
        font-family: 'Roboto';font-size: 17px;
    }
    </style>
</head>
<body <?php body_class(); ?>>
    <div id="site-container">
        <nav id="top-navi">
            <div class="nav-logo">
            <i class="fa fa-anchor"></i><p style="font-size: 200%; color: white;">Ocean Explorer</p>
            </div>
            <?php wp_nav_menu(['theme_location' => 'primary']); ?>
        </nav>
        <!-- <header id="site-header">
            <h1><?php bloginfo('name'); ?></h1>
        </header> -->