<?php
class AP_Article {
    const icon_meta_name = 'ap_article_icon';
    const banner_meta_name = 'ap_article_banner';
    const country_meta_name = 'ap_article_country';
    const resort_meta_name = 'ap_article_resort';
    const quote_meta_name = 'ap_article_quote';

    public $id;

    public $title;
    public $quote;
    public $content;
    public $country;
    public $resort;
    private $icon;
    private $banner;

    public function set_icon( AP_Image $image = NULL ) {
        $this->icon = $image;
    }

    public function get_icon( ) {
        return AP_Image::cast( $this->icon );
    }

    public function set_banner( AP_Image $image = NULL ) {
        $this->banner = $image;
    }

    public function get_banner( ) {
        return AP_Image::cast( $this->banner );
    }

    public function load( $article_id ) {
        $this->id = $article_id;

        $article_post = get_post( $this->id );
        $this->title = $article_post->post_title;
        $this->content = $article_post->post_content;

        $this->quote = $this->load_meta( self::quote_meta_name );
        $this->country = $this->load_meta( self::country_meta_name );
        $this->resort = $this->load_meta( self::resort_meta_name );
        $this->icon = $this->load_image( self::icon_meta_name );
        $this->banner = $this->load_image( self::banner_meta_name );
    }

    private function load_image( $meta_name ) {
        $image_id = $this->load_meta( $meta_name );
        if ( !empty( $image_id ) ) {
            return AP_Image::load_from_id( $image_id );
        }
        return NULL;
    }

    private function load_meta( $meta_name ) {
        return get_post_meta( $this->id, $meta_name, true );
    }

    public function save( ) {
        if ( empty( $this->id ) ) {
            $this->create_post();
        }
        else {
            $this->update_post();
        }
        $this->save_info();
    }

    private function create_post( ) {
        $article_info = array(
            'comment_status' => 'closed',
            'post_author' => get_current_user_id(),
            'post_content' => $this->content,
            'post_title' => $this->title,
            'post_name' => $this->title,
            'post_status' => 'publish',
        );
        $this->id = wp_insert_post($article_info);
    }

    private function update_post( ) {
        $article_info = array(
            'ID' => $this->id,
            'comment_status' => 'closed',
            'post_author' => get_current_user_id(),
            'post_content' => $this->content,
            'post_title' => $this->title,
            'post_name' => $this->title,
            'post_status' => 'publish',
        );
        $this->id = wp_update_post($article_info);
    }

    private function save_info( ) {
        $this->save_meta( self::quote_meta_name, $this->quote );
        $this->save_meta( self::country_meta_name, $this->country );
        $this->save_meta( self::resort_meta_name, $this->resort );
        $this->save_image( $this->icon, self::icon_meta_name );
        $this->save_image( $this->banner, self::banner_meta_name, 960, 382 );
    }

    private function save_image( AP_Image $image = NULL, $meta_name, $width = 0, $height = 0 ) {
        if ( !empty( $image ) ) {
            $image->save( $width, $height );
            update_post_meta( $this->id, $meta_name, esc_attr($image->id) );
        }
        else {
            delete_post_meta( $this-> id, $meta_name);
        }
    }

    private function save_meta( $meta_name, $meta_value ) {
        if ( empty( $meta_value ) ) {
            delete_post_meta( $this-> id, $meta_name);
        }
        else {
            update_post_meta( $this->id, $meta_name, esc_attr($meta_value) );
        }
    }

    public function delete( ) {
        wp_delete_post( $this->id, true );
    }
}

function ap_get_articles( array $params ) {
    $params = array_merge(
        array( 'post_type' => 'post' ),
        $params
    );

    $result_articles = array( );
    $article_posts = get_posts( $params );
    foreach ($article_posts as $article_post) {
        $article = new AP_Article( );
        $article->load( $article_post->ID );
        array_push( $result_articles, $article );
    }
    return $result_articles;
}

function ap_get_article_by_id( $id ) {
    $article = new AP_Article( );
    $article->load( $id );
    return $article;
}
