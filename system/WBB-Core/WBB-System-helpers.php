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

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time ( 'U' ) !== get_the_modified_time ( 'U' ) )
		{

			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';

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
			'<span class="author vcard"><a class="url fn n" href="' . esc_url ( get_author_posts_url ( get_the_author_meta ( 'ID' ) ) ) . '">' . esc_html ( get_the_author () ) . '</a></span>'
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

					$result[ ] = $args ? $tag( $args ) : $tag();

				}

			}

		}

		return in_array ( 1 , $result );

	}

}

/************************************************************************************************************************************************
 * show  breadcrumb
 ***********************************************************************************************************************************************/
if ( ! function_exists ( "wbb_weman_breadcrumb" ) )
{

	function wbb_weman_breadcrumb ()
	{
		// Settings
		$separator  = ' > ';
		$id         = 'breadcrumbs';
		$class      = 'list-inline breadcrumbs';
		$home_title = 'Home';
		$parents    = "";

		global $post , $wp_query;

		$queried_object = $wp_query->queried_object;

		echo '<ul id="' . $id . '" class="' . $class . '">';

		if ( ! is_front_page () )
		{

			// Home page
			echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url () . '" title="' . $home_title . '">' . $home_title . '</a></li>';
			echo '<li class="separator separator-home"> ' . $separator . ' </li>';

			if ( is_page () )
			{

				if ( $post->post_parent )
				{

					$anc = get_post_ancestors ( $post->ID );

					$anc = array_reverse ( $anc );

					foreach ( $anc as $ancestor )
					{

						$parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink ( $ancestor ) . '" title="' . get_the_title ( $ancestor ) . '">' . get_the_title ( $ancestor ) . '</a></li>';
						$parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
					}

					echo $parents;

					echo '<li class="item-current item-' . $post->ID . '"> ' . get_the_title () . '</li>';
				}
				else
				{

					echo '<li class="item-current item-' . $post->ID . '"> ' . get_the_title () . '</li>';
				}
			}
			elseif ( is_category () )
			{

				$category = $queried_object->name;
				echo '<li class="item-current item-cat-' . $category . ' item-cat-' . $category . '"><strong class="bread-current bread-cat-' . $category . ' bread-cat-' . $category . '">' . $category . '</strong></li>';
			}
			elseif ( is_tax () )
			{
				// The parent
				$post_type = get_post_type ();

				$post_type_object = get_post_type_object ( $post_type );

				$post_type_labels = $post_type_object->labels;

				$post_type_name = $post_type_labels->name;

				$post_type_rewrite = $post_type_object->rewrite;

				$post_type_slug = $post_type_rewrite[ 'slug' ];

				$taxonomy = $queried_object->name;

				echo '<li class="item-cat item-cat-' . $post_type_slug . ' item-cat-' . $post_type_slug . '"><a class="bread-cat bread-cat-' . $post_type_slug . ' bread-cat-' . $post_type_slug . '" href="/' . $post_type_slug . '" title="' . $post_type_slug . '">' . $post_type_name . '</a></li>';

				echo '<li class="separator separator-' . $post_type_slug . '"> ' . $separator . ' </li>';

				echo '<li class="item-current item-cat-' . $taxonomy . ' item-cat-' . $taxonomy . '"><strong class="bread-current bread-cat-' . $taxonomy . ' bread-cat-' . $taxonomy . '">' . $taxonomy . '</strong></li>';
			}
			elseif ( is_archive () )
			{

				$labels         = $queried_object->labels;
				$post_type_name = $labels->name;
				$post_type_slug = $queried_object->query_var;

				echo '<li class="item-current item-cat-' . $post_type_slug . ' item-cat-' . $post_type_slug . '">' . $post_type_name . '</li>';
			}
			elseif ( is_single () )
			{

				$query     = $wp_query->query;
				$post_type = isset ( $query[ 'post_type' ] ) ? $query[ 'post_type' ] : "";

				if ( $post_type == "" )
				{

					// Usual post type
					$category      = get_the_category ( get_the_ID () );
					$the_category  = $category[ 0 ];
					$category_name = $the_category->name;
					$category_slug = $the_category->slug;
					$category_id   = $the_category->cat_ID;

					echo '<li class="item-cat item-cat-' . $category_slug . ' item-cat-' . $category_slug . '"><a class="bread-cat bread-cat-' . $category_slug . ' bread-cat-' . $category_slug . '" href="' . get_category_link ( $category_id ) . '" title="' . $category_slug . '">' . $category_name . '</a></li>';
					echo '<li class="separator separator-' . $category_slug . '"> ' . $separator . ' </li>';
					echo '<li class="item-current item-' . get_the_ID () . '"><strong class="bread-current bread-' . get_the_ID () . '" title="' . get_the_title () . '">' . get_the_title () . '</strong></li>';
				}
				else
				{

					// Its a custom post type
					$post_type         = get_post_type ( get_the_ID () );
					$post_type_object  = get_post_type_object ( $post_type );
					$post_type_labels  = $post_type_object->labels;
					$post_type_name    = $post_type_labels->name;
					$post_type_rewrite = $post_type_object->rewrite;
					$post_type_slug    = $post_type_rewrite[ 'slug' ];
					echo '<li class="item-cat item-cat-' . $post_type_slug . ' item-cat-' . $post_type_slug . '"><a class="bread-cat bread-cat-' . $post_type_slug . ' bread-cat-' . $post_type_slug . '" href="/' . $post_type_slug . '" title="' . $post_type_slug . '">' . $post_type_name . '</a></li>';
					echo '<li class="separator separator-' . $post_type_slug . '"> ' . $separator . ' </li>';
					echo '<li class="item-current item-' . $post->ID . '">' . get_the_title () . '</li>';
				}
			}
			elseif ( is_404 () )
			{

				// 404 page
				echo '<li>' . 'Error 404' . '</li>';
			}
			elseif ( is_search () )
			{

				// 404 page
				echo '<li>' . 'Search results' . '</li>';
			}
		}
		else
		{

			//echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url () . '" title="' . $home_title . '">' . $home_title . '</a></li>' ;
		}

		echo '</ul>';
	}
}