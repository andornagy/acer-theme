<?php

add_action( 'customize_register', 'cd_customizer_settings' );

function cd_customizer_settings( $wp_customize ) {

   // Section
   $wp_customize->add_section( 'cd_colors' , array(
      'title'      => 'Colors',
      'priority'   => 30,
      'panel'=>'some_panel',
   ) );


   $wp_customize->add_setting( 'background_color' , array(
      'default'     => '#43C6E4',
      'transport'   => 'refresh',
   ) );

   $wp_customize->add_setting( 'header_color' , array(
      'default'     => '#43C6E4',
      'transport'   => 'refresh',
   ) );


   $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
      'label'        => 'Background Color',
      'section'    => 'cd_colors',
      'settings'   => 'background_color',
   ) ) );

   $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
      'label'        => 'header Color',
      'section'    => 'cd_colors',
      'settings'   => 'header_color',
   ) ) );


   $wp_customize->add_panel('some_panel',array(
      'title'=>'Panel1',
      'description'=> 'This is panel Description',
      'priority'=> 10,
  ));
  
  
  $wp_customize->add_section('section',array(
      'title'=>'section',
      'priority'=>10,
      'panel'=>'some_panel',
  ));
  
  
  $wp_customize->add_setting('setting_demo',array(
      'defaule'=>'a',
  ));
  
  
  $wp_customize->add_control('contrl_demo',array(
      'label'=>'Tex asdast',
      'type'=>'text',
      'section'=>'section',
      'settings'=>'setting_demo',
  ));

}

add_action( 'wp_head', 'cd_customizer_css');
function cd_customizer_css()
{
    ?>
         <style type="text/css">
             body { 
                background: #<?php echo get_theme_mod('background_color', '#43C6E4'); ?>; 
               }
               #header_warp {
                  background: <?php echo get_theme_mod('header_color', '#43C6E4'); ?>;
               }
         </style>
    <?php
}

