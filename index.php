<?php 
 
/* 
 * Plugin Name: Pipeline Youtube Plugin
 * Plugin URI: http://pipeline-digital.com.br/
 * Description: Plugin para publicação de vídeos do youtube em seu site.
 * Author: Pipeline Digital
 * Version: 1.0.0 
 * Author URI: http://pipeline-digital.com.br/
 * License: GPL2+ 
*/ 
 
define('ARQ_PRINCIPAL', __FILE__); 

require_once('post-type.php');
 
require_once('shortcode_all_videos.php');

require_once('shortcode_three_videos.php');


//assets
function pipe_add_scripts_pl_youtube()
{
    wp_enqueue_script( 'pipe_jq', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');
    wp_enqueue_script( 'pipe_youtube_main_js', plugins_url( '/assets/youtube_main.js', __FILE__ ));
    wp_enqueue_style('youtube_main_style', plugins_url('/assets/youtube_main.css',__FILE__ ));
}

add_action('wp_enqueue_scripts', 'pipe_add_scripts_pl_youtube');

?>