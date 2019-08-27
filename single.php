<?php get_header(); ?>

<div class="container">
			
  <div class="row">
    <div class="col-12 col-lg-9 left-side">
			<?php if(have_posts()) : ?>
					<?php while(have_posts()) : the_post(); ?>
					<?php echo get_hansel_and_gretel_breadcrumbs(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('bg-light pt-4 pl-6 pr-6 pb-3'); ?>>
						<div class="row mb-4 mt-2">
							<div class="header-meta col-12 text-right pt-3 pb-4 font-weight-bold">
								<span class="text-uppercase">
									<?php if ( 'post' == get_post_type() ) : ?>
										<?php 
											$cats = get_the_category();
											$cat = $cats[0];
											$cat_name = $cat->name;
											echo $cat_name; ?>	
									<?php else : ?>
										<?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name); ?>
									<?php endif; ?>
								</span> | <?php the_date(); ?>
							</div>
							<div class="col-12">
								<?php the_title('<h1 class="post-title">','</h1>'); ?>
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
								<div class="fb-like d-inline-block" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-size="large" data-show-faces="false" data-share="true"></div>
								<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button d-inline-block" data-size="large" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
								<a class="btn btn-linkedin d-inline-block rounded btn-sm" target="_blank" href="https://www.linkedin.com/shareArticle?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&source=oneindustry.one"
><i class="fa fa-linkedin-square mr-1" aria-hidden="true"></i> <?php _e('Sdílet na LinkedIn', 'oneindustry'); ?></a>
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
    
    <div class="col-12 col-lg-3 rightside">
			<?php get_sidebar(); ?>
    </div>

	</div>
</div>

<?php get_footer(); ?>