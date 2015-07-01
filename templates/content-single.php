<?php
/**
 * The template used for displaying page content in single.php
 *
 * @package wbb-starter-theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemType="http://schema.org/BlogPosting">

    <header>

        <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

        <?php if (get_post_type() === 'post') { wbb_entry_meta(); } ?>

    </header>

    <div class="entry-summary">

        <?php the_excerpt(); ?>

    </div>

</article>
