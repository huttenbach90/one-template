<?php get_header(); ?>

<div class="container">
			
  <div class="row">
    <div class="col-12 col-lg-9">
			<?php if(have_posts()) : ?>
					<?php while(have_posts()) : the_post(); ?>
					<?php echo get_hansel_and_gretel_breadcrumbs(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('bg-light pt-4 pl-6 pr-6 pb-3'); ?>>
						<div class="row mb-4 mt-2">
							<div class="col-12 col-lg-9">
								<?php the_title('<h1 class="post-title">','</h1>'); ?>
							</div>
							<div class="header-meta col-12 col-lg-3 text-right pt-3 font-weight-bold">
								<span class="text-uppercase"><?php echo get_post_type(); ?></span> | <?php the_date(); ?>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<?php the_content(); ?>
							</div>
							<div class="col-12 mt-2 mb-4">
								<div class="post-tags">
									<?php the_terms( $post->ID, 'tag', '', '' ); ?>
								</div>
							</div>
							<div class="col-12 mt-2 mb-4">
								<a class="btn btn-primary" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
									<?php _e('Sdílet', 'oneindustry'); ?>
								</a>
							</div>
						</div>
					</div>
					<?php if ( comments_open() || get_comments_number() ) : ?>
						<div class="row">
							<div class="col-12">
								<h2 class="line mt-4 mb-3"><?php _e('Diskuze', 'oneindustry'); ?></h2>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<?php comments_template(); ?>
							</div>
						</div>
					<?php endif; ?>

					<?php endwhile; ?>

				<?php else : ?>

				<div class="alert alert-info">
					<strong><?php _e("Zde nic není.", "oneindustry"); ?></strong>
				</div>
			<?php endif; ?>
		</div>
    
    <div class="col-12 col-lg-3">
			<?php get_sidebar(); ?>
    </div>

	</div>
</div>

<?php get_footer(); ?>