<footer class="bg-dark text-center mt-5 pt-3 pb-5">
  <div class="container">
    <div class="row">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("footer-links") ) : ?>
        <div class="col-12 text-white">
          <?php dynamic_sidebar("footer-links"); ?>
        </div>
      <?php endif;?>
      <div class="col-12 text-white">
        <strong><?php _e("", "oneindustry"); ?></strong>
        <span class="d-block">&copy; <?php echo date("Y"); ?> <?php _e("ONEINDUSTRY / Všechna práva vyhrazena", "oneindustry"); ?></span>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</body>
</html>