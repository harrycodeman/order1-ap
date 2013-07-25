<?php
/*
Template Name: Добавление статьи
*/
?>

<?php get_header(); ?>

<div class="addarticle-wrapper">

  <div id="addarticle">
  
    <center><h1>Добавить статью</h1></center>
    
    <div class="article">
      <div>
      
        <div>
          <p>Название статьи:</p>
          <input type="text" id="articlename-addarticle-form"/>
        </div>
        
        <div>
          <p>Цитата (короткий текст в списке статей):</p>
          <textarea id="quote-addarticle-form" rows="5" cols="90"></textarea>
        </div>
        
        <div>
          <p>Полный текст статьи:</p>
          <textarea id="text-addarticle-form" rows="15" cols="90"></textarea>
        </div>
        
      </div>
      
    </div>
    
    <br><br>
    
    <div class="photo">
      <p>Фотографии:</p>
      <div class="item">
        <img src="" width="100px" height="100px">
        <p>Имя фотографии.jpg</p>
        <a href="" alt="Удалить фотографию из списка">Удалить</a>
      </div>
      <div class="item">
        <img src="" width="100px" height="100px">
        <p>Имя фотографии.jpg</p>
        <a href="" alt="Удалить фотографию из списка">Удалить</a>
      </div>
      <div class="item">
        <img src="" width="100px" height="100px">
        <p>Имя фотографии.jpg</p>
        <a href="" alt="Удалить фотографию из списка">Удалить</a>
      </div>
      <div class="item">
        <img src="" width="100px" height="100px">
        <p>Имя фотографии.jpg</p>
        <a href="" alt="Удалить фотографию из списка">Удалить</a>
      </div>
      <div class="item">
        <img src="" width="100px" height="100px">
        <p>Имя фотографии.jpg</p>
        <a href="" alt="Удалить фотографию из списка">Удалить</a>
      </div>
      <div class="item">
        <img src="" width="100px" height="100px">
        <p>Имя фотографии.jpg</p>
        <a href="" alt="Удалить фотографию из списка">Удалить</a>
      </div>
      
      <div class="addphoto">
        <input id="photo-addarticle-file" type="file" name="">
      </div>
    </div>
    
    <br><br>
    
    <div class="submitbuttons">
      <div>
        <button id="cancel-addarticle-button" type="button">ОТМЕНИТЬ</button>
        <button id="create-addarticle-button" type="button">СОЗДАТЬ</button>
      </div>
    </div>
    
    <br><br>
    
  </div>
</div>
<?php get_footer(); ?>
