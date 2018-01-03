<?php
/*  Ninzio title
/*-------------------*/

    add_filter( 'wp_title', 'focuson_ninzio_filter_wp_title' );
    function focuson_ninzio_filter_wp_title( $title ) {
        global $page, $paged;

        if ( is_feed() ){
            return $title;
        }
            
        $site_description = get_bloginfo( 'description' );

        $filtered_title = $title . get_bloginfo( 'name' );
        $filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
        $filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( esc_html__( 'Page %s', 'focuson'), max( $paged, $page ) ) : '';

        return $filtered_title;
    }

/*  Post format chat
/*-------------------*/

    function focuson_ninzio_post_chat_format($content) {
        global $post;
        if (has_post_format('chat')) {
            $chatoutput = "<ul class=\"chat\">\n";
            $split = preg_split("/(\r?\n)+|(<br\s*\/?>\s*)+/", $content);

            foreach($split as $haystack) {
                if (strpos($haystack, ":")) {
                    $string = explode(":", trim($haystack), 2);
                    $who = strip_tags(trim($string[0]));
                    $what = strip_tags(trim($string[1]));
                    $row_class = empty($row_class)? " class=\"chat-highlight\"" : "";
                    $chatoutput = $chatoutput . "<li><span class='name'>$who</span><p>$what</p></li>\n";
                } else {
                    $chatoutput = $chatoutput . $haystack . "\n";
                }
            }

            $content = $chatoutput . "</ul>\n";
            return $content;
        } else { 
            return $content;
        }
    }
    add_filter( "the_content", "focuson_ninzio_post_chat_format", 9);

/*  Column converter
/*-------------------*/

    function focuson_ninzio_column_convert( $width, $front = true ) {
        if ( preg_match( '/^(\d{1,2})\/12$/', $width, $match ) ) {
            $w = 'col'.$match[1];
        } else {
            $w = 'col';
            switch ( $width ) {
                case "1/6" :
                    $w .= '2';
                    break;
                case "1/4" :
                    $w .= '3';
                    break;
                case "1/3" :
                    $w .= '4';
                    break;
                case "1/2" :
                    $w .= '6';
                    break;
                case "2/3" :
                    $w .= '8';
                    break;
                case "3/4" :
                    $w .= '9';
                    break;
                case "5/6" :
                    $w .= '10';
                    break;
                case "1/1" :
                    $w .= '12';
                    break;
                default :
                    $w = $width;
            }
        }
        return $w;
    }

/*  Get the widget
/*-------------------*/

    if( !function_exists('focuson_ninzio_get_the_widget') ){
  
        function focuson_ninzio_get_the_widget( $widget, $instance = '', $args = '' ){
            ob_start();
            the_widget($widget, $instance, $args);
            return ob_get_clean();
        }
        
    }

/*  Attach a class to linked images' parent anchors
/*-------------------*/

    function focuson_ninzio_give_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){

        $classes = 'nz-single-image nz-clearfix';
        // check if there are already classes assigned to the anchor
        if ( preg_match('/<a.*? class=".*?">/', $html) ) {
        $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
        } else {
        $html = preg_replace('/(<a.*?)>/', '$1 class="'.$classes.'" >', $html);
        }
        return $html;
    }
    add_filter('image_send_to_editor','focuson_ninzio_give_linked_images_class',10,8);

/*  Pagination
/*-------------------*/

    function focuson_ninzio_post_nav_num(){
        if( is_singular() ){
            return;
        }

        global $wp_query;
        $big = 99999999;

        echo "<nav class=ninzio-navigation>";
            echo paginate_links(array(
                'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
                'format'    => '?paged=%#%',
                'total'     => $wp_query->max_num_pages,
                'current'   => max(1, get_query_var('paged')),
                'show_all'  => false,
                'end_size'  => 2,
                'mid_size'  => 3,
                'prev_next' => true,
                'prev_text' => '<span class="icon icon-arrow-left8"></span>',
                'next_text' => '<span class="icon icon-arrow-right8"></span>',
                'type'      => 'list'
            ));
        echo "</nav>";
    }

