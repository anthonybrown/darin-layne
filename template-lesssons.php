<?php
/*
* Template Name: Lessons
*/
get_header();
?>
	<div  class="clearfix width-100">
		<div style="max-width:100%;" class="fusion-row">
        	<div class="full-width lessons-row-area" id="content">
            	<?php
					query_posts(array("post_type" => "lessons" , "posts_per_page" => -1 , "order" => "ASC" , "orderby" => "menu_order"));
					$counter = 0;
					while(have_posts()){
						the_post();
				?>
            	<div class="fusion-one-third lesson fusion-layout-column">
                    <article id="post-<?php the_ID(); ?>" class="lessons-col-area">
                    	<?php if ( has_post_thumbnail() ) : ?>
                            <div class="entry-thumbnail">
                                <?php the_post_thumbnail( 'lessonsthumb' ); ?>
                            </div>
                        <?php endif; ?>
                        <h3><a href="<?php the_permalink() ?>"><?php $tit = the_title('','',FALSE); echo substr($tit, 0, 30); ?></a></h3>
                        <p><?php echo get_the_twitter_excerpt(); ?></p>
                        <a class="read-more-links" href="<?php the_permalink() ?>"> Read More </a>

                    </article><!-- #post -->
				</div>

				<?php // comments_template(); ?>
			<?php 	}	?>
			</div>
		</div>
	</div>
<?php
get_footer();
?>
