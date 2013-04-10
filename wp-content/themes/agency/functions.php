<?php //wp 3 menus

if (function_exists('add_theme_support')) {

    add_theme_support('menus');

}

//dynamic menus

function register_my_menus() {

    register_nav_menus(

        array(

            'primary' => __( 'Header Menu' )

        )

    );

}

add_action( 'init', 'register_my_menus' );

//take out elipsis - excerpt

function trim_excerpt($text) {

    return rtrim($text,'[...]');

}

add_filter('get_the_excerpt', 'trim_excerpt');

//return new excerpt length

function new_excerpt_length($length) {

    return 70;

}

add_filter('excerpt_length', 'new_excerpt_length');

//add jquery

function insert_jquery(){

    wp_enqueue_script('jquery');

}

add_action('init', 'insert_jquery');

//widgetize

if ( function_exists('register_sidebars') )

    register_sidebars(2, array(

        'name'=> 'sidebar %d',

        'before_widget' => '<div class="sidebar-row">',

        'after_widget' => '</div>',

        'before_title' => '<h3>',

        'after_title' => '</h3>',

    ));

//remove inline style - gallery

add_filter( 'use_default_gallery_style', '__return_false' );

function remove_gallery_css( $css ) {

    return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );

}

// Backwards compatibility with WordPress 3.0.

if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )

    add_filter( 'gallery_style', 'remove_gallery_css' );

// post thumbnails

if ( function_exists( 'add_theme_support' ) ) {

    add_theme_support( 'post-thumbnails' );

    set_post_thumbnail_size( 620, 150, true ); //the large feature size

    add_image_size('the-reg-thumb', 172, 25, true);

}

//shorten post titles

function short_title($after = '', $length) {

    $mytitle = explode(' ', get_the_title(), $length);

    if (count($mytitle)>=$length) {

        array_pop($mytitle);

        $mytitle = implode(" ",$mytitle). $after;

    } else {

        $mytitle = implode(" ",$mytitle);

    }

    return $mytitle;

}

//feature titles shortenned

function feature_title(){

    $mytitle = get_the_title();

    return substr($mytitle, 0, 40) . '...';

}


// Hostenko 
// убираем виджеты с дашборда
function remove_dashboard_widgets(){
    global$wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');


// Виджет темы в dashboard
add_action('wp_dashboard_setup', 'my_dashboard_video');
function my_dashboard_video() {
    global $wp_meta_boxes;
    wp_add_dashboard_widget('custom_videohelp_widget', 'Видеоинструкция по настройке темы', 'custom_dashboard_video');
}

function custom_dashboard_video() {
    echo '<div class="video" align="center"><iframe width="500" height="312" src="http://www.youtube.com/embed/gTn7vZbw9Bk" frameborder="0" allowfullscreen></iframe></div>';
}

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
    global $wp_meta_boxes;
    wp_add_dashboard_widget('custom_help_widget', 'Описание темы', 'custom_dashboard_help');
}
function custom_dashboard_help() {
    echo '<a href="http://hostenko.com"><img src="http://hostenko.com/pics/widget_logo.png" style="float: left; margin: 0 10px 10px 0;"></a>
<p><b>Перед наполнением Вашего сайта информацией рекомендуем ознакомиться с <a href="http://hostenko.com/theme_description.php?theme=18">руководством по данной теме</a></b>.</p></br>
<p>Тема переведена <a href="http://hostenko.com">Hostenko</a> — специализированным хостингом для сайтов на WordPress с мастером его автоматической установки.</p>';
}


// Копирайт в футере
function remove_footer_admin () {
    echo 'Русские <a href="http://hostenko.com/themes">WordPress темы</a> — <a href="http://hostenko.com">Hostenko</a>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// меню Хостенко
add_action("admin_bar_menu", "customize_menu");
function customize_menu(){
    global $wp_admin_bar;
    $wp_admin_bar->add_menu(array(
        "id" => "hostenko_menu",
        "title" => "Hostenko",
        "href" => "http://hostenko.com",
        "meta" => array("target" => "blank")
    ));
    $wp_admin_bar->add_menu(array(
        "id" => "hostenko_menu_child",
        "title" => "Личный кабинет",
        "parent" => "hostenko_menu",
        "href" => "http://hostenko.com/cabinet",
        "meta" => array("target" => "blank")
    ));
    $wp_admin_bar->add_menu(array(
        "id" => "hostenko_menu_child2",
        "title" => "Zendroids Team",
        "parent" => "hostenko_menu",
        "href" => "http://zendroidu.pp.ua",
        "meta" => array("target" => "blank")
    ));
    $wp_admin_bar->add_menu(array(
        "id" => "hostenko_menu_child3",
        "title" => "Блог Zendroids",
        "parent" => "hostenko_menu",
        "href" => "http://zendroidu.pp.ua",
        "meta" => array("target" => "blank")
    ));
}
// RSS-виджет Wordpresso
function wordpresso_rss_output(){
    echo '<div class="rss-widget">';
    echo '<a href="http://wordpresso.org"><img src="http://wordpresso.org/pics/widget_logo.png" style="float: left; margin: 0 10px 10px 0;"></a><br style="clear:both;"/>';
    wp_widget_rss_output(array(
        'url' => 'http://feeds.feedburner.com/Wordpresso',
        'title' => 'Wordpresso RSS',
        'items' => 3,
        'show_summary' => 1,
        'show_author' => 0,
        'show_date' => 1
    ));

    echo "</div>";
}
add_action('wp_dashboard_setup', 'wordpresso_rss_widget');
function wordpresso_rss_widget(){
    wp_add_dashboard_widget( 'wordpresso-rss', 'Wordpresso RSS', 'wordpresso_rss_output');
}

?>