/*  Simple pagination
/*-------------------*/
    
    function focuson_ninzio_post_nav($post_id){

            $prev_post = get_adjacent_post(false, '', true);
            $next_post = get_adjacent_post(false, '', false);
        ?>
        <nav class="ninzio-nav-single nz-clearfix">  
          <?php if(!empty($prev_post)) {echo '<a rel="prev" href="' . get_permalink($prev_post->ID) . '" title="' . $prev_post->post_title . '">' . esc_html__("Prev article", "focuson") . '</a>'; } ?>
          <?php if(!empty($next_post)) {echo '<a rel="next" href="' . get_permalink($next_post->ID) . '" title="' . $next_post->post_title . '">' . esc_html__("Next article", "focuson") . '</a>'; } ?>
        </nav>
        <?php 
    }

/*  Excerpt
/*-------------------*/

    function focuson_ninzio_excerpt($limit) {
        
        $excerpt = get_the_excerpt();
        $limit++;

        $output = "";

        if ( mb_strlen( $excerpt ) > $limit ) {
            $subex = mb_substr( $excerpt, 0, $limit - 5 );
            $exwords = explode( ' ', $subex );
            $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );

            if ( $excut < 0 ) {
                $output .= mb_substr( $subex, 0, $excut );
            } else {
                $output .= $subex;
            }

            $output .= '[...]';

        } else {
            $output .= $excerpt;
        }

        return $output;
    }

/*  Not found
/*-------------------*/

    function focuson_ninzio_not_found($post_type){

        $output = '';

        $output .= '<p class="ninzio-not-found">';

        switch ($post_type) {

            case 'recipes':
                $output .= esc_html__('No recipes found.', 'focuson');
                break;

            case 'products':
                $output .= esc_html__('No products found.', 'focuson');
                break;

            case 'events':
                $output .= esc_html__('No events found.', 'focuson');
                break;

            case 'general':
                $output .= esc_html__('No search results found. Try a different search', 'focuson');
                break;
            
            default:
                $output .= esc_html__('No posts found.', 'focuson');
                break;
        }

        $output .= '</p>';

        return $output;
    }

