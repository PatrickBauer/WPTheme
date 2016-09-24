<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', TRUE, 'right'); ?></title>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page">
    <div id="header">
        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>

        <nav id="site-navigation">
            <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
        </nav>
    </div>

    <div id="content">
