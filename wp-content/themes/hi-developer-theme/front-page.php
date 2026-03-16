<?php
/**
 * Template Name: Front Page
 *
 * The homepage template — displays hero, services, and team sections.
 * All content is driven by ACF fields.
 */

get_header();
?>

<div class="front-page">

    <!-- ─── Hero Section ─────────────────────────────────────────────── -->
    <section class="hero">
        <?php
        // BUG #1: get_field('hero_image') returns an Array (ACF Image field
        // with return format "Array"), but this code uses it as if it's a URL string.
        // The image will not display because an array is being echoed as the src.
        $hero_image = get_field( 'hero_image' );
        ?>
        <div class="hero__background" style="background-image: url('<?php echo esc_url( $hero_image ); ?>');">
            <div class="hero__content">
                <h1 class="hero__title"><?php the_field( 'hero_title' ); ?></h1>
                <p class="hero__subtitle"><?php the_field( 'hero_subtitle' ); ?></p>
            </div>
        </div>
    </section>

    <!-- ─── Services Section ─────────────────────────────────────────── -->
    <section class="services">
        <h2 class="section-title">Our Services</h2>
        <div class="services__grid">
            <?php
            // BUG #2: The field name here is 'services' but the actual ACF field
            // name (as defined in the JSON export) is 'service_items'.
            // This will always return null/false, so no services will render.
            if ( have_rows( 'services' ) ) :
                while ( have_rows( 'services' ) ) : the_row();
                    ?>
                    <div class="service-card">
                        <div class="service-card__icon"><?php the_sub_field( 'icon' ); ?></div>
                        <h3 class="service-card__title"><?php the_sub_field( 'title' ); ?></h3>
                        <p class="service-card__description"><?php the_sub_field( 'description' ); ?></p>
                    </div>
                    <?php
                endwhile;
            else :
                ?>
                <p>No services to display.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- ─── Team Section ─────────────────────────────────────────────── -->
    <section class="team">
        <h2 class="section-title">Meet the Team</h2>
        <div class="team__grid">
            <?php
            // BUG #3: Missing have_rows() check before while loop.
            // If the repeater has no rows (or the field doesn't exist),
            // this causes a fatal error / white screen.
            while ( have_rows( 'team_members' ) ) : the_row();
                $photo = get_sub_field( 'photo' );
                ?>
                <div class="team-card">
                    <img
                        class="team-card__photo"
                        src="<?php echo esc_url( $photo['url'] ); ?>"
                        alt="<?php echo esc_attr( $photo['alt'] ); ?>"
                    />
                    <h3 class="team-card__name"><?php the_sub_field( 'name' ); ?></h3>
                    <p class="team-card__role"><?php the_sub_field( 'role' ); ?></p>
                </div>
                <?php
            endwhile;
            ?>
        </div>
    </section>

</div>

<?php get_footer(); ?>