/*  Breadcrumbs
/*-------------------*/

    function focuson_ninzio_breadcrumbs() {

        global $post, $focuson_ninzio;

        $text_before = '<span>';
        $text_after  = '</span>';

        $home_text     = esc_html__('Home','focuson');
        $category_text = esc_html__('Archive by Category "%s"','focuson');
        $tax_text      = esc_html__('Archive by "%s"','focuson');
        $tag_text      = esc_html__('Posts Tagged "%s"','focuson');
        $author_text   = esc_html__('Articles Posted by %s','focuson');
        $error_text    = esc_html__('Error 404','focuson');
        $search_text   = esc_html__('Search Results for "%s" Query','focuson');

        $blog_text     = (isset($GLOBALS['focuson_ninzio']['blog-title']) && !empty($GLOBALS['focuson_ninzio']['blog-title'])) ? $GLOBALS['focuson_ninzio']['blog-title'] : esc_html__("Blog", "focuson");
        $project_text  = (isset($GLOBALS['focuson_ninzio']['projects-title']) && !empty($GLOBALS['focuson_ninzio']['projects-title'])) ? $GLOBALS['focuson_ninzio']['projects-title'] : esc_html__("Projects", "focuson");
        $product_text  = (isset($GLOBALS['focuson_ninzio']['shop-title']) && !empty($GLOBALS['focuson_ninzio']['shop-title'])) ? $GLOBALS['focuson_ninzio']['shop-title'] : esc_html__("Product", "focuson");
        
        $page_title_text_align    = (isset($GLOBALS['focuson_ninzio']['page-title-text-align']) && !empty($GLOBALS['focuson_ninzio']['page-title-text-align']) ) ? $GLOBALS['focuson_ninzio']['page-title-text-align'] : 'left';

        $home_link = esc_url(home_url('/'));
        $blog_link = get_post_type_archive_link( 'post' );

        if (is_home() && is_front_page()) {
            // Post is frontpage
            echo $text_before . $blog_text . $text_after;
        } elseif (is_home() && !is_front_page()) {
            // Post is separate page
            echo '<a href="' . $home_link . '">' . $home_text . '</a>';
            echo $text_before . $blog_text . $text_after;
        } elseif (is_front_page() && !is_home()) {
            // Front page and not post page
            echo $text_before . $home_text . $text_after;
        } else {

            /*  Page
            -------------------*/

                if (is_page()) {

                    echo '<a href="' . $home_link . '">' . $home_text . '</a>';

                    if ($post->post_parent) {

                        $this_parents = get_post_ancestors($post->ID);

                        foreach (array_reverse($this_parents) as $parent_ID) {
                            echo '<a href="'.get_page_link($parent_ID, false, false).'">'.get_the_title($parent_ID).'</a>';
                        }

                        echo $text_before.get_the_title().$text_after;

                    } else {
                        echo $text_before.get_the_title().$text_after;
                    }

                }

            /*  Single post
            -------------------*/

                if (is_singular( 'post' )) {

                    $this_cats         = get_the_category();
                    $first_cat         = $this_cats[0];
                    $first_cat_link    = get_category_link($first_cat->cat_ID);
                
                    echo '<a href="' . $home_link . '">' . $home_text . '</a>';
                    echo '<a href="' . $blog_link . '">' . $blog_text . '</a>';

                    if ($first_cat->parent) {
                        $first_cat_parents = get_category_parents($first_cat->parent, true, '');
                        echo $first_cat_parents;
                    }

                    echo '<a href="'.$first_cat_link.'">'. $first_cat->name .'</a>';
                    echo $text_before.get_the_title().$text_after;
                    
                }

            /*  Category / Tag / Taxonomy
            -------------------*/

                if ( is_category() ) {

                    $this_cat = get_category(get_query_var('cat'), false);

                    echo '<a href="' . $home_link . '">' . $home_text . '</a>';
                    echo '<a href="' . $blog_link . '">' . $blog_text . '</a>';

                    if ($this_cat->parent != 0) {
                        $this_parents = get_category_parents($this_cat->parent, true, '');
                        echo $this_parents;
                        echo $text_before . sprintf($category_text, single_cat_title('', false)) . $text_after;
                    } else {
                        echo $text_before . sprintf($category_text, single_cat_title('', false)) . $text_after;
                    }
                    
                }

                if (is_tag()) {
                    echo '<a href="' . $home_link . '">' . $home_text . '</a>';
                    echo '<a href="' . $blog_link . '">' . $blog_text . '</a>';
                    echo $text_before . sprintf($tag_text, single_tag_title('', false)) . $text_after;
                }

            /*  Date
            -------------------*/

                if ( is_day() ) {
                    echo '<a href="' . $home_link . '">' . $home_text . '</a>';
                    echo '<a href="'.get_year_link(get_the_time('Y'),get_the_time('Y')).'">'. get_the_time('Y') .'</a>';
                    echo '<a href="'.get_month_link(get_the_time('Y'),get_the_time('m')).'">'. get_the_time('F') .'</a>';
                    echo $text_before . get_the_time('d') . $text_after;
                }

                if ( is_month() ) {
                    echo '<a href="' . $home_link . '">' . $home_text . '</a>';
                    echo '<a href="'.get_year_link(get_the_time('Y'),get_the_time('Y')).'">'. get_the_time('Y') .'</a>';
                    echo $text_before . get_the_time('F') . $text_after;
                }

                if ( is_year() ) {
                    echo '<a href="' . $home_link . '">' . $home_text . '</a>';
                    echo $text_before . get_the_time('Y') . $text_after;
                }

            /*  Misc
            -------------------*/

                if ( is_search() ) {
                    echo '<a href="' . $home_link . '">' . $home_text . '</a>';
                    echo $text_before . sprintf($search_text, get_search_query()) . $text_after;
                }

                if ( is_author() ) {
                    global $author;
                    $userdata = get_userdata($author);
                    echo '<a href="' . $home_link . '">' . $home_text . '</a>';
                    echo $text_before . sprintf($author_text, $userdata->display_name) . $text_after;
                }

                if ( is_404() ) {
                    echo '<a href="' . $home_link . '">' . $home_text . '</a>';
                    echo $text_before . $error_text . $text_after;
                }

            /*  CPT
            -------------------*/

                $cpt_list = get_post_types( array(
                    'public' => true,
                    'publicly_queryable' => true,
                    '_builtin' => false,
                ), 'objects', 'and' );

                if (is_array($cpt_list)) {
                    foreach ($cpt_list as $cpt) {

                        $cpt_title = $cpt->labels->name;

                        switch ($cpt->name) {
                            case 'projects':
                                $cpt_title = $project_text;
                                break;
                            case 'product':
                                $cpt_title = $product_text;
                                break;
                        }

                        /*  Archive
                        -------------------*/

                            if (is_post_type_archive($cpt->name)) {

                                echo '<a href="' . $home_link . '">' . $home_text . '</a>';
                                echo $text_before . $cpt_title . $text_after;

                            }

                        /*  Taxonomy
                        -------------------*/

                            $cpt_taxonomies = get_object_taxonomies($cpt->name);
                            if (is_array($cpt_taxonomies)) {
                                foreach ($cpt_taxonomies as $cpt_tax) {
                                    if (is_tax($cpt_tax)) {


                                        $this_tax    = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                                        $this_parents = get_ancestors( $this_tax->term_id, get_query_var('taxonomy') );

                                        echo '<a href="' . $home_link . '">' . $home_text . '</a>';
                                        echo '<a href="'.get_post_type_archive_link($cpt->name).'">'. $cpt_title .'</a>';

                                        if (is_array($this_parents)) {
                                            foreach (array_reverse($this_parents) as $this_parent_ID) {
                                                $this_parent = get_term($this_parent_ID, get_query_var('taxonomy'));
                                                echo '<a href="'.get_term_link( $this_parent->slug, get_query_var('taxonomy')).'">'. $this_parent->name .'</a>';
                                            }
                                            echo $text_before . sprintf($tax_text, single_cat_title('', false)) . $text_after;
                                        } else {
                                            echo $text_before . sprintf($tax_text, single_cat_title('', false)) . $text_after;
                                        }
                                        
                                    }
                                }
                            } else {
                                if (is_tax()) {

                                    echo '<a href="' . $home_link . '">' . $home_text . '</a>';
                                    echo $text_before . sprintf($tax_text, single_cat_title('', false)) . $text_after;

                                }
                            }

                        /*  Single post
                        -------------------*/

                            if ($cpt->name == 'projects') {
                                if (is_singular( 'projects' )) {

                                    $this_terms = get_the_terms( $post->ID, 'projects-category');

                                    $first_term         = $this_terms[0];
                                    $first_term_link    = get_term_link($first_term->term_id,'projects-category');
                                    $first_term_parents = get_ancestors($first_term->term_id,'projects-category');

                                    echo '<a href="' . $home_link . '">' . $home_text . '</a>';
                                    echo '<a href="'.get_post_type_archive_link($cpt->name).'">'. $cpt_title .'</a>';

                                    if (is_array($first_term_parents)) {
                                        foreach (array_reverse($first_term_parents) as $this_parent_ID) {
                                            $this_parent = get_term($this_parent_ID, 'project-category');
                                            echo '<a href="'.get_term_link( $this_parent->slug, 'projects-category').'">'. $this_parent->name .'</a>';
                                        }
                                    }

                                    echo '<a href="'.$first_term_link.'">'. $first_term->name .'</a>';
                                    echo $text_before.get_the_title().$text_after;

                                }
                            } elseif ($cpt->name == 'product') {

                                if (is_singular( 'product' )) {

                                    $shop_page_url = get_permalink( get_option( 'woocommerce_shop_page_id' ) );
                                    $this_terms    = get_the_terms( $post->ID, 'product_cat');

                                    $first_term         = $this_terms[0];
                                    $first_term_link    = get_term_link($first_term->term_id,'product_cat');
                                    $first_term_parents = get_ancestors($first_term->term_id,'product_cat');

                                    echo '<a href="' . $home_link . '">' . $home_text . '</a>';
                                    echo '<a href="' . $shop_page_url . '">' . $product_text . '</a>';

                                    if (is_array($first_term_parents)) {
                                        foreach (array_reverse($first_term_parents) as $this_parent_ID) {
                                            $this_parent = get_term($this_parent_ID, 'product_cat');
                                            echo '<a href="'.get_term_link( $this_parent->slug, 'product_cat').'">'. $this_parent->name .'</a>';
                                        }
                                    }

                                    echo '<a href="'.$first_term_link.'">'. $first_term->name .'</a>';
                                    echo $text_before.get_the_title().$text_after;

                                }
                            } elseif(is_singular() && $cpt->name != 'projects' && $cpt->name != 'product' && $cpt->name != 'gallery') {
                                echo '<a href="' . $home_link . '">' . $home_text . '</a>';
                                echo $text_before.get_the_title().$text_after;
                            }

                    }
                } else {
                    if (is_tax()) {
                        echo '<a href="' . $home_link . '">' . $home_text . '</a>';
                        echo $text_before . sprintf($tax_text, single_cat_title('', false)) . $text_after;
                    }
                }
            
        }

        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) { echo ' ('; }

            echo $text_before.esc_html__('Page','focuson') . ' ' . get_query_var('paged').$text_after;

            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) { echo ')'; }
        }
    }

