<?php
/*
   翻譯支持
   Translations can be filed in the /languages/ directory.
   翻譯文件在 /languages/
*/
  	load_theme_textdomain( 'Carter', get_template_directory() . '/languages' );
/*
	特色圖片支持
*/
	add_theme_support( 'post-thumbnails' );
/*
	讓文本小工具可以支援短 code
*/
	add_filter('widget_text', 'do_shortcode');
/*
	文章格式支援（測試中）
*/
	add_theme_support( 'post-formats', array( 'aside', 'chat','gallery','image','link', 'quote', 'status', 'video', 'audio' ) );
/*
    頁首圖片支持！
*/
$defaults = array(
	'default-image'          => '',
	'width'                  => 1800,
	'height'                 => 500,
	'flex-height'            => false,
	'flex-width'             => false,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => true,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );
/*
	留言框架
*/
function aurelius_comment($comment, $args, $depth) 
{
   $GLOBALS['comment'] = $comment; ?>
   
	<div class="ts comments" data-dark>
		<div class="comment">
			<a class="avatar">
				<?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 48); } ?>
			</a>
			<div class="content">
				<?php printf(__('%s'), get_comment_author_link()); ?>
				<div class="metadata">
					<div><?php echo get_comment_time('Y-m-d H:i'); ?></div>
					<a name="comment-<?php comment_ID() ?>"></a>
				</div>
				<div class="text">
					<?php comment_text(); ?>
				</div>
				<div class="actions">
					<?php comment_reply_link(array_merge( $args, array('reply_text' => __( 'Reply', 'Carter' ),'depth' => $depth, 'max_depth' => $args['max_depth']))) ?> 
					<?php edit_comment_link(__( 'Edit', 'Carter' )); ?>
				</div>
			</div>
		</div>
	</div>
<?php } 
/*
	本日更新!
	<?php update_today();?> 來使用
	預設在 sidebarowo 有套用在最上面
*/         
function update_today(){
    $args = array('date_query' => array(
        array(
            'year'  => date('Y'),
            'month' => date('m'),
            'day' => date('d')
        ),
    ),'ignore_sticky_posts' => 1);
    $postslist = get_posts( $args );
    if($postslist){
        echo '<div class="widget_text ts segment sidebarowo" data-dark><h5 class="ts header" style="margin-bottom: 5px;" data-dark>'.__( 'Updated today', 'Carter' ).'</h5>'.__( 'Updated today', 'Carter' ).' '. count($postslist) .__( ' item,', 'Carter' ). '<a href="' . home_url('/').date('Y/m/d') . '">'.__( 'Read More', 'Carter' ).'</a>。</div>';
    }else{
        return false;
    }
}

/*
	側邊欄
*/
function register_Right_sidebar() {
    register_sidebar( array(
       	'name' => __( 'Sidebar', 'Carter' ),
		'id' => 'sidebar',
		'description' => __( 'Displayed on the right side of each page.', 'Carter' ),
		'before_widget' => '<div class="ts segment sidebarowo" data-dark>',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="ts header" style="margin-bottom: 5px;" data-dark>',
		'after_title' => '</h5>'
    ) );
}
add_action( 'widgets_init', 'register_Right_sidebar' );
/*
	底部欄 1
*/
function register_Footer1() {
    register_sidebar( array(
       	'name' => __( 'Footer 1', 'Carter' ),
		'id' => 'footer1',
		'description' => __( 'Displayed at the bottom of each page.', 'Carter' ),
		'before_widget' => '<div class="ts segment sidebarowo" data-dark>',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="ts header" style="margin-bottom: 5px;" data-dark>',
		'after_title' => '</h5>'
    ) );
}
add_action( 'widgets_init', 'register_Footer1' );
/*
	底部欄 2
*/
function register_Footer2() {
    register_sidebar( array(
       	'name' => __( 'Footer 2', 'Carter' ),
		'id' => 'footer2',
		'description' => __( 'Displayed at the bottom of each page.', 'Carter' ),
		'before_widget' => '<div class="ts segment sidebarowo" data-dark>',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="ts header" style="margin-bottom: 5px;" data-dark>',
		'after_title' => '</h5>'
    ) );
}
add_action( 'widgets_init', 'register_Footer2' );
/*
	底部欄 3
*/
function register_Footer3() {
    register_sidebar( array(
       	'name' => __( 'Footer 3', 'Carter' ),
		'id' => 'footer3',
		'description' => __( 'Displayed at the bottom of each page.', 'Carter' ),
		'before_widget' => '<div class="ts segment sidebarowo" data-dark>',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="ts header" style="margin-bottom: 5px;" data-dark>',
		'after_title' => '</h5>'
    ) );
}
add_action( 'widgets_init', 'register_Footer3' );

/*
	註冊選單
*/
register_nav_menus( 
	array('headernav' => __( 'Top menu', 'Carter' ),
		  'footernav' => __(  'Footer menu', 'Carter' )
         ) 
);

/*
	切頁連結加class
*/
function posts_link_attributes_next() {
    return 'class="ts primary right labeled icon button click load"';
}
function posts_link_attributes_previous() {
    return 'class="ts inverted labeled icon button click load"';
}
add_filter('next_posts_link_attributes', 'posts_link_attributes_next');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_previous');


/*
	登入介面美化
*/
function gnehs_login_css() { ?>
	<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/login-page.css" rel="stylesheet">
<?php }
add_action('login_head', 'gnehs_login_css');
/*
	餵給編輯器的 CSS
*/
function sig_add_editor_styles() {
    add_editor_style( '/tocas-ui/tocas.css' );
    add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'sig_add_editor_styles' );
?>