<?php
/**
 * Archive Template: Projects
 *
 * Displays a grid of all projects.
 * Note: This template requires the 'project' CPT to have 'has_archive' => true.
 */

get_header();
?>

<div class="archive-projects">
    <header class="archive-projects__header">
        <h1>Projects</h1>
        <p>A selection of our recent work.</p>
    </header>

    <?php if ( have_posts() ) : ?>
        <div class="projects-grid">
            <?php while ( have_posts() ) : the_post(); ?>
                <article class="project-card">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="project-card__image">
                            <?php the_post_thumbnail( 'medium_large' ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="project-card__content">
                        <h2 class="project-card__title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <p class="project-card__client">
                            <?php $client = get_field( 'client' ); ?>
                            <?php if ( $client ) : ?>
                                <strong>Client:</strong> <?php echo esc_html( $client ); ?>
                            <?php endif; ?>
                        </p>
                        <a href="<?php the_permalink(); ?>" class="project-card__link">View Project &rarr;</a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <div class="pagination">
            <?php the_posts_pagination(); ?>
        </div>

    <?php else : ?>
        <p class="no-results">No projects found.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
