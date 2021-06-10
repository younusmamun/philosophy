<?php

the_post();
get_header();
?>


    <!-- s-content
	================================================== -->
    <section class="s-content s-content--narrow s-content--no-padding-bottom">

        <article class="row format-standard">

            <div class="s-content__header col-full">
                <h1 class="s-content__header-title">
					<?php the_title(); ?>
                </h1>

            </div> <!-- end s-content__header -->

            <div class="s-content__media col-full">
                <div class="s-content__post-thumb">
					<?php the_post_thumbnail( "large" ); ?>
                </div>
            </div> <!-- end s-content__media -->

            <div class="col-full s-content__main">
				<?php the_content(); ?>
                <?php

                $philosophy_page_meta = get_post_meta(get_the_ID(),'page-metabox',true);

                echo esc_html($philosophy_page_meta['page-heading']).'<br/>';
                echo esc_html($philosophy_page_meta['page-teaser']).'<br/>';
                echo esc_html($philosophy_page_meta['is-favorite']).'<br/>';
                if($philosophy_page_meta['is-favorite']){
                    echo esc_html($philosophy_page_meta['page-favorite-text']);
                }

                $philosophy_page_meta = get_post_meta(get_the_ID(),'page-metabox',true);


                ?>



                <div class="row block-1-2 block-tab-full">
                    <?php
                    if(is_active_sidebar("about-us")){
                        dynamic_sidebar("about-us");
                    }
                    ?>
                </div>

            </div> <!-- end s-content__main -->

        </article>

    </section> <!-- s-content -->

<?php get_footer(); ?>