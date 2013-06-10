  <div class="footer-wrapper">
    <div id="footer">
      <div id="footer-logo"></div>
      <div id="site-info">
        <p>© 2013 — Туристическое бюро "Алые паруса"<br/></p>
        <p>Использование материалов сайта разрешено только с письменного разрешения администрации сайта <a href="/">domain.ru</a></p>
      </div><!-- #site-info -->
      <div id="footer-right">
        <a href="#top">Наверх ↑</a>
        <?php wp_nav_menu( array( 'container_class' => 'menu', 'theme_location' => 'footer-right', 'walker' => new Imbalance2_Walker_Nav_Menu(), 'depth' => 1 ) ); ?>
      </div>
      <div id="footer-center">
        <a href="http://facebook.com">
            <img src="<?php ap_print_image_url('footer-social-icon-fb.png'); ?>" alt="Facebook">
        </a>
        <a href="http://vk.com">
            <img src="<?php ap_print_image_url('footer-social-icon-vk.png'); ?>" alt="ВКонтакте">
        </a>
        <a href="http://instagram.com">
            <img src="<?php ap_print_image_url('footer-social-icon-insta.png'); ?>" alt="Instagram">
        </a>
        <a href="http://twitter.com">
            <img src="<?php ap_print_image_url('footer-social-icon-tw.png'); ?>" alt="Twitter">
        </a>
        <p>Мы в социальных сетях</p>
      </div>
      <div id="footer-left"><?php wp_nav_menu( array( 'container_class' => 'menu', 'theme_location' => 'footer-left', 'walker' => new Imbalance2_Walker_Nav_Menu(), 'depth' => 1 ) ); ?></div>
      <div class="clear"></div>
    </div><!-- #footer -->
  </div><!-- .footer-wrapper -->
  
</div><!-- .wrapper -->

<?php wp_footer(); ?>

<?php echo imbalance2google() ?>

</body>
</html>
