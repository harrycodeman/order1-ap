<?php
class AP_Image {
    public $id;
    private $server_path;
    private $mime_type;
    private $url;

    private $crop_x;
    private $crop_y;
    private $crop_width;
    private $crop_height;

    public static function cast( AP_Image $image = NULL ) {
        return $image;
    }

    public static function load_from_file_object( $file, array $crop_info ) {
        function_exists( 'wp_handle_upload' ) or require_once( ABSPATH . 'wp-admin/includes/file.php' );
        $required_for_upload_options = array( 'test_form' => false );
        $uploaded_file = wp_handle_upload( $file, $required_for_upload_options );

        $result = new AP_Image();
        $result->url = $uploaded_file['url'];
        $result->server_path = $uploaded_file['file'];
        $result->mime_type = $uploaded_file['type'];

        $result->crop_x = $crop_info["x"];
        $result->crop_y = $crop_info["y"];
        $result->crop_width = $crop_info["width"];
        $result->crop_height = $crop_info["height"];
        return $result;
    }

    public static function load_from_id( $id ) {
        $result = new AP_Image();
        $result->id = $id;
        $result->server_path = get_attached_file( $result->id );
        $result->url = wp_get_attachment_url( $result->id );
        return $result;
    }

    public function get_server_path( ) {
        return $this->server_path;
    }

    public function get_url( ) {
        return $this->url;
    }

    public function save( $width = 0, $height = 0 ) {
        if ( empty( $this->id ) ) {
            $this->crop_if_need( );
            $this->resize_if_need( $width, $height );
            $this->create_attachment( );
        }
    }

    private function crop_if_need( ) {
        if ( $this->crop_width > 0
                && $this->crop_height > 0 ) {
            $image_editor = wp_get_image_editor( $this->server_path );

            // TODO: убрать костыль в виде постоянной максимальной ширины в 920px
            $real_size = $image_editor->get_size( );
            if ( $real_size['width'] > 920 ) {
                $scale_c = $real_size['width'] / 920;
                $this->crop_x *= $scale_c;
                $this->crop_y *= $scale_c;
                $this->crop_width *= $scale_c;
                $this->crop_height *= $scale_c;
            }

            if ( !is_wp_error( $image_editor ) ) {
                $image_editor->crop( $this->crop_x, $this->crop_y, $this->crop_width, $this->crop_height );
                $image_editor->save( $this->server_path );
            }
            else {
                throw new Exception(' resize if need ');
            }
        }
    }

    private function resize_if_need( $width, $height ) {
        if ( $width > 0
                && $height > 0 ) {
            $image_editor = wp_get_image_editor( $this->server_path );
            if ( !is_wp_error( $image_editor ) ) {
                $image_editor->resize( $width, $height );
                $image_editor->save( $this->server_path );
            }
            else {
                throw new Exception(' resize if need ');
            }
        }
    }

    private function create_attachment( ) {
        $attachment = array(
            'guid' => $this->url,
            'post_mime_type' => $this->mime_type,
            'post_title' => '',
            'post_content' => '',
            'post_status' => 'inherit'
        );
        $this->id = wp_insert_attachment( $attachment, $this->server_path );

        function_exists( 'wp_generate_attachment_metadata' ) or require_once( ABSPATH . 'wp-admin/includes/image.php' );
        wp_update_attachment_metadata( $this->id,
            wp_generate_attachment_metadata( $this->id, $this->server_path )
        );
    }
}
