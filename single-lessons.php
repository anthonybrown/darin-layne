<?php
/**
 * The Template for displaying all single lesson posts.
 *
 */
get_header();
?><div  class="clearfix width-100">
		<div style="max-width:100%;" class="fusion-row">
        	<div class="full-width lesson-single-page" id="content">
				<?php /* The loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="entry-thumbnail">
                            <?php the_post_thumbnail( 'lessonsthumb' ); ?>
                        </div>
                    <?php endif; ?>
                    <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>

                    <?php $meta = get_post_meta( get_the_ID(), 'readpdf', true );
                        if ($meta == '') {
                            echo '&nbsp;';
                        } else {
                            echo '<p><a class="read-pdf" href="' . $meta . '">Read Pdf</a></p>';
                          }
                    ?>
                    <?php $meta1 = get_post_meta( get_the_ID(), 'mpdownload', true );
                        if ($meta1 == '') {
                            echo '&nbsp;';
                        } else {
                            echo '<p><a class="download-mp3" href="' . $meta1 . '">Download MP3</a></p>';
                          }
                    ?>
                    <?php $meta2 = get_post_meta( get_the_ID(), 'readtiff', true );
                        if ($meta2 == '') {
                            echo '&nbsp;';
                        } else {
                            echo '<p><a class="read-tiff" href="' . $meta2 . '">Read Tiff</a></p>';
                          }
                    ?>
                    <?php $meta3 = get_post_meta( get_the_ID(), 'readjpg', true );
                        if ($meta3 == '') {
                            echo '&nbsp;';
                        } else {
                            echo '<p><a class="read-jpg" href="' . $meta2 . '">Read JPG</a></p>';
                          }
                    ?>

                </article><!-- article.post -->
                <?php endwhile; ?>
			</div>
		</div>
	</div>
<?php
get_footer();
?>
