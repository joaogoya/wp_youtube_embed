<?php

add_action('init', 'type_post_videos');

function type_post_videos()
{
    $rotulos = array(
        'name' => 'Vídeos',
        'singular_name' => 'Vídeo',
        'add_new' => 'Adicionar Novo Vídeo',
        'add_new_item' => 'Adicionar Vídeo',
        'edit_item' => 'Editar Vídeo',
        'new_item' => 'Novo Vídeo',
        'view_item' => 'Ver Vídeo',
        'search_items' => 'Procurar Vídeo',
        'not_found' =>  'Nenhum Vídeo encontrado',
        'not_found_in_trash' => 'Nenhum Vídeo na Lixeira',
        'parent_item_colon' => '',
        'menu_name' => 'Vídeos'
    );

    $args = array(
        'labels' => $rotulos,
        'public' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-format-video',
        'menu_position' => 36,
        'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt', 'custom-fields', 'revisions', 'trackbacks')
    );

    register_post_type('videos', $args);
    flush_rewrite_rules();
}