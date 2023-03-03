<?php
/*
Plugin Name: Video To Mp3 Converter
Plugin URI: https://github.com/MuhammadUsman0304/Category-Wise-Posts-with-Thumbnails
Description: Small and fast plugin to convert video to mp3 formate
Version: 1.0.0
Author: Muhammad Usman
Author URI: https://www.linkedin.com/in/muhammad-usman-b3439218b/
License: GPLv2 or later
Text Domain: video-to-mp3-converter
*/

defined('ABSPATH') || die("hey you can't call me :) ");

if (!class_exists('video_to_mp3_converter')) {
    class video_to_mp3_converter
    {
        public function __construct()
        {
            add_shortcode('convertform', array($this, 'short_code'));
        }
        public function short_code()
        {
            if (isset($_POST['download'])) {
                $name = uniqid() . '.mp3';
                $dir_path = plugin_dir_path(__FILE__) . 'files/';
                // $dir_path = plugin_dir_url(__FILE__) . 'files/';
                move_uploaded_file($_FILES['video_file']['tmp_name'], "$dir_path/$name");
                echo "<script>window.location.href='" . plugin_dir_url(__FILE__) . "'converter.php?fl=$name</script>";
            } else {
                ob_start();
?>
                <form action="" method="post" enctype="multipart/form-data">
                    <p>
                        <label for="video-link">Video Link</label>
                        <input type="file" name="video_file" id="video_file" required>
                    </p>
                    <p>
                        <input type="submit" value="Download" name="download">
                    </p>
                </form>

<?php
                return ob_get_clean();
            }
        }
    }
}

new video_to_mp3_converter();
