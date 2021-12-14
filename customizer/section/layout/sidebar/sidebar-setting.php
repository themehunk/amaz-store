<?php
/**
 *Sidebar Options for Zita Theme.
 *
 * @package     Zita
 * @author      Zita
 * @copyright   Copyright (c) 2021, Zita
 * @since       Zita 1.0.0
 */
$zita_section_sidebar_group = new amaz_store_WP_Customize_Section( $wp_customize,'zita-section-sidebar-group', array(
    'title' =>  __( 'Sidebar', 'amaz-store' ),
    'panel' => 'amaz-store-panel-layout',
    'priority' => 2,
  ));
$wp_customize->add_section($zita_section_sidebar_group);
/********************/
// default layout
/********************/
$wp_customize->add_setting('zita_sidebar_default_layout', array(
        'default'        => 'right',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ));
    $wp_customize->add_control( 'zita_sidebar_default_layout', array(
        'settings' => 'zita_sidebar_default_layout',
        'label'   => __('Default Layout','amaz-store'),
        'section' => 'zita-section-sidebar-group',
        'type'    => 'select',
        'choices'    => array(
        'no-sidebar'   => __('No Sidebar','amaz-store'),
        'left' => __('Left Sidebar','amaz-store'),
        'right'=> __('Right Sidebar','amaz-store'),    
        ),
        'priority'   => 1,
));
/********************/
// page layout
/********************/
$wp_customize->add_setting('zita_sidebar_page_layout', array(
        'default'        => 'default',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ));
$wp_customize->add_control( 'zita_sidebar_page_layout', array(
        'settings' => 'zita_sidebar_page_layout',
        'label'   => __('Page Layout','amaz-store'),
        'section' => 'zita-section-sidebar-group',
        'type'    => 'select',
        'choices'    => array(
        'default'   => __('Default','amaz-store'),
        'no-sidebar'   => __('No Sidebar','amaz-store'),
        'left' => __('Left Sidebar','amaz-store'),
        'right'=> __('Right Sidebar','amaz-store'),    
        ),
        'priority'   => 3,
));
/********************/
// blog page layout
/********************/
$wp_customize->add_setting('zita_sidebar_blog_layout', array(
        'default'        => 'default',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ));
$wp_customize->add_control( 'zita_sidebar_blog_layout', array(
        'settings' => 'zita_sidebar_blog_layout',
        'label'   => __('Blog Layout','amaz-store'),
        'section' => 'zita-section-sidebar-group',
        'type'    => 'select',
        'choices'    => array(
        'default'   => __('Default','amaz-store'),
        'no-sidebar'   => __('No Sidebar','amaz-store'),
        'left' => __('Left Sidebar','amaz-store'),
        'right'=> __('Right Sidebar','amaz-store'),    
        ),
        'priority'   => 4,
));
/********************/
// blog single page layout
/********************/
$wp_customize->add_setting('zita_sidebar_archive_layout', array(
        'default'        => 'default',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ));
$wp_customize->add_control( 'zita_sidebar_archive_layout', array(
        'settings' => 'zita_sidebar_archive_layout',
        'label'   => __('Blog Post Archives','amaz-store'),
        'section' => 'zita-section-sidebar-group',
        'type'    => 'select',
        'choices'    => array(
        'default'   => __('Default','amaz-store'),
        'no-sidebar'   => __('No Sidebar','amaz-store'),
        'left' => __('Left Sidebar','amaz-store'),
        'right'=> __('Right Sidebar','amaz-store'),    
        ),
        'priority'   => 5,
));
/********************/
// Woo page layout
/********************/
$wp_customize->add_setting('zita_sidebar_woo_layout', array(
        'default'        => 'default',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
        

    ));
$wp_customize->add_control( 'zita_sidebar_woo_layout', array(
        'settings' => 'zita_sidebar_woo_layout',
        'label'    => __('WooCommerce','amaz-store'),
        'section'  => 'zita-section-sidebar-group',
        'type'     => 'select',
        'choices'      => array(
        'default'      => __('Default','amaz-store'),
        'no-sidebar'   => __('No Sidebar','amaz-store'),
        'left'         => __('Left Sidebar','amaz-store'),
        'right'        => __('Right Sidebar','amaz-store'),    
        ),
        'priority'   => 6,
));