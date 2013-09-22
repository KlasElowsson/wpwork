<?php
include_once(ABSPATH . 'wp-content/themes/aztaz_posttypes.php');



/**
 *  Registrera fältgrupper
 *
 *  Funktionen register_field_group tar emot en array som innehåller inställningarna för samtliga fältgrupper.
 *  Du kan redigera denna array fritt. Detta kan dock leda till fel om ändringarna inte är kompatibla med ACF.
 *  OBS !! Detta fungerar tillsammans med Plugin "Advanced Custom Fields" av Elliot Condon . 
 *  Koden är exporterad för att fungera med detta tema.
 * */

if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_products',
    'title' => 'Products',
    'fields' => array (
      array (
        'key' => 'field_523c921c18e7d',
        'label' => 'Beskrivning',
        'name' => 'beskr',
        'type' => 'textarea',
        'default_value' => '',
        'placeholder' => 'Beskrivande text .. kanske',
        'maxlength' => '',
        'formatting' => 'br',
      ),
      array (
        'key' => 'field_523c8c57d750c',
        'label' => 'Pris',
        'name' => 'Pris',
        'type' => 'number',
        'instructions' => 'Pris på produkten',
        'required' => 1,
        'default_value' => '',
        'placeholder' => 'Produktpris',
        'prepend' => '',
        'append' => '',
        'min' => '',
        'max' => '',
        'step' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'products',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'no_box',
      'hide_on_screen' => array (
        0 => 'the_content',
        1 => 'excerpt',
        2 => 'custom_fields',
        3 => 'discussion',
        4 => 'slug',
        5 => 'author',
        6 => 'format',
      ),
    ),
    'menu_order' => 0,
  ));
} 

?>