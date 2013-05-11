<?php get_header(); ?>

		<div id="content">

            <div>
                <p>Запись имеет тип "Тур"
<?php
function get_queryvar($varname)
{
    global $wp_query;
    if (isset($wp_query->query_vars[$varname]))
    {
        return $wp_query->query_vars[$varname];
    }
    return NULL;
}

echo get_queryvar( 'mode' );
?>
                </p>
            </div>

		<?php get_template_part( 'loop', 'single' ); ?>

		</div><!-- #content -->

<?php get_footer(); ?>
