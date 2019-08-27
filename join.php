<?php
/* Template Name: Register */
?>

<?php get_header(); ?>

<div class="container">
			
  <div class="row">
    <div class="col-12 col-lg-9 left-side">
			<?php if(have_posts()) : ?>
				<?php the_title('<h2 class="line mt-4 mb-3">','</h2>'); ?>

				<?php if(is_user_logged_in()) : ?>
					<div class="alert alert-info"><?php _e('Jste přihlášeni. Pro novou registraci se musíte', 'oneindustry'); ?> <a class="c-dark" href="<?php echo wp_logout_url(get_permalink()); ?>"><u><?php echo __("odhlásit", "oneindustry"); ?></u></a>.</div>
				<?php else : ?>
					<?php while(have_posts()) : the_post(); ?>
						<div id="post-<?php the_ID(); ?>" <?php post_class("bg-light pt-4 pl-6 pr-6 pb-3"); ?>>
							<div class="row">
								<div class="col-12 pt-3">
									<?php the_content(); ?>
									<?php echo do_shortcode("[dm_registration_form]"); ?>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>

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