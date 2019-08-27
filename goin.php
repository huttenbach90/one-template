<?php
/* Template Name: Login */
?>

<?php get_header(); ?>

<div class="container">
			
  <div class="row">
    <div class="col-12 col-lg-9 left-side">
			<?php if(have_posts()) : ?>
				<?php the_title('<h2 class="line mt-4 mb-3">','</h2>'); ?>
				<?php $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0; ?>
				<?php 
					if ( $login === "failed" ) {
						echo '<div class="alert alert-danger login-msg">' . __('Chybná kombinace uživatelského jména a hesla.', 'oneindustry') . '</div>';
					} elseif ( $login === "empty" ) {
						echo '<div class="alert alert-danger login-msg">' . __('Vyplňte prosím všechna pole.', 'oneindustry') . '</div>';
					} elseif ( $login === "false" ) {
						echo '<div class="alert alert-warning login-msg">' . __('Byli jste odhlášeni.', 'oneindustry') . '</div>';
					}
				?>
				<?php while(have_posts()) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('bg-light pt-4 pl-6 pr-6 pb-3'); ?>>
						<div class="row">
							<div class="col-12">
								<?php if (is_user_logged_in()) : ?>
									<div class="alert alert-info"><?php _e('Již jste přihlášeni.', 'oneindustry'); ?> <a class="c-dark" href="<?php echo wp_logout_url( get_permalink() ); ?>"><u><?php _e('Odhlásit?', 'oneindustry'); ?></u></a></div>
								<?php else : ?>
									<?php
										$args = array(
												'redirect' => esc_url($_SERVER['HTTP_REFERER']), 
												'id_username' => 'user',
												'id_password' => 'pass',
												'remember' => false
											) 
									;?>
									<?php wp_login_form( $args ); ?>
									<script>
										jQuery(document).ready(function (){
											jQuery("#pass, #user").prop("required", "true");
											jQuery('#user').attr('placeholder', 'E-mail');
											jQuery('#pass').attr('placeholder', 'Heslo');
										});
									</script>
								<?php endif; ?>
							</div>
						</div>
						<?php 
							if ( has_post_thumbnail() ) {
								echo '<div class="row mt-3 mb-4"><div class="col-12">';
								echo the_post_thumbnail( 'large' );
								echo '</div></div>';
							}
						?>
					</div>
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