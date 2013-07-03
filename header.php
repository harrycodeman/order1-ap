<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description";
	if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s', 'imbalance2' ), max( $paged, $page ) );
?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
	wp_head();
?>

<style type="text/css">
/* color from theme options */
<?php $color = getColor() ?>
body, input, textarea { font-family: <?php echo getFonts() ?>; }
a, .menu a:hover, #nav-above a:hover, #footer a:hover, .entry-meta a:hover { color: <?php echo $color ?>; }
.fetch:hover { background: <?php echo $color ?>; }
blockquote { border-color: <?php echo $color ?>; }
.menu ul .current-menu-item a { color: <?php echo $color ?>; }
#respond .form-submit input { background: <?php echo $color ?>; }

/* fluid grid */
<?php if (!fluidGrid()): ?>
.wrapper { width: 960px; margin: 0 auto; }
<?php else: ?>
.wrapper { width: 100%; margin: 0 auto; }
<?php endif ?>

.box .texts { border: 10px solid <?php echo $color ?>; background: <?php echo $color ?>;  }
<?php if (!imagesOnly()): ?>
.box .categories { padding-top: 15px; }
<?php endif ?>
</style>

<script type="text/javascript">
$(document).ready(function() {
	// shortcodes
	$('.wide').detach().appendTo('#wides');
	$('.aside').detach().appendTo('.entry-aside');

	// fluid grid
<?php if (fluidGrid()): ?>
    function wrapperWidth() {
        var wrapper_width = $('body').width() - 20;
        wrapper_width = Math.floor(wrapper_width / 250) * 250 - 40;
        if (wrapper_width < 1000) wrapper_width = 1000;
        $('.wrapper').css('width', wrapper_width);
    }
    wrapperWidth();
    $(window).resize(function() {
        wrapperWidth();
    });
<?php endif ?>

    // search
    $(document).ready(function() {
        $('#s').val('Search');
    });

	$('#s').bind('focus', function() {
		$(this).css('border-color', '<?php echo $color ?>');
		if ($(this).val() == 'Search') $(this).val('');
	});

	$('#s').bind('blur', function() {
		$(this).css('border-color', '#DEDFE0');
		if ($(this).val() == '') $(this).val('Search');
	});

<?php if ( is_home( ) ): ?>
	// grid
	$('#boxes').masonry({
		itemSelector: '.box',
		columnWidth: 300,
		gutterWidth: 20
	});

	$('#related').masonry({
		itemSelector: '.box',
		columnWidth: 300,
		gutterWidth: 20
	});
<?php endif; ?>

    $(document).on('mouseenter', '.texts',
        function() {
            if ($(this).height() < $(this).find('.abs').height()) {
                $(this).height($(this).find('.abs').height());
            }
            $(this).stop(true, true).animate({
                'opacity': '1',
                'filter': 'alpha(opacity=100)'
            }, 0);
        }
    );
    $(document).on('mouseleave', '.texts',
        function() {
            $(this).stop(true, true).animate({
                'opacity': '0',
                'filter': 'alpha(opacity=0)'
            }, 0);
        }
    );

	// comments
	$('.comment-form-author label').hide();
	$('.comment-form-author span').hide();
	$('.comment-form-email label').hide();
	$('.comment-form-email span').hide();
	$('.comment-form-url label').hide();
	$('.comment-form-comment label').hide();

	if ($('.comment-form-author input').val() == '')
	{
		$('.comment-form-author input').val('Name (required)');
	}
	if ($('.comment-form-email input').val() == '')
	{
		$('.comment-form-email input').val('Email (required)');
	}
	if ($('.comment-form-url input').val() == '')
	{
		$('.comment-form-url input').val('URL');
	}
	if ($('.comment-form-comment textarea').html() == '')
	{
		$('.comment-form-comment textarea').html('Your message');
	}
	
	$('.comment-form-author input').bind('focus', function() {
		$(this).css('border-color', '<?php echo $color ?>').css('color', '#333');
		if ($(this).val() == 'Name (required)') $(this).val('');
	});
	$('.comment-form-author input').bind('blur', function() {
		$(this).css('border-color', '<?php echo '#ccc' ?>').css('color', '#6b6b6b');
		if ($(this).val().trim() == '') $(this).val('Name (required)');
	});
	$('.comment-form-email input').bind('focus', function() {
		$(this).css('border-color', '<?php echo $color ?>').css('color', '#333');
		if ($(this).val() == 'Email (required)') $(this).val('');
	});
	$('.comment-form-email input').bind('blur', function() {
		$(this).css('border-color', '<?php echo '#ccc' ?>').css('color', '#6b6b6b');
		if ($(this).val().trim() == '') $(this).val('Email (required)');
	});
	$('.comment-form-url input').bind('focus', function() {
		$(this).css('border-color', '<?php echo $color ?>').css('color', '#333');
		if ($(this).val() == 'URL') $(this).val('');
	});
	$('.comment-form-url input').bind('blur', function() {
		$(this).css('border-color', '<?php echo '#ccc' ?>').css('color', '#6b6b6b');
		if ($(this).val().trim() == '') $(this).val('URL');
	});
	$('.comment-form-comment textarea').bind('focus', function() {
		$(this).css('border-color', '<?php echo $color ?>').css('color', '#333');
		if ($(this).val() == 'Your message') $(this).val('');
	});
	$('.comment-form-comment textarea').bind('blur', function() {
		$(this).css('border-color', '<?php echo '#ccc' ?>').css('color', '#6b6b6b');
		if ($(this).val().trim() == '') $(this).val('Your message');
	});
	$('#commentform').bind('submit', function(e) {
		if ($('.comment-form-author input').val() == 'Name (required)')
		{
			$('.comment-form-author input').val('');
		}
		if ($('.comment-form-email input').val() == 'Email (required)')
		{
			$('.comment-form-email input').val('');
		}
		if ($('.comment-form-url input').val() == 'URL')
		{
			$('.comment-form-url input').val('');
		}
		if ($('.comment-form-comment textarea').val() == 'Your message')
		{
			$('.comment-form-comment textarea').val('');
		}
	})

	$('.commentlist li div').bind('mouseover', function() {
		var reply = $(this).find('.reply')[0];
		$(reply).find('.comment-reply-link').show();
	});

	$('.commentlist li div').bind('mouseout', function() {
		var reply = $(this).find('.reply')[0];
		$(reply).find('.comment-reply-link').hide();
	});
});
</script>

<?php echo getFavicon() ?>
</head>

<body <?php body_class(); ?>>
<a id="top"></a>
<div class="wrapper">
  <div class="header-wrapper">
    <div id="header">
      <div id="site-title">
        <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
      </div>
        <a href="<?php echo home_url( '/' );?>"><div id="header-logo" style="cursor:pointer;"></div></a>
      <div id="contacts">
                      <div class="phone-code">+7 (3462)</div>
<!--          <div class="phone-code">-->
<!--              <div>+7 (3462)</div>-->
<!--              <div>+7 (3462)</div>-->
<!--          </div>-->
          <div class="phone-number">
              <div class="phone-number-1">23-23-00</div>
              <div>23-23-01</div>
          </div>
          <div class="address">г. Сургут, улица Лермонтова, дом 11/5, офис 210</div>
          <div>
              <a class="blue" href="https://maps.google.com/maps?q=%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F,+%D0%A5%D0%B0%D0%BD%D1%82%D1%8B-%D0%9C%D0%B0%D0%BD%D1%81%D0%B8%D0%B9%D1%81%D0%BA%D0%B8%D0%B9+%D0%B0%D0%B2%D1%82%D0%BE%D0%BD%D0%BE%D0%BC%D0%BD%D1%8B%D0%B9+%D0%BE%D0%BA%D1%80%D1%83%D0%B3+-+%D0%AE%D0%B3%D1%80%D0%B0,+%D0%A1%D1%83%D1%80%D0%B3%D1%83%D1%82,+%D1%83%D0%BB%D0%B8%D1%86%D0%B0+%D0%9B%D0%B5%D1%80%D0%BC%D0%BE%D0%BD%D1%82%D0%BE%D0%B2%D0%B0+%D0%B4%D0%BE%D0%BC+11%2F5&hl=ru&ie=UTF8&ll=61.265044,73.38879&spn=0.004322,0.013239&sll=61.26507,73.38904&sspn=0.008645,0.026479&hnear=%D1%83%D0%BB.+%D0%9B%D0%B5%D1%80%D0%BC%D0%BE%D0%BD%D1%82%D0%BE%D0%B2%D0%B0,+11%2F5,+%D0%A1%D1%83%D1%80%D0%B3%D1%83%D1%82,+%D0%A5%D0%B0%D0%BD%D1%82%D1%8B-%D0%9C%D0%B0%D0%BD%D1%81%D0%B8%D0%B9%D1%81%D0%BA%D0%B8%D0%B9+%D0%B0%D0%B2%D1%82%D0%BE%D0%BD%D0%BE%D0%BC%D0%BD%D1%8B%D0%B9+%D0%BE%D0%BA%D1%80%D1%83%D0%B3+-+%D0%AE%D0%B3%D1%80%D0%B0,+%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F,+628418&t=m&z=17&iwloc=A"
                 target="_blank">
                  Показать на карте
              </a>
          </div>
      </div>
      <div id="header-left"><?php wp_nav_menu( array( 'container_class' => 'menu', 'theme_location' => 'header-left', 'walker' => new Imbalance2_Walker_Nav_Menu(), 'depth' => 1 ) ); ?></div>
      <div id="social-buttons-header" style="width: 170px; height: 54px;">
          <?php if ( is_user_logged_in( ) ) {
              $current_user = wp_get_current_user( ); ?>
              <div style="position: absolute; top: 0; right: 0;">
                  <?php echo $current_user->get( 'user_firstname' ) . ' ' . $current_user->get( 'user_lastname' ) . ' ('
                      . $current_user->get( 'user_login' ) . ')'; ?>
              </div>
              <div style="position: absolute; top: 15px; right: 0;">
                  <a href="<?php ap_print_back_office_main_page_permalink( ); ?>">Управление</a>
              </div>
              <div style="position: absolute; top: 40px; right: 0;">
                  <a href="<?= wp_logout_url( home_url( ) ); ?>">Выйти</a>
              </div>
          <?php }
          else { ?>
              <div class="login-text">
                  <a href="<?= wp_login_url( ap_get_back_office_main_page_permalink( ) ); ?>">Войти</a> на сайт
              </div>
          <?php } ?>
      </div>
      <div id="header-center"><?php wp_nav_menu( array( 'container_class' => 'menu', 'theme_location' => 'header-center', 'walker' => new Imbalance2_Walker_Nav_Menu(), 'depth' => 1 ) ); ?></div>
      <div id="search">
        <?php get_search_form(); ?>
        <div id="header-right"><?php wp_nav_menu( array( 'container_class' => 'menu', 'theme_location' => 'header-right', 'walker' => new Imbalance2_Walker_Nav_Menu(), 'depth' => 1 ) ); ?></div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