/*  Hex to rgba
/*-------------------*/

    function focuson_ninzio_hex_to_rgba($hex, $o) {
        $hex = (string) $hex;
        $hex = str_replace("#", "", $hex);
        $hex = array_map('hexdec', str_split($hex, 2));
        return 'rgba('.implode(",", $hex).','.$o.')';
    }

/*  Hex to rgb shade
/*-------------------*/

    function focuson_ninzio_hex_to_rgb_shade($hex, $o) {
        $hex = (string) $hex;
        $hex = str_replace("#", "", $hex);
        $hex = array_map('hexdec', str_split($hex, 2));
        $hex[0] -= $o;
        $hex[1] -= $o;
        $hex[2] -= $o;
        return 'rgb('.implode(",", $hex).')';
    }

/*  Post thumbnail
/*-------------------*/

    function focuson_ninzio_thumbnail ($layout, $post_id){

        $thumb_size = 'Focuson-Ninzio-Half';

        if (is_single()) {
                $thumb_size = 'full';
        } else {
            switch ($layout) {
                case 'large' :
                case 'medium':
                case 'small' :
                case 'list' :
                    $thumb_size = 'Focuson-Ninzio-Half';
                    break;
                    break;
                case 'standard':
                    $thumb_size = 'Focuson-Ninzio-Whole';
                    break;
            }
        }

        $output = '';

        if (has_post_thumbnail()){

            $values = get_post_custom( $post_id );
            $post_format       = get_post_format($post_id);
            $nz_link_url       = isset($values["link_url"][0]) ? $values["link_url"][0] : "";

            $link = ($post_format == "link") ? $nz_link_url : get_permalink();

            $output .= '<div class="nz-thumbnail">';

                if ($layout == "list") {
                    $output .='<div class="post-date-custom"><span>'.get_the_date("d").'</span><span>'.get_the_date("M").'</span></div>';
                }

                $output .= get_the_post_thumbnail( $post_id, $thumb_size );
                if (!is_single()) {
                    $output .= '<div class="ninzio-overlay">';
                        $output .= '<a class="nz-overlay-before" title="View details" href="'. $link.'"></a>';
                    $output .= '</div>';
                }
            $output .= '</div>';

            return $output;
        }

        ?>

    <?php }

