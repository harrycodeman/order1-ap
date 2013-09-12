<?php
/*
Template Name: Добавление статьи
*/

if ( !is_user_logged_in( ) ) {
    ap_show_error( 'low_rights' );
}
else {
    if ( ap_is_view_mode( ) ) {
        get_header( ); ?>
            <div class="addarticle-wrapper">
                <div id="addarticle">
                    <h1 class="moderating-header">Добавление статьи</h1>
                    <form name="create-tour-form" action="<?php ap_print_create_article_page_permalink( ); ?>" method="post"
                          enctype="multipart/form-data">
                        <div class="article">
                            <div>
                                <div>
                                    <p><label for="articlename-addarticle-form">Название статьи:</label></p>
                                    <input type="text" id="articlename-addarticle-form" name ="ap_article_title"
                                        required />
                                </div>
                                <div>
                                    <p><label for="quote-addarticle-form">Цитата (короткий текст в списке статей):</label></p>
                                    <textarea id="quote-addarticle-form" name="ap_article_excerpt" rows="5" cols="90"></textarea>
                                </div>
                                <div>
                                    <p><label for="text-addarticle-form">Полный текст статьи:</label></p>
                                    <textarea id="text-addarticle-form" name="ap_article_content" rows="15" cols="90"
                                              required>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="photo">
                            <div>
                                <p><label for="photo-addtour-file">Иконка для списка статей</label></p>
                                <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                                <input name="ap_article_icon" id="photo-addtour-file" type="file" accept="image/*"
                                       required>
                                <input name="ap_article_icon_crop_x" id="photo-addtour-file_crop_x" type="hidden">
                                <input name="ap_article_icon_crop_y" id="photo-addtour-file_crop_y" type="hidden">
                                <input name="ap_article_icon_crop_width" id="photo-addtour-file_crop_width" type="hidden">
                                <input name="ap_article_icon_crop_height" id="photo-addtour-file_crop_height" type="hidden">
                            </div>
                        </div>
                        <br><br>
                        <div class="submitbuttons">
                            <div>
                                <button id="cancel-addarticle-button" type="reset">ОТМЕНИТЬ</button>
                                <button id="create-addarticle-button" type="submit">СОЗДАТЬ</button>
                            </div>
                        </div>
                        <br><br>
                    </form>
                </div>
            </div>
        <?php
        ap_init_image_cropper( );
        ap_add_image_cropper_to_element( '#photo-addtour-file' );

        get_footer( );
    }
    else {
        $article = new AP_Article( );
        $article->title = $_POST['ap_article_title'];
        $article->excerpt = $_POST['ap_article_excerpt'];
        $article->content = $_POST['ap_article_content'];
        if ( is_uploaded_file( $_FILES['ap_article_icon']['tmp_name'] ) ) {
            $article->set_icon(
                AP_Image::load_from_file_object(
                    $_FILES['ap_article_icon'],
                    array(
                        'x' => $_POST['ap_article_icon_crop_x'],
                        'y' => $_POST['ap_article_icon_crop_y'],
                        'width' => $_POST['ap_article_icon_crop_width'],
                        'height' => $_POST['ap_article_icon_crop_height']
                    )
                )
            );
        }

        $article->save( );
        wp_safe_redirect( ap_get_create_article_page_permalink( ) );
    }
}
?>
