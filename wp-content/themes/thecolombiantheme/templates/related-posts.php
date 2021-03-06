<?php
/**
 * Related-posts template.
 *
 * @author     ThemeFusion
 * @copyright  (c) Copyright by ThemeFusion
 * @link       https://theme-fusion.com
 * @package    Avada
 * @subpackage Core
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<section class="related-posts single-related-posts">
	<?php
	$title_size = ( false === avada_is_page_title_bar_enabled( get_the_ID() ) ? '2' : '3' );
	//Avada()->template->title_template( $main_heading, $title_size );
	$related_posts_title = pll__('See also');
	$related_posts_title_shortcode = '[fusion_title title_type="text" rotation_effect="bounceIn" display_time="1200" 
            highlight_effect="circle" loop_animation="off" highlight_width="9" highlight_top_margin="0" 
            before_text="" rotation_text="" highlight_text="" after_text="" content_align="left" size="3" 
            font_size="22" animated_font_size="" line_height="1.5" letter_spacing="0" text_color="#ff6600" 
            animated_text_color="" highlight_color="" style_type="default" sep_color="" 
			hide_on_mobile="small-visibility,medium-visibility,large-visibility" class="" id=""]'.$related_posts_title.'[/fusion_title]';
	echo do_shortcode($related_posts_title_shortcode, True);
	?>

	<?php
	/**
	 * Get the correct image size.
	 */
	$featured_image_size = ( 'cropped' === Avada()->settings->get( 'related_posts_image_size' ) ) ? 'fixed' : 'full';
	$data_image_size     = ( 'cropped' === Avada()->settings->get( 'related_posts_image_size' ) ) ? 'fixed' : 'auto';
	?>

	<?php
	/**
	 * Set the meta content variable.
	 */
	$data_meta_content = ( 'title_on_rollover' === Avada()->settings->get( 'related_posts_layout' ) ) ? 'no' : 'yes';

	$additional_carousel_class = '';
	if ( 'title_below_image' === Avada()->settings->get( 'related_posts_layout' ) ) {
		$additional_carousel_class = ' fusion-carousel-title-below-image';
	}
	?>

	<?php
	/**
	 * Set the autoplay variable.
	 */
	$data_autoplay = ( Avada()->settings->get( 'related_posts_autoplay' ) ) ? 'yes' : 'no';
	?>

	<?php
	/**
	 * Set the touch scroll variable.
	 */
	$data_swipe = ( Avada()->settings->get( 'related_posts_swipe' ) ) ? 'yes' : 'no';
	?>

	<?php $carousel_item_css = ( count( $related_posts->posts ) < Avada()->settings->get( 'related_posts_columns' ) ) ? ' style="max-width: 300px;"' : ''; ?>
	<?php $related_posts_swipe_items = Avada()->settings->get( 'related_posts_swipe_items' ); ?>
	<?php $related_posts_swipe_items = ( 0 == $related_posts_swipe_items ) ? '' : $related_posts_swipe_items; // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison ?>
	<div class="fusion-carousel<?php echo esc_attr( $additional_carousel_class ); ?>" data-imagesize="<?php echo esc_attr( $data_image_size ); ?>" data-metacontent="<?php echo esc_attr( $data_meta_content ); ?>" data-autoplay="<?php echo esc_attr( $data_autoplay ); ?>" data-touchscroll="<?php echo esc_attr( $data_swipe ); ?>" data-columns="<?php echo esc_attr( Avada()->settings->get( 'related_posts_columns' ) ); ?>" data-itemmargin="<?php echo intval( Avada()->settings->get( 'related_posts_column_spacing' ) ) . 'px'; ?>" data-itemwidth="180" data-touchscroll="yes" data-scrollitems="<?php echo esc_attr( $related_posts_swipe_items ); ?>">
		<div class="fusion-carousel-positioner">
			<ul class="fusion-carousel-holder">
				<?php
				/**
				 * Loop through related posts.
				 */
				?>
				<?php while ( $related_posts->have_posts() ) : ?>
					<?php $related_posts->the_post(); ?>
					<?php $post_id = get_the_ID(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride ?>
					<li class="fusion-carousel-item"<?php echo $carousel_item_css; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<div class="fusion-carousel-item-wrapper">
							<?php
							if ( 'title_on_rollover' === Avada()->settings->get( 'related_posts_layout' ) ) {
								$display_post_title = 'default';
							} else {
								$display_post_title = 'disable';
							}
							if ( 'auto' === $data_image_size ) {
								Avada()->images->set_grid_image_meta(
									[
										'layout'  => 'related-posts',
										'columns' => Avada()->settings->get( 'related_posts_columns' ),
									]
								);
							}
							echo fusion_render_first_featured_image_markup( $post_id, $featured_image_size, get_permalink( $post_id ), true, true, true, 'disable', $display_post_title, 'related', '', 'no' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							//Avada()->images->set_grid_image_meta( [] );
							?>
							<?php if ( 'title_below_image' === Avada()->settings->get( 'related_posts_layout' ) ) : // Title on rollover layout. ?>
								<?php
								/**
								 * Get the post title.
								 */
								?>
								<h4 class="fusion-carousel-title">
									<a class="fusion-related-posts-title-link" href="<?php echo esc_url_raw( get_permalink( get_the_ID() ) ); ?>" target="_self" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h4>

							
							<?php endif; ?>
						</div><!-- fusion-carousel-item-wrapper -->
					</li>
				<?php endwhile; ?>
			</ul><!-- fusion-carousel-holder -->
			<?php
			/**
			 * Add navigation if needed.
			 */
			?>
			<?php if ( Avada()->settings->get( 'related_posts_navigation' ) ) : ?>
				<div class="fusion-carousel-nav">
					<span class="fusion-nav-prev"></span>
					<span class="fusion-nav-next"></span>
				</div>
			<?php endif; ?>

		</div><!-- fusion-carousel-positioner -->
	</div><!-- fusion-carousel -->
</section><!-- related-posts -->

<?php
wp_reset_postdata();
