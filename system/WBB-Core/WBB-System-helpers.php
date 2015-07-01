<?php if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}

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
			$categories_list = get_the_category_list ( esc_html__ ( ', ' , 'webberty' ) );
			if ( $categories_list && wbb_categorized_blog () )
			{

				printf ( '<span class="cat-links">' . esc_html__ ( 'Posted in %1$s' , 'webberty' ) . '</span>' , $categories_list );

			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list ( '' , esc_html__ ( ', ' , 'webberty' ) );
			if ( $tags_list )
			{

				printf ( '<span class="tags-links">' . esc_html__ ( 'Tagged %1$s' , 'webberty' ) . '</span>' , $tags_list );

			}
		}

		if ( ! is_single () && ! post_password_required () && ( comments_open () || get_comments_number () ) )
		{

			echo '<span class="comments-link">';

			comments_popup_link ( esc_html__ ( 'Leave a comment' , 'webberty' ) , esc_html__ ( '1 Comment' , 'webberty' ) , esc_html__ ( '% Comments' , 'webberty' ) );

			echo '</span>';

		}

		edit_post_link ( esc_html__ ( 'Edit' , 'webberty' ) , '<span class="edit-link">' , '</span>' );

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

	/************************************************************************************************************************************************
	 * Any of these conditional tags that return true won't show the sidebar.
	 * You can also specify your own custom function as long as it returns a boolean.
	 *
	 * To use a function that accepts arguments, use an array instead of just the function name as a string.
	 *
	 * Examples:
	 *
	 * 'is_single'
	 * 'is_archive'
	 * ['is_page', 'about-me']
	 * ['is_tax', ['flavor', 'mild']]
	 * ['is_page_template', 'about.php']
	 * ['is_post_type_archive', ['foo', 'bar', 'baz']]
	 *
	 */
	function wbb_display_sidebar ()
	{

		$result       = FALSE;
		$conditionals = [
			'is_404' ,
			'is_front_page' ,
			[
				'is_page_template' ,
				'template-custom.php'
			]
		];

		$conditionalCheck = apply_filters ( 'WBB_display_sidebar' , $conditionals );

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

				$result = $args ? $tag( $args ) : $tag();

			}

		}

		return $result;

	}
}