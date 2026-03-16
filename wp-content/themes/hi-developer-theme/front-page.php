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
            // BUG #2: The field name prefix here is 'services_' (plural) but
            // the actual ACF field names use 'service_' (singular).
            // All get_field() calls will return null, so no services render.
            $services = array(
                array(
                    'icon'  => get_field( 'services_1_icon' ),
                    'title' => get_field( 'services_1_title' ),
                    'desc'  => get_field( 'services_1_description' ),
                ),
                array(
                    'icon'  => get_field( 'services_2_icon' ),
                    'title' => get_field( 'services_2_title' ),
                    'desc'  => get_field( 'services_2_description' ),
                ),
                array(
                    'icon'  => get_field( 'services_3_icon' ),
                    'title' => get_field( 'services_3_title' ),
                    'desc'  => get_field( 'services_3_description' ),
                ),
            );

            $has_services = false;
            foreach ( $services as $service ) :
                if ( $service['title'] ) :
                    $has_services = true;
                    ?>
                    <div class="service-card">
                        <div class="service-card__icon"><?php echo esc_html( $service['icon'] ); ?></div>
                        <h3 class="service-card__title"><?php echo esc_html( $service['title'] ); ?></h3>
                        <p class="service-card__description"><?php echo esc_html( $service['desc'] ); ?></p>
                    </div>
                    <?php
                endif;
            endforeach;

            if ( ! $has_services ) :
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
            // BUG #3: get_field() for image fields returns an array or false.
            // This code accesses $photo['url'] without checking if $photo
            // is valid first. When no photo is set, $photo is false and
            // $photo['url'] causes a fatal error / white screen.
            $team = array(
                array(
                    'photo' => get_field( 'team_1_photo' ),
                    'name'  => get_field( 'team_1_name' ),
                    'role'  => get_field( 'team_1_role' ),
                ),
                array(
                    'photo' => get_field( 'team_2_photo' ),
                    'name'  => get_field( 'team_2_name' ),
                    'role'  => get_field( 'team_2_role' ),
                ),
                array(
                    'photo' => get_field( 'team_3_photo' ),
                    'name'  => get_field( 'team_3_name' ),
                    'role'  => get_field( 'team_3_role' ),
                ),
            );

            foreach ( $team as $member ) :
                if ( $member['name'] ) :
                    ?>
                    <div class="team-card">
                        <img
                            class="team-card__photo"
                            src="<?php echo esc_url( $member['photo']['url'] ); ?>"
                            alt="<?php echo esc_attr( $member['photo']['alt'] ); ?>"
                        />
                        <h3 class="team-card__name"><?php echo esc_html( $member['name'] ); ?></h3>
                        <p class="team-card__role"><?php echo esc_html( $member['role'] ); ?></p>
                    </div>
                    <?php
                endif;
            endforeach;
            ?>
        </div>
    </section>

</div>

<?php get_footer(); ?>
