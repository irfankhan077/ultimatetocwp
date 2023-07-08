<?php
/**
 * This is the post helper class and not the Post class object
 * It's treated differently from other custom post types.
 * 
 * @since 1.0.0
 */
final class NSM_Post_Helper{

    /**
     * Get the post thumbnail.
     *
     * @since 1.0.0
     */
    public static function the_thumbnail( $thumb_size = 'nsm-blog-md', $id = '', $classes = '' ){

        $id = $id == '' ? get_the_ID() : $id;

        if (has_post_thumbnail($id)) : ?>
			<a href="<?php the_permalink($id) ?>" title="<?php echo get_the_title($id); ?>">
                <?php echo get_the_post_thumbnail( $id, $thumb_size, ['class' => $classes] ); ?>
            </a>
		<?php else: ?>
			<a href="<?php the_permalink($id) ?>" title="<?php echo get_the_title($id); ?>">
                <img class="<?php echo $classes ?>" src="<?php echo esc_url( self::thumbnail_placeholder() ); ?>">
            </a>
		<?php endif;
    }

    /**
     * Get the title of the current post.
     *
     * @since 1.0.0
     */
    public static function the_title( $heading_class = 'h2' ){
        ?>
        <a class="<?php echo esc_attr($heading_class) ?> entry-title d-block" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
        <?php
    }

    /**
     * Get the date that the post was posted on.
     *
     * @since 1.0.0
     */
    public static function posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }
    
        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'j M' ) ),
            esc_html( get_the_date('j M') ),
            esc_attr( get_the_modified_date( 'j M' ) ),
            esc_html( get_the_modified_date('j M') )
        );
        
        $posted_on = sprintf( '%s', '<a class="td-u" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );
        echo __('Posted on: ','nsm') . '<span class="posted-on">' . $posted_on . '</span>';
    
    }

    /**
     * The placeholder thumbnail if no post was found.
     *
     * @since 1.0.0
     */
    private static function thumbnail_placeholder(){
        return apply_filters( 'nsm/filters/thumbnail_placeholder', NSM_URI."/assets/img/placeholder.png" );
    }

    /**
     * Return the number of columns for a post.
     * 
     * @param string $override - The override option per page
     * 
     * @since 1.0.0
     */
    public static function get_columns( $override = null ){
        return $override != null ? $override : get_field('post_columns', 'option');
    }

    /**
     * Returns the layout of the posts for a given page, or from global settings.
     * 
     * @param string $override - The override option per page
     * 
     * @since 1.0.0
     */
    public static function get_layout( $override = null ){
        return $override != null ? $override : get_field('post_layout', 'option');
    }

    /**
     * Get the related posts for a post.
     *
     * @since 1.0.0
     */
    public static function get_related_post(){

        $id                = get_the_ID();
        $related_cat_ids   = wp_get_post_categories($id);
        if ( empty($related_cat_ids) || get_field('hide_related_posts', 'option') ) 
        return false;

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 2,
            'post__not_in' => array($id),
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => $related_cat_ids,
                ),  
            ),
        );

        $q = new WP_Query($args);
        if( $q->have_posts() ){

            ?>
            <div class="pt-30 pb-0 pt-sm-40 pb-sm-10 related-post">
                <p class="h2"><?php esc_html_e('Related Posts', 'nsm') ?></p>
                <div class="row">
                <?php
                while( $q->have_posts() ){
                    $q->the_post();
                    ?>
                    <div class="<?php echo self::get_columns(); ?> sm-6">
                        <?php get_template_part( 'template-parts/post/layouts/'. self::get_layout() ) ?>
                    </div>
                <?php } ?>
                </div>
            </div>
            <?php
            wp_reset_postdata();
        }

    }

    /**
     * Returns the post query
     *
     * @since 1.0.0
     */
    public static function get_query($options){

        if(!$options)
        return false;

        $query = [
            'post_type'         => 'post',
            'posts_per_page'    => $options['posts_per_page'],
            'orderby'           => $options['order_by'],
        ];
        if($options['list_type'] == 3 && $options['categories']){
            $query['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => $options['categories'],
                ),  
            );
        }elseif( $options['list_type'] == 2 && $options['selected_posts'] ){
            $query['post__in'] = $options['selected_posts'];
        }

        return $query;
    }
    
    /**
     * Displays the post authorbox.
     *
     * @since 1.0.0
     */
    public static function get_post_authorbox(){
        if (!get_the_author_meta('description') || get_field('hide_author_box', 'option') )
        return false;

        ?>
        <div class="section pb-0 author-box-wrapper">
            <div class="author-about px-20 py-20 d-flex ai-s border br-4">
                <?php echo get_avatar( get_the_author_meta('ID'), 75 ); ?>
                <div class="ml-15 author-about-content">
                    <span class="d-block tt-u tc-p"> <?php echo esc_html__('Written By ', 'nsm') ?></span>
                    <p class="h4 mb-10 author-title"><?php echo get_the_author(); ?></p>
                    <p class="mb-0 fs-14"><?php the_author_meta('description'); ?></p>
                </div>
            </div>
        </div>
        <?php
    }

}