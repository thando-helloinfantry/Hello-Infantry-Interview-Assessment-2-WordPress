<?php
/**
 * Template Name: Contact Page
 *
 * Displays company contact information using ACF fields.
 */

get_header();
?>

<div class="page-contact">
    <h1><?php the_title(); ?></h1>

    <div class="contact-details">
        <?php
        // BUG #6: Using 'option' as the second parameter assumes these fields
        // are on an ACF Options Page. But they're actually assigned to this
        // specific page — should use get_the_ID() (or omit the second param
        // since we're in the loop). 'option' requires ACF Pro and an Options
        // Page, neither of which are set up.
        $email   = get_field( 'company_email', 'option' );
        $phone   = get_field( 'company_phone', 'option' );
        $address = get_field( 'company_address', 'option' );
        $map     = get_field( 'map_embed', 'option' );
        ?>

        <?php if ( $email ) : ?>
            <div class="contact-item">
                <h3>Email</h3>
                <p><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
            </div>
        <?php endif; ?>

        <?php if ( $phone ) : ?>
            <div class="contact-item">
                <h3>Phone</h3>
                <p><a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></p>
            </div>
        <?php endif; ?>

        <?php if ( $address ) : ?>
            <div class="contact-item">
                <h3>Address</h3>
                <p><?php echo nl2br( esc_html( $address ) ); ?></p>
            </div>
        <?php endif; ?>

        <?php if ( $map ) : ?>
            <div class="contact-map">
                <h3>Find Us</h3>
                <?php echo $map; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
