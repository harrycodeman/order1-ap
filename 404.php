<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>Не получается найти страницу</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php echo getFavicon() ?>
</head>

    <body>

    <div class="error-wrapper">
        <a href="<?= home_url( '/' ); ?>" >
            <div id="header-logo-inverted" style="cursor:pointer; margin: 0 auto;"></div>
        </a>
        <div id="container">
            <div id="content" role="main">

                <div id="post-0" class="post error404" style="text-align: center; color: lightgrey;">
                    <h1 class="entry-title" style="margin-left: 0;">
                        <?php _e( '404! Не получается найти страницу!', 'imbalance2' ); ?>
                    </h1>
                    <div class="entry-content" style="margin-left: 0; width: 960px;">
                        <p><?php _e( 'Запрошенная Вами страница не может быть отображена.', 'imbalance2' ); ?></p>
                    </div><!-- .entry-content -->
                </div><!-- #post-0 -->

            </div><!-- #content -->
        </div><!-- #container -->
    </div><!-- .error-wrapper-->

    </body>
</html>
