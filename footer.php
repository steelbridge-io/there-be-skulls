<footer class="bg-black py-4 text-center">
  <div class="container bg-black">
    <div id="footer-row" class="row">
      <!-- Footer Column 1 -->
      <div class="col-lg-4">
        <?php if (is_active_sidebar('footer-1')) : ?>
          <?php dynamic_sidebar('footer-1'); ?>
        <?php endif; ?>
      </div>

      <!-- Footer Column 2 -->
      <div class="col-lg-4">
        <?php if (is_active_sidebar('footer-2')) : ?>
          <?php dynamic_sidebar('footer-2'); ?>
        <?php endif; ?>
      </div>

      <!-- Footer Column 3 -->
      <div class="col-lg-4">
        <?php if (is_active_sidebar('footer-3')) : ?>
          <?php dynamic_sidebar('footer-3'); ?>
        <?php endif; ?>
      </div>
    </div>

    <p class="small mb-2">&copy; <?php echo date("Y"); ?> There Be Skulls. All Rights Reserved.</p>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
