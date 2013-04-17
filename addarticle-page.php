<?php
/*
Template Name: Addarticle-page
*/
?>

<?php get_header(); ?>

<?php
if ( $_SERVER['REQUEST_METHOD'] == 'POST'
        && $_FILES["photo-filename"]["size"] > 0) {

    //function 1 create post
    $source = array(
        'post_title' => $_FILES["photo-filename"]["name"],
        'post_name' => 'test',
        'post_excerpt' => 'Цитата поста2',
        'post_content' => 'Удалось!!',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_type' => 'post',
    );
    $post_id = wp_insert_post($source);

    //function 2 upload file
    if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
    $uploaded_file = $_FILES['photo-filename'];
    $upload_overrides = array( 'test_form' => false );
    $move_file = wp_handle_upload( $uploaded_file, $upload_overrides );
    if ( $move_file ) {
        echo "File is valid, and was successfully uploaded.\n";
        var_dump( $move_file);
    } else {
        echo "Possible file upload attack!\n";
    }

    //function 3 attach file
    $filename = $move_file['file'];
    $wp_filetype = wp_check_filetype(basename($filename), null );
    $wp_upload_dir = wp_upload_dir();
    $attachment = array(
        'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ),
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $filename, $post_id);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
    wp_update_attachment_metadata( $attach_id, $attach_data );

    update_post_meta( $post_id, '_thumbnail_id', $attach_id );
}
?>

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
