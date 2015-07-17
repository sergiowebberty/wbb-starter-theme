<?php if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}


/************************************************************************************************************************************************
 * Define Global constants here ...
 ***********************************************************************************************************************************************/
define ( 'WBB_THEME_SLUG' , 'webberty' );

/************************************************************************************************************************************************
 * A function to add the meta information in a single page.
 ***********************************************************************************************************************************************/
if ( ! function_exists ( 'wbb_entry_meta' ) )
{

	/************************************************************************************************************************************************
	 * Prints HTML with meta information for the current post-date/time and author.
	 ***********************************************************************************************************************************************/
	function wbb_entry_meta ()
	{

		$time_string = '<time class="entry-date published updated" itemprop="datePublished" datetime="%1$s">%2$s</time>';
		if ( get_the_time ( 'U' ) !== get_the_modified_time ( 'U' ) )
		{

			$time_string = '<time class="entry-date published" itemprop="datePublished" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';

		}

		$time_string = sprintf ( $time_string ,
			esc_attr ( get_the_date ( 'c' ) ) ,
			esc_html ( get_the_date () ) ,
			esc_attr ( get_the_modified_date ( 'c' ) ) ,
			esc_html ( get_the_modified_date () )
		);

		$posted_on = sprintf (
			esc_html_x ( 'Posted on %s' , 'post date' , '_s' ) ,
			'<a href="' . esc_url ( get_permalink () ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf (
			esc_html_x ( 'by %s' , 'post author' , '_s' ) ,
			'<span class="author vcard"><a class="url fn n" itemprop="url" href="' . esc_url ( get_author_posts_url ( get_the_author_meta ( 'ID' ) ) ) . '">' . esc_html ( get_the_author () ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}

}

/************************************************************************************************************************************************
 * Function to show categories, tags and comments in the footer of a single page
 ***********************************************************************************************************************************************/
if ( ! function_exists ( 'wbb_entry_footer' ) )
{

	/************************************************************************************************************************************************
	 * Prints HTML with meta information for the categories, tags and comments.
	 ***********************************************************************************************************************************************/
	function wbb_entry_footer ()
	{

		// Hide category and tag text for pages.
		if ( 'post' == get_post_type () )
		{

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list ( esc_html__ ( ', ' , WBB_THEME_SLUG ) );
			if ( $categories_list && wbb_categorized_blog () )
			{

				printf ( '<span class="cat-links">' . esc_html__ ( 'Posted in %1$s' , WBB_THEME_SLUG ) . '</span>' , $categories_list );

			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list ( '' , esc_html__ ( ', ' , WBB_THEME_SLUG ) );
			if ( $tags_list )
			{

				printf ( '<span class="tags-links">' . esc_html__ ( 'Tagged %1$s' , WBB_THEME_SLUG ) . '</span>' , $tags_list );

			}
		}

		if ( ! is_single () && ! post_password_required () && ( comments_open () || get_comments_number () ) )
		{

			echo '<span class="comments-link">';

			comments_popup_link ( esc_html__ ( 'Leave a comment' , WBB_THEME_SLUG ) , esc_html__ ( '1 Comment' , WBB_THEME_SLUG ) , esc_html__ ( '% Comments' , WBB_THEME_SLUG ) );

			echo '</span>';

		}

		edit_post_link ( esc_html__ ( 'Edit' , WBB_THEME_SLUG ) , '<span class="edit-link">' , '</span>' );

	}

}

/************************************************************************************************************************************************
 * Returns true if a blog has more than 1 category.
 ***********************************************************************************************************************************************/
if ( ! function_exists ( 'wbb_categorized_blog' ) )
{
	/************************************************************************************************************************************************
	 * @return bool
	 ***********************************************************************************************************************************************/
	function wbb_categorized_blog ()
	{

		if ( FALSE === ( $all_the_cool_cats = get_transient ( '_wbb_categories' ) ) )
		{

			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories ( array (
				'fields'     => 'ids' ,
				'hide_empty' => 1 ,

				// We only need to know if there is more than one category.
				'number'     => 2 ,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count ( $all_the_cool_cats );

			set_transient ( '_wbb_categories' , $all_the_cool_cats );

		}

		if ( $all_the_cool_cats > 1 )
		{

			// This blog has more than 1 category so wbb_categorized_blog should return true.
			return TRUE;

		}
		else
		{

			// This blog has only 1 category so wbb_categorized_blog should return false.
			return FALSE;

		}

	}

}

/************************************************************************************************************************************************
 *  Define which pages shouldn't have the sidebar
 ***********************************************************************************************************************************************/
if ( ! function_exists ( 'wbb_display_sidebar' ) )
{

	function wbb_display_sidebar ()
	{

		$result           = [ ];
		$conditionals     = [ ];
		$conditionalCheck = apply_filters ( 'WBB_display_sidebar' , $conditionals );

		if ( empty( $conditionalCheck ) )
		{
			$result = TRUE;
		}
		else
		{

			foreach ( $conditionalCheck as $conditional )
			{

				$tag  = $conditional;
				$args = FALSE;

				if ( is_array ( $conditional ) )
				{

					list( $tag , $args ) = $conditional;

				}

				if ( function_exists ( $tag ) )
				{

					$result[] = $args ? $tag( $args ) : $tag();

				}

			}

		}

		return in_array ( 1 , $result );

	}

}

/************************************************************************************************************************************************
 * show  breadcrumb
 ***********************************************************************************************************************************************/
if ( ! function_exists ( "wbb_breadcrumb" ) )
{

	function wbb_breadcrumb ()
	{
            
                // Settings Values
                $activate_breadcrumb = get_option ( 'wbb_theme_activate_breadcrumb' );
                
                $breadcrumb_separator = get_option ( 'wbb_theme_breadcrumb_separator' );
                
                
               
            
		// Settings
		$separator  = $breadcrumb_separator;
		$id         = 'breadcrumbs';
		$class      = 'breadcrumbs';
		$home_title = 'Homepage';
		$parents    = '';
		// Get the query & post information
		global $post , $wp_query;
		$category = get_the_category ();

		// Build the breadcrums

		$li = FALSE;

		// Do not display on the homepage
		if ( ! is_front_page () )
		{

			// Home page
			$li .= '<li class="item-home"><a class="bread-link bread-home"  itemprop="url" href="' . get_home_url () . '" title="' . $home_title . '">' . $home_title . '</a></li>';
			//echo '<li class="separator separator-home"> ' . $separator . ' </li>';

			if ( is_single () )
			{

				// Single post (Only display the first category)
				$li .= '<li class="item-cat item-cat-' . $category[ 0 ]->term_id . ' item-cat-' . $category[ 0 ]->category_nicename . '"><a  itemprop="url" class="bread-cat bread-cat-' . $category[ 0 ]->term_id . ' bread-cat-' . $category[ 0 ]->category_nicename . '" href="' . get_category_link ( $category[ 0 ]->term_id ) . '" title="' . $category[ 0 ]->cat_name . '">' . $category[ 0 ]->cat_name . '</a></li>';
				//echo '<li class="separator separator-' . $category[ 0 ]->term_id . '"> ' . $separator . ' </li>';
				$li .= '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title () . '">' . get_the_title () . '</strong></li>';

			}
			else if ( is_category () )
			{

				// Category page
				$li .= '<li class="item-current item-cat-' . $category[ 0 ]->term_id . ' item-cat-' . $category[ 0 ]->category_nicename . '"><strong class="bread-current bread-cat-' . $category[ 0 ]->term_id . ' bread-cat-' . $category[ 0 ]->category_nicename . '">' . $category[ 0 ]->cat_name . '</strong></li>';

			}
			else if ( is_page () )
			{

				// Standard page
				if ( $post->post_parent )
				{

					// If child page, get parents
					$anc = get_post_ancestors ( $post->ID );

					// Get parents in the right order
					$anc = array_reverse ( $anc );

					// Parent page loop
					foreach ( $anc as $ancestor )
					{
						$parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a  itemprop="url" class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink ( $ancestor ) . '" title="' . get_the_title ( $ancestor ) . '">' . get_the_title ( $ancestor ) . '</a></li>';
						//$parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
					}

					// Display parent pages
					$li .= $parents;

					// Current page
					$li .= '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title () . '"> ' . get_the_title () . '</strong></li>';

				}
				else
				{

					// Just display current page if not parents
					$li .= '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title () . '</strong></li>';

				}

			}
			else if ( is_tag () )
			{

				// Tag page

				// Get tag information
				$term_id  = get_query_var ( 'tag_id' );
				$taxonomy = 'post_tag';
				$args     = 'include=' . $term_id;
				$terms    = get_terms ( $taxonomy , $args );

				// Display the tag name
				$li .= '<li class="item-current item-tag-' . $terms[ 0 ]->term_id . ' item-tag-' . $terms[ 0 ]->slug . '"><strong class="bread-current bread-tag-' . $terms[ 0 ]->term_id . ' bread-tag-' . $terms[ 0 ]->slug . '">' . $terms[ 0 ]->name . '</strong></li>';

			}
			elseif ( is_day () )
			{

				// Day archive

				// Year link
				$li .= '<li class="item-year item-year-' . get_the_time ( 'Y' ) . '"><a  itemprop="url" class="bread-year bread-year-' . get_the_time ( 'Y' ) . '" href="' . get_year_link ( get_the_time ( 'Y' ) ) . '" title="' . get_the_time ( 'Y' ) . '">' . get_the_time ( 'Y' ) . __ ( ' Archives: ' , WBB_THEME_SLUG ) . ' </a></li>';
				//echo '<li class="separator separator-' . get_the_time ( 'Y' ) . '"> ' . $separator . ' </li>';

				// Month link
				$li .= '<li class="item-month item-month-' . get_the_time ( 'm' ) . '"><a  itemprop="url" class="bread-month bread-month-' . get_the_time ( 'm' ) . '" href="' . get_month_link ( get_the_time ( 'Y' ) , get_the_time ( 'm' ) ) . '" title="' . get_the_time ( 'M' ) . '">' . get_the_time ( 'M' ) . __ ( ' Archives: ' , WBB_THEME_SLUG ) . ' </a></li>';
				//echo '<li class="separator separator-' . get_the_time ( 'm' ) . '"> ' . $separator . ' </li>';

				// Day display
				$li .= '<li class="item-current item-' . get_the_time ( 'j' ) . '"><strong class="bread-current bread-' . get_the_time ( 'j' ) . '"> ' . get_the_time ( 'jS' ) . ' ' . get_the_time ( 'M' ) . __ ( ' Archives: ' , WBB_THEME_SLUG ) . ' </strong></li>';

			}
			else if ( is_month () )
			{

				// Month Archive

				// Year link
				$li .= '<li class="item-year item-year-' . get_the_time ( 'Y' ) . '"><a  itemprop="url" class="bread-year bread-year-' . get_the_time ( 'Y' ) . '" href="' . get_year_link ( get_the_time ( 'Y' ) ) . '" title="' . get_the_time ( 'Y' ) . '">' . get_the_time ( 'Y' ) . ' Archives</a></li>';
				//echo '<li class="separator separator-' . get_the_time ( 'Y' ) . '"> ' . $separator . ' </li>';

				// Month display
				$li .= '<li class="item-month item-month-' . get_the_time ( 'm' ) . '"><strong class="bread-month bread-month-' . get_the_time ( 'm' ) . '" title="' . get_the_time ( 'M' ) . '">' . get_the_time ( 'M' ) . __ ( ' Archives: ' , WBB_THEME_SLUG ) . '</strong></li>';

			}
			else if ( is_year () )
			{

				// Display year archive
				$li .= '<li class="item-current item-current-' . get_the_time ( 'Y' ) . '"><strong class="bread-current bread-current-' . get_the_time ( 'Y' ) . '" title="' . get_the_time ( 'Y' ) . '">' . get_the_time ( 'Y' ) . __ ( ' Archives: ' , WBB_THEME_SLUG ) . ' </strong></li>';

			}
			else if ( is_author () )
			{

				// Auhor archive

				// Get the author information
				global $author;
				$userdata = get_userdata ( $author );

				// Display author name
				$li .= '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . __ ( ' Author: ' , WBB_THEME_SLUG ) . $userdata->display_name . '</strong></li>';

			}
			else if ( get_query_var ( 'paged' ) )
			{

				// Paginated archives
				$li .= '<li class="item-current item-current-' . get_query_var ( 'paged' ) . '"><strong class="bread-current bread-current-' . get_query_var ( 'paged' ) . '" title="Page ' . get_query_var ( 'paged' ) . '">' . __ ( 'Page' , WBB_THEME_SLUG ) . ' ' . get_query_var ( 'paged' ) . '</strong></li>';

			}
			else if ( is_search () )
			{

				// Search results page
				$li .= '<li class="item-current item-current-' . get_search_query () . '"><strong class="bread-current bread-current-' . get_search_query () . '" title="Search results for: ' . get_search_query () . '"> ' . __ ( ' Search results for: ' , WBB_THEME_SLUG ) . get_search_query () . '</strong></li>';

			}
			elseif ( is_404 () )
			{

				// 404 page
				$li .= '<li>' . 'Error 404' . '</li>';
			}

		}

		if ( $li && $activate_breadcrumb == "yes" )
		{
			echo "<div id=\"" . $id . "\" class=\"" . $class . "\">$li</div>";
		}
	}
}

/************************************************************************************************************************************************
 * A WordPress theme doesn’t contain Schema Markup by default. In order to add it to your theme, you should read the
 * following steps and implement them.
 *
 * @documentation : http://www.blogohblog.com/add-schema-markup-wordpress-theme/
 *                **********************************************************************************************************************************************/
if ( ! function_exists ( 'html_schema' ) )
{

	function html_schema ()
	{
		$schema = 'http://schema.org/';

		// Is single post
		if ( is_single () )
		{
			$type = "Article";
		}
		// Is blog home, archive or category
		else if ( is_home () || is_archive () || is_category () )
		{
			$type = "Blog";
		}
		// Is static front page
		else if ( is_front_page () )
		{
			$type = "Website";
		}
		// Is a general page
		else
		{
			$type = 'WebPage';
		}

		echo 'itemscope="itemscope" itemtype="' . $schema . $type . '"';
	}
}

/************************************************************************************************************************************************
 * Adding pagination
 ***********************************************************************************************************************************************/
if ( ! function_exists ( 'wbb_custom_pagination' ) )
{

	function wbb_custom_pagination ()
	{


		// Flag to show it
		$activate_pagination = get_option ( 'wbb_theme_activate_pagination' );


		global $wp_query;

		$big = 999999999; // need an unlikely integer

		$paginate_links = paginate_links ( [
			'base'      => str_replace ( $big , '%#%' , esc_url ( get_pagenum_link ( $big ) ) ) ,
			'format'    => '?paged=%#%' ,
			'current'   => max ( 1 , get_query_var ( 'paged' ) ) ,
			'total'     => $wp_query->max_num_pages ,
			'prev_next' => TRUE ,
			'prev_text' => __ ( '«' , WBB_THEME_SLUG ) ,
			'next_text' => __ ( '»' , WBB_THEME_SLUG ) ,
		] );


		if ( $paginate_links && $activate_pagination == "yes" )
		{
			echo "<div class=\"pagination\">$paginate_links</div>";
		}

	}

}


/************************************************************************************************************************************************
 * Adding Trigger Menu
 ***********************************************************************************************************************************************/
if ( ! function_exists ( 'wbb_activate_offcanvas' ) )
{

	function wbb_activate_offcanvas ()
	{

		$activate_offcanvas = get_option ( 'wbb_theme_activate_offcanvas' );

		if ( $activate_offcanvas == "yes" )
		{

			echo '<div class="site-pushmenu"><a href="#" id="trigger" class="menu-trigger js-menu-trigger js-menu-opener" data-colapsed = 0>Push Menu</a> </div>';

		}

	}

}
