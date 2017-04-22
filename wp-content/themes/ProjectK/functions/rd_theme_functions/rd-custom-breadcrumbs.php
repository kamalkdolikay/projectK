<?php
//////////// Create the breadcrumbs ////////////

function dimox_breadcrumbs() {

		global $rd_data;


  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show

  $delimiter = '<i class="fa-angle-right crumbs_delimiter"></i>'; // delimiter between crumbs

  $home = __('Home', 'thefoxwp'); // text for the 'Home' link

  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show


  global $post;

  $homeLink = home_url();


  if (is_home() || is_front_page()) {

    if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';

  } else {

    echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

    if ( is_category() ) {

      global $wp_query;

      $cat_obj = $wp_query->get_queried_object();

      $thisCat = $cat_obj->term_id;

      $thisCat = get_category($thisCat);

      $parentCat = get_category($thisCat->parent);

      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));

      echo '<span>' . 'Archive by category "' . single_cat_title('', false) . '"' . '</span>';

    } elseif ( is_search() ) {

      echo '<span>Search results for "' . get_search_query() . '"' . '</span>';

    } elseif ( is_day() ) {

      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';

      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';

      echo '<span>' . get_the_time('d') . '</span>';

    } elseif ( is_month() ) {

      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';

      echo '<span>' . get_the_time('F') . '</span>';

    } elseif ( is_year() ) {

      echo '<span>' . get_the_time('Y') . '</span>';

    } elseif ( is_single() && !is_attachment() ) {

      if ( get_post_type() != 'post' ) {

        $post_type = get_post_type_object(get_post_type());

        $slug = $post_type->rewrite;

        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';

        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . '<span>' . get_the_title() . '</span>';

      } else {

        $cat = get_the_category(); $cat = $cat[0];

        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');

        if ($showCurrent == 0) $cats = preg_replace("/^(.+)\s$delimiter\s$/", "$1", $cats);

        echo !empty( $cats ) ? $cats : '';
		

        if ($showCurrent == 1) echo '<span>' . get_the_title() . '</span>';

      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {

      $post_type = get_post_type_object(get_post_type());

      echo '<span>' . $post_type->labels->singular_name . '</span>';

    } elseif ( is_attachment() ) {

      $parent = get_post($post->post_parent);

      $cat = get_the_category($parent->ID); $cat = $cat[0];

      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');

      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';

      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . '<span>' . get_the_title() . '</span>';

    } elseif ( is_page() && !$post->post_parent ) {

      if ($showCurrent == 1) echo '<span>' . get_the_title() . '</span>';

    } elseif ( is_page() && $post->post_parent ) {

      $parent_id  = $post->post_parent;

      $breadcrumbs = array();

      while ($parent_id) {

      $page = get_page($parent_id);

      $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';

      $parent_id  = $page->post_parent;

      }

      $breadcrumbs = array_reverse($breadcrumbs);

      foreach ($breadcrumbs as $crumb) echo !empty( $crumb ) ? $crumb : '';

      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . '<span>' . get_the_title() . '</span>';

    } elseif ( is_tag() ) {

      echo '<span>' . 'Posts tagged "' . single_tag_title('', false) . '"' . '</span>';

    } elseif ( is_author() ) {

      global $author;

      $userdata = get_userdata($author);

      echo '<span>' . 'Articles posted by ' . $userdata->display_name . '</span>';

    } elseif ( is_404() ) {

      echo '<span>' . 'Error 404' . '</span>';

    }

    if ( get_query_var('paged') ) {

      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';

      echo __('Page','thefoxwp') . ' ' . get_query_var('paged');

      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';

    }

    echo '</div>';

  }

} // end dimox_breadcrumbs()

?>