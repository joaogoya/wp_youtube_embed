<?php
add_shortcode('pipeline_youtube_all_videos', 'pipeline_do_youtube_all');

function pipeline_do_youtube_all()
{

    //busca os vídeos
    $args = array(
        'post_type' => 'videos',
        'orderby' => 'rand',
        'posts_per_page' => -1
    );
    $query_videos = new WP_Query($args); ?>

    <!-- spinner -->
    <section class="spinner-videos">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center">
                        <strong>Buscando os vídeos...</strong>
                        <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Videos -->
    <section id="videos">
        <div class="container">
            <div class="row cards">

                <!-- Título -->
                <div class="col-12">
                    <h2 class="t-center large">
                        Vídeos
                    </h2>
                    <br>
                </div>
                <br>

                <?php if ($query_videos->have_posts()) : while ($query_videos->have_posts()) : $query_videos->the_post(); ?>

                        <?php

                        // Busca id do vídeo no banco
                        $url = get_the_content();
                        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
                        $video_id = $my_array_of_vars['v'];
                        ?>

                        <!-- Lista de videos -->
                        <div class="col-lg-4 col-6">
                            <div class="card">

                                <!-- carrega o thumb do video -->
                                <div class="card-body p-relative">
                                    <img src="https://img.youtube.com/vi/<?php echo $video_id; ?>/0.jpg" alt="">
                                </div>

                                <!-- Bt que abre a modal -->
                                <a class="btn-video-modal" data-toggle="modal" data-target="#modal<?php the_ID(); ?>">
                                    <img src=" <?php echo plugin_dir_url( __FILE__ );?>/assets/youtube-icon.png" alt="">
                                </a>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="modal<?php the_ID(); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" title="<?php echo $video_id; ?>">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">

                                        <!-- header - btn fechar -->
                                        <div class="modal-header">
                                            <button type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <!-- body - video -->
                                        <div class="modal-body">

                                            <!-- Escreve id do video para o js ler -->
                                            <div hidden id="<?php echo $video_id; ?>" class="video_id"></div>

                                            <!-- video - wrap no placeholder pra responsivar -->
                                            <div class="embed-responsive embed-responsive-16by9">

                                                <!-- Video placeholder -->
                                                <div id="player1-<?php echo $video_id; ?>" class="video_placeholder"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- modal -->

                        </div><!-- col-lg-4 col-6 -->
                <?php endwhile;
                endif; ?>
            </div><!-- row -->
            <br><br>
        </div><!-- conteiner -->
    </section>

<?php wp_reset_postdata();
}