/*  Post gallery
/*-------------------*/

    function focuson_ninzio_post_gallery ($layout, $post_id){

        global $focuson_ninzio;
        $post_gallery_array = array();
        $thumb_size = 'Focuson-Ninzio-Half';

        if (!is_single()) {
            switch ($layout) {
                case 'large':
                case 'medium':
                case 'small' :
                case 'list' :
                $thumb_size = 'Focuson-Ninzio-Half';
                break;
                case 'standard':
                $thumb_size = 'Focuson-Ninzio-Whole';
                break;
            }
        } elseif (is_single()) {
            $thumb_size = 'Focuson-Ninzio-Whole';
        }

        if (class_exists('MultiPostThumbnails')) {

            if (MultiPostThumbnails::has_post_thumbnail('post', 'feature-image-2')) {
                $thumb_2 = array(
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-2', $post_id, $size = $thumb_size),
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-2', $post_id, $size = 'full')
                );
                array_push($post_gallery_array, $thumb_2);
            }

            if (MultiPostThumbnails::has_post_thumbnail('post', 'feature-image-3')) {
                $thumb_3 = array(
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-3', $post_id, $size = $thumb_size),
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-3', $post_id, $size = 'full')
                );
                array_push($post_gallery_array, $thumb_3);
            }

            if (MultiPostThumbnails::has_post_thumbnail('post', 'feature-image-4')) {
                $thumb_4 = array(
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-4', $post_id, $size = $thumb_size),
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-4', $post_id, $size = 'full')
                );
                array_push($post_gallery_array, $thumb_4);
            }

            if (MultiPostThumbnails::has_post_thumbnail('post', 'feature-image-5')) {
                $thumb_5 = array(
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-5', $post_id, $size = $thumb_size),
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-5', $post_id, $size = 'full')
                );
                array_push($post_gallery_array, $thumb_5);
            }

        }

        $output = "";

        if (has_post_thumbnail()){
            $output .= '<div class="post-gallery media">';

                if ($layout == "list") {
                    $output .='<div class="post-date-custom"><span>'.date_i18n("d").'</span><span>'.date_i18n("M").'</span></div>';
                }

                $post_format       = get_post_format($post_id);

                $output .= '<ul class="slides">';

                    $output .= '<li>';
                        
                        $output .= '<div class="nz-thumbnail">';
                            $output .= get_the_post_thumbnail( $post_id, $thumb_size );
                            if (!is_single()) {
                                $output .= '<div class="ninzio-overlay">';
                                    $output .= '<a class="nz-overlay-before portfolio-link" title="View details" href="'.get_permalink().'"></a>';
                                $output .= '</div>';
                            }
                        $output .= '</div>';

                    $output .= '</li>';
                    foreach ($post_gallery_array as $thumb) {
                        $output .='<li>';
                            $output .= '<div class="nz-thumbnail">';
                            $output .='<img src="'.$thumb[0].'" alt="'.get_the_title().'">';
                                if (!is_single()) {
                                    $output .= '<div class="ninzio-overlay">';
                                        $output .= '<a class="nz-overlay-before portfolio-link" title="View details" href="'.get_permalink().'"></a>';
                                    $output .= '</div>';
                                }
                            $output .= '</div>';
                        $output .='</li>';
                    }
                        
                $output .= '</ul>';
            $output .= '</div>';

            return $output;
        }

        ?>
    <?php }

    function focuson_ninzio_port_gallery ($layout, $post_id){

        global $focuson_ninzio;
        $post_gallery_array = array();
        $thumb_size = 'Focuson-Ninzio-Three-Quarters';

        if (class_exists('MultiPostThumbnails')) {

            if (MultiPostThumbnails::has_post_thumbnail('portfolio', 'feature-image-2')) {
                $thumb_2 = array(
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-2', $post_id, $size = $thumb_size),
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-2', $post_id, $size = 'full')
                );
                array_push($post_gallery_array, $thumb_2);
            }

            if (MultiPostThumbnails::has_post_thumbnail('portfolio', 'feature-image-3')) {
                $thumb_3 = array(
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-3', $post_id, $size = $thumb_size),
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-3', $post_id, $size = 'full')
                );
                array_push($post_gallery_array, $thumb_3);
            }

            if (MultiPostThumbnails::has_post_thumbnail('portfolio', 'feature-image-4')) {
                $thumb_4 = array(
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-4', $post_id, $size = $thumb_size),
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-4', $post_id, $size = 'full')
                );
                array_push($post_gallery_array, $thumb_4);
            }

            if (MultiPostThumbnails::has_post_thumbnail('portfolio', 'feature-image-5')) {
                $thumb_5 = array(
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-5', $post_id, $size = $thumb_size),
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-5', $post_id, $size = 'full')
                );
                array_push($post_gallery_array, $thumb_5);
            }

        }

        ?>
        <?php if (has_post_thumbnail()): ?>
            <div class="post-gallery media">
                <ul class="slides">
                    <li>
                        <?php
                            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                            $href            = (is_single()) ? $large_image_url[0] : get_permalink();
                        ?>
                        <a class="nz-more" data-lightbox-gallery="gallery4" href="<?php echo $href; ?>">
                            <div class="nz-thumbnail">
                                <?php echo get_the_post_thumbnail( $post_id, $thumb_size );?>
                                <div class="ninzio-overlay"><div class="overlay-content"><span class="nz-overlay-before icon-plus4"></span></div></div>
                            </div>
                        </a>
                    </li>
                    <?php foreach ($post_gallery_array as $thumb): ?>
                        <li>
                            <?php $href2 = (is_single()) ? $thumb[1] : get_permalink(); ?>
                            <a class="nz-more" data-lightbox-gallery="gallery4" href="<?php echo $href2; ?>">
                                <div class="nz-thumbnail">
                                    <img src="<?php echo $thumb[0]; ?>" alt="<?php echo get_the_title(); ?>">
                                    <div class="ninzio-overlay"><div class="overlay-content"><span class="nz-overlay-before icon-plus4"></span></div></div>
                                </div>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>
    <?php }

/*  Post views
/*-------------------*/

    function focuson_ninzio_get_post_views($postID){
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return "0";
        }
        return $count;
    }

    function focuson_ninzio_set_post_views($postID) {
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
?>