<?php

if ( ! get_theme_mod( 'ace_news_enable_flash_news_section', false ) ) {
	return;
}

$flash_news_posts_count = get_theme_mod( 'ace_news_flash_news_count', 5 );

$flash_news_args = array(
	'post_type'           => 'post',
	'posts_per_page'      => absint( $flash_news_posts_count ),
	'ignore_sticky_posts' => true,
);

$query = new WP_Query( $flash_news_args );
if ( $query->have_posts() ) {
	$full_width       = ( has_nav_menu( 'social' ) ) ? '' : 'flash-news-full-width';
	$speed_controller = get_theme_mod( 'ace_news_flash_news_speed_controller', 30 );
	?>
	<div class="sticky-topbar">
		<div id="ace_news_flash_news_section" class="ace-news-top-header">
			<div class="section-wrapper">
				<div class="ace-news-top-header-container <?php echo esc_attr( $full_width ); ?>">
					<div class="top-header-left">
						<div class="flash-news-section ascendoor-customizer-section">
							<div class="flash-news-wrapper">
								<div class="date">
									<i class="fa-regular fa-calendar-days" aria-hidden="true"></i>
									<span><?php echo esc_html( wp_date( 'M j, Y' ) ); ?></span>
								</div>
								<div class="flash-news-area" dir="ltr">
									<div class="marquee" data-pauseOnHover="true" data-speed="<?php echo absint( $speed_controller ); ?>">
										<ul>
											<?php
											while ( $query->have_posts() ) :
												$query->the_post();
												?>
												<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
												<?php
											endwhile;
											wp_reset_postdata();
											?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="top-header-right">
						<div class="header-social-icon">
							<div class="header-social-icon-container">
								<?php
								if ( has_nav_menu( 'social' ) ) {
									wp_nav_menu(
										array(
											'container'   => 'ul',
											'menu_class'  => 'social-links',
											'theme_location' => 'social',
											'link_before' => '<span class="screen-reader-text">',
											'link_after'  => '</span>',
										)
									);
								}
								?>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<?php
}
