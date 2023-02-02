<?php get_header(); ?>

<div class="row">
    <div class="col-md-6">                 
        <h2><?php echo get_bloginfo("description"); ?></h2>
      <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>" class="btn btn-info">Let's Talk</a>    
    </div>

    <div class="col-md-6">
        <?php    
        /************* Custom Logo **********************/
        if ( function_exists( 'the_custom_logo' ) ) {        
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $image = wp_get_attachment_image_src( $custom_logo_id , 'large' );
            $logo = $image[0];

            echo '<img src="'.$logo.'" class="img-fluid rounded-circle">';
        }
        ?>
    </div>
</div>

<?php
/*************** Get the categories ********************/
$categories = get_categories(array(
    'orderby' => 'name',
    'order'   => 'ASC'));

foreach($categories as $category) {
    $category_link = get_category_link($category);
    $category_name = $category->name;
    
    echo '<h3><a href="'.$category_link.'">'.$category_name.'</a></h3>';

    /*********** Get the posts for this category *************/
    $posts = get_posts(array(
        "numberposts" => 1,
        "orderby"     => 'date',
        "order"       => 'desc',
        "category"    => $category->term_id));

    foreach($posts as $fp) {
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        
        // full, large, medium, thumbnail
        $url_thumbnail = get_the_post_thumbnail_url($fp->ID, "medium"); // The featured image
        $excerpt = get_the_excerpt($fp->ID);
        $url_post = get_permalink($fp->ID);
        $title = $fp->post_title;
        $date = get_the_date('F j, Y', $fp->ID);
        echo '<img src="'.$url_thumbnail.'" class="img-fluid"><br>';

        echo '</div><div class="col-md-6">';

        echo '<a href="'.$url_post.'">'.$title .'</a><br>';
        echo $date . "<br>";
        echo $excerpt . "<br>";
        echo '</div></div>';
    }

}
?>

<?php get_footer(); ?>