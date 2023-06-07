<div class="column-item post-style-1">
    <div class="post-inner">
        <?php if (has_post_thumbnail()): ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail('technocy-post-grid'); ?>
            </div>
        <?php endif; ?>
        <div class="entry-header header-style">
            <div class="entry-meta">
                <?php technocy_post_meta(); ?>
            </div>
            <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
        </div>
    </div>
</div>
