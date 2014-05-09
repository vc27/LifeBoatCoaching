<?php
/* Template Name: Home Page */

/**
 * File Name tpl-home.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.8
 * @updated 01.20.14
 **/
#################################################################################################### */

$_home__header_image = get_field('_home__header_image');

get_template_part( 'header-head' );

?>
<!-- Start Body -->
<body <?php body_class('home-page'); ?>>
	<?php do_action('after_body_tag'); ?>
	<div id="page" <?php if ( ! get_field('_home__show_header_navigation') ) { echo "class=\"no-menu\""; } ?>>
		
		<?php
		if ( get_field('_home__show_header_navigation') ) {
			echo "<div id=\"header\" class=\"outer-wrap\">";
				echo "<header class=\"inner-wrap\">";
					wp_nav_menu( array( 
						'fallback_cb' => '', 
						'theme_location' => 'primary-navigation', 
						'container' => 'div', 
						'container_id' => 'primary-navigation', 
						// 'menu_class' => 'sf-menu' 
					) );
					echo "<div class=\"clear\"></div>";
				echo "</header>";
			echo "</div>";
		}
		?>
		
		<div id="home-header" class="outer-wrap" style="background-image:url('<?php echo $_home__header_image['url']; ?>');background-position:<?php echo get_field('_home__header_image_position'); ?>;">
			<div class="cover"></div>
			<div class="inner-wrap">
				<span class="icon-support"></span>
				<h1>Lifeboat Coaching</h1>
				<div class="h5"><?php the_field('_home__header_description'); ?></div>
			</div>
		</div>
		
		
		<?php
		
		if ( have_rows('_home__sections') ) {
			while ( have_rows('_home__sections') ) {
				the_row();
				$image = get_sub_field('_home__section_image');
				$image_style = get_sub_field('_home__section_image_style');
				
				echo "<div class=\"outer-wrap section\">";
					echo "<div class=\"inner-wrap $image_style\">";
						echo "<h2>" . get_sub_field('_home__section_title') . "</h2>";
						echo "<div class=\"spacer\"><span class=\"line\"></span><span class=\"icon-support\"></span></div>";
						if ( $image AND 'circle-left' == $image_style ) {
							echo "<div class=\"home-section-image img-$image_style\" style=\"background-image:url('" . $image['url'] . "');\"></div>";
						}
						echo "<div class=\"post-wrap\">";
							echo "<div class=\"entry\">" . get_sub_field('_home__section_text') . "</div>";
						echo "</div>";
						if ( 'yes' == get_sub_field('_home__section_include_call_to_action') ) {
							echo "<span class=\"call-to-action\"><a class=\"btn\" href=\"" . get_sub_field('_home__section_button_url') . "\">" . get_sub_field('_home__section_button_text') . "</a></span>";
						}
						if ( 'yes' == get_sub_field('_home__section_include_a_form') ) {
							$form = get_sub_field('_home__section_form');
							gravity_form_enqueue_scripts( $form->id, true );
							gravity_form( $form->id, false, false, false, '', true, 1 );
						}
						if ( $image AND in_array( $image_style, array( 'rectangle-bottom', 'circle-bottom' ) ) ) {
							echo "<div class=\"home-section-image img-$image_style\" style=\"background-image:url('" . $image['url'] . "');\"></div>";
						}
					echo "</div>";
				echo "</div>";
				
			}
		}
		
		?>
		
		
		
		<div id="footer" class="outer-wrap">
			<footer class="inner-wrap">
				<p>&copy;<?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
				<?php 

				wp_nav_menu( array( 
					'depth' => 1, 
					'fallback_cb' => '', 
					'theme_location' => 'footer-navigation', 
					'container' => 'div', 
					'container_id' => 'footer-navigation' 
				) );

				?>
				<div class="clear"></div>
			</footer>
		</div><!-- End Footer -->

	</div><!-- End Page -->

<!-- Start wp_footer -->
<?php wp_footer(); ?>
</body>
</html>