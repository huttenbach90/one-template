<?php get_header(); ?>

<div class="container">
			
  <div class="row">
    <div class="col-12 col-lg-9 left-side">
			<h2 class="line mb-4 mt-4"><?php _e('Profil firmy', 'oneindustry'); ?></h2>
			<div class="bg-light pl-6 pr-6 pt-5 pb-4">
				<div class="row">
					<div class="col-12">
						<?php $authorImage = get_the_author_meta('image'); ?>
						<img class="company-logo img-fluid" src='<?php echo $authorImage; ?>' />
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-8">
						<h3 class="mt-3 mb-3"><?php _e('Informace', 'oneindustry'); ?></h3>
						<p><?php echo nl2br(get_the_author_meta('description')); ?></p>
					</div>
					<div class="col-12 col-md-4">
						<h3 class="mt-3 mb-3"><?php _e('Kontaktní údaje', 'oneindustry'); ?></h3>
						<p><?php echo nl2br(get_the_author_meta('profile_contact')); ?></p>
					</div>
				</div>
			</div>
			<h2 class="line mb-4 mt-5"><?php _e('Vydané články', 'oneindustry'); ?></h2>

			<?php if(have_posts()) : ?>
				<?php while(have_posts()) : the_post(); ?>

					<div id="post-<?php the_ID(); ?>" <?php post_class('bg-light pt-4 pl-6 pr-6 pb-3'); ?>>
						<div class="row mb-4 mt-2">
							<div class="d-none d-md-block col-md-5">
								<div class="post-thumbnail p-relative">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="c-dark ch-primary no-decoration">
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

					<?php kriesi_pagination(); ?>

				<?php else : ?>

				<div class="alert alert-info">
					<strong><?php _e("Zde nic není.", "oneindustry"); ?></strong>
				</div>
			<?php endif; ?>
		</div>
    
    <div class="col-12 col-lg-3 rightside">
    </div>

	</div>
</div>

<?php get_footer(); ?>