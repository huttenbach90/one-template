<?php get_header(); ?>

<div class="container">

  <div class="row">
    <div class="col-12 col-lg-9 left-side">
			<?php echo get_hansel_and_gretel_breadcrumbs(); ?>
	
			<?php 
				$category = get_queried_object();
				$thiscat = $category->slug;
			?>

			<ul id="menu-homepage" class="row mb-4 pt-2 pl-0">
				<li class="icon-video icon-image col text-center menu-item menu-item-type-custom">
					<a href="<?php echo get_site_url(); ?>/?post_format=video&category_name=<?php echo $thiscat; ?>">
						<?php echo __('Video', 'oneindustry'); ?>
					</a>
				</li>
				<li class="icon-articles icon-image col text-center menu-item menu-item-type-custom">
					<a href="<?php echo get_site_url(); ?>/?post_format=clanky&category_name=<?php echo $thiscat; ?>">
						<?php echo __('Články/Aktuality/Rozhovory/Reportáže', 'oneindustry'); ?>
					</a>
				</li>
			</ul>

			<div id="banner-inside" class="text-center mb-4">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("banner-leaderboard") ) : ?>
					<?php dynamic_sidebar("banner-leaderboard"); ?>
				<?php endif;?>
			</div>    
			
			<?php if(have_posts()) : ?>
				<?php while(have_posts()) : the_post(); ?>

					<div id="post-<?php the_ID(); ?>" <?php post_class('bg-light pt-4 pl-6 pr-6 pb-0'); ?>>
						<div class="row">
							<div class="col-12 col-md-5 mb-3 mb-md-0">
								<div class="post-thumbnail p-relative">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php 
											if (has_post_format('video')) {
												if ( has_post_thumbnail() ) {
													the_post_thumbnail( 'thumbnail' );
												} 
												else { 
													echo '<img src="' . get_bloginfo('stylesheet_directory') . '/images/noimage.jpg" />';
												}
											}
											else {
												global $post;
												$compare_date = strtotime( "2018-08-23" );
												$post_date    = strtotime( $post->post_date );
											
												if ( $compare_date < $post_date ) {
													if (get_post_meta($post->ID, 'nahledovyobrazek', true) != "") { 
														echo '<img src="' . get_post_meta($post->ID, 'nahledovyobrazek', true) . '">';
													}
													else {
														echo '<img src="' . get_bloginfo('stylesheet_directory') . '/images/noimage.jpg" />';
													}
												} 
												else {
													if ( has_post_thumbnail() ) {
														the_post_thumbnail( 'thumbnail' );
													} 
													else { 
														echo '<img src="' . get_bloginfo('stylesheet_directory') . '/images/noimage.jpg" />';
													}
												} 
											}
										?>
									</a>
								</div>
							</div>
							<div class="col-12 col-md-7">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="c-dark ch-primary no-decoration">
									<?php the_title('<h3 class="post-title mb-2">','</h3>'); ?>
								</a>
								<p class="mb-3"><?php slider_excerpt(); ?></p>
								<a href="<?php the_permalink(); ?>" class="btn btn-primary link-more" title="<?php the_title(); ?>">
									<?php _e('Číst dále', 'oneindustry'); ?>
								</a>
							</div>
						</div>
					</div>

					<?php endwhile; ?>

					<?php kriesi_pagination($pages = '', $range = 1); ?>

				<?php else : ?>

				<div class="alert alert-info">
					<strong><?php _e("Zde nic není.", "oneindustry"); ?></strong>
				</div>
			<?php endif; ?>
		</div>
    
    <div class="col-12 col-lg-3 rightside">
			<?php get_sidebar(); ?>
    </div>

	</div>
</div>

<?php get_footer(); ?>