<?php
/*
Template Name: Управление контентом
*/
?>

<?php get_header(); ?>

<div class="contentmanagement-wrapper">

  <div id="contentmanagement">
  
    <h1>Управление контентом</h1>
    
    <div class="tours">
      <h2>Туры</h2>
      <p>
          <a class="blue" href="<?php ap_print_search_tour_page_permalink( ); ?>">
              Показать список туров
          </a>
      </p>
      <p>
          <a class="blue" href="<?php ap_print_create_tour_page_permalink( ); ?>">
              Добавить новый тур
          </a>
      </p>
    </div>
    
    <div class="articles">
      <h2>Статьи</h2>
      <p><a class="blue" href="<?php ap_print_blog_url( ); ?>">Показать список статей</a></p>
      <p><a class="blue" href="<?php ap_print_create_article_page_permalink( ); ?>">Добавить новую статью</a></p>
    </div>
    
    <div class="mainpage">
      <h2>Главная страница</h2>
      <p><a class="blue" href="<?php ap_print_page_under_development_permalink( ); ?>">Управление слайдером</a></p>
      <p><a class="blue" href="<?php ap_print_page_under_development_permalink( ); ?>">Статьи на главной</a></p>
    </div>
    
  </div>

</div>

<?php get_footer(); ?>
