<?php
/*
Template Name: Добавление статьи
*/
?>

<?php get_header(); ?>

<div class="addarticle-wrapper">
  <div id="addarticle">
		<div style="text-align: center;"><h1>Добавить статью</h1></div>
		
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
		  </div>		  <div class="item">
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
			<form id="load-image-form" method="post" enctype="multipart/form-data">
				<input id="photo-addarticle-file" type="file" name="photo-filename" accept="image/*">
			</form>
		  </div>
		</div>
		
		<br><br>
		
		<div class="submitbuttons">
		  <div>
			<button id="cancel-addarticle-button" type="cancel">ОТМЕНИТЬ</button>
			<button id="create-addarticle-button" type="submit">СОЗДАТЬ</button>
		  </div>
		</div>
		
		<br><br>
		
  </div>
</div>

<script type="text/javascript">	
$(function() {
	$("#photo-addarticle-file").change(function() {
		$("#load-image-form").submit();
	});
});
</script>
<?php get_footer(); ?>
