<?php
/**
 * Single Project Template
 *
 * Displays the full details of an individual project.
 */

get_header();
?>

<article class="single-project">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <header class="single-project__header">
            <h1 class="single-project__title"><?php the_title(); ?></h1>

            <?php
            // BUG #5: the_field('client') is called inside the main loop, which
            // is fine here. But below, when we use get_posts() to show related
            // projects, the global $post changes and the_field() pulls from the
            // wrong post context. See the "Related Projects" section below.
            ?>
            <div class="single-project__meta">
                <p><strong>Client:</strong> <?php the_field( 'client' ); ?></p>
                <?php $project_url = get_field( 'project_url' ); ?>
                <?php if ( $project_url ) : ?>
                    <p><strong>URL:</strong> <a href="<?php echo esc_url( $project_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $project_url ); ?></a></p>
                <?php endif; ?>
            </div>
        </header>

        <div class="single-project__content">
            <?php the_field( 'project_description' ); ?>
        </div>

        <?php
        // ─── Project Gallery ────────────────────────────────────────
        $gallery = get_field( 'gallery' );
        if ( $gallery ) :
        ?>
            <section class="single-project__gallery">
                <h2>Gallery</h2>
                <div class="gallery-grid">
                    <?php foreach ( $gallery as $image ) : ?>
                        <figure class="gallery-item">
                            <?php
                            // BUG #4: $image is an Array (ACF Gallery returns arrays),
                            // but this echoes the array directly instead of $image['url']
                            ?>
                            <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy" />
                        </figure>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // ─── Related Projects ───────────────────────────────────────
        $related = get_posts( array(
            'post_type'      => 'project',
            'posts_per_page' => 3,
            'post__not_in'   => array( get_the_ID() ),
            'orderby'        => 'rand',
        ) );

        if ( $related ) :
        ?>
            <section class="single-project__related">
                <h2>Other Projects</h2>
                <div class="related-grid">
                    <?php foreach ( $related as $post ) : ?>
                        <div class="related-card">
                            <h3><a href="<?php the_permalink( $post ); ?>"><?php echo get_the_title( $post ); ?></a></h3>
                            <?php
                            // BUG #5: the_field('client') without a post ID argument
                            // will use the global $post — which was overwritten by the
                            // foreach loop above. Need to pass $post->ID as second arg.
                            ?>
                            <p class="related-card__client"><?php the_field( 'client' ); ?></p>
                        </div>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </section>
        <?php endif; ?>

    <?php endwhile; endif; ?>
</article>

<?php get_footer(); ?>
