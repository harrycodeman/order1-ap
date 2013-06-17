    <div id="footer-placeholder"></div>

    <div class="footer-wrapper">
        <div id="footer">
            <div id="footer-logo"></div>

            <div id="site-info">
                <p>© 2013 — Туристическое бюро "Алые паруса"<br/></p>
                <p>Представленная информация не является публичной офертой<br/></p>
                <p>Использование материалов сайта разрешено только с письменного разрешения администрации сайта
                    <a href="/">alyeparusa.info</a></p>
            </div><!-- #site-info -->

            <div id="footer-right">
                <a href="#top">Наверх ↑</a>
                <?php wp_nav_menu( array( 'container_class' => 'menu', 'theme_location' => 'footer-right', 'walker' => new Imbalance2_Walker_Nav_Menu(), 'depth' => 1 ) ); ?>
            </div><!--#footer-right-->

            <div id="footer-center">
                <a href="http://vk.com/alyeparusasurgut">
                    <img src="<?php ap_print_image_url('footer-social-icon-vk.png'); ?>" alt="ВКонтакте"
                        height="21px">
                </a>

            </div><!--footer-center-->

            <div id="footer-left">
                <?php wp_nav_menu( array(
                    'container_class' => 'menu',
                    'theme_location' => 'footer-left',
                    'walker' => new Imbalance2_Walker_Nav_Menu(),
                    'depth' => 1 ) ); ?>
            </div><!--footer-left-->

            <div class="clear"></div>
        </div><!-- #footer -->
    </div><!-- .footer-wrapper -->
</div><!-- .wrapper -->

<?php wp_footer(); ?>
<?php echo imbalance2google() ?>

</body>
</html>
