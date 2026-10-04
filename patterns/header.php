<?php
/**
 * Title: Cabecera
 * Slug: kinesilk/header
 * Categories: kinesilk
 * Inserter: false
 */
$ks_checkout = function_exists( 'wc_get_checkout_url' ) ? wc_get_checkout_url() : '/finalizar-compra/';
?>
<!-- wp:group {"className":"ks-header__inner","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group ks-header__inner"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"ks-logo is-style-ks-logo-ink"} -->
<figure class="wp-block-image size-full ks-logo is-style-ks-logo-ink"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/logo-kinesilk-white.png' ) ); ?>" alt="Kinesilk, inicio"/></a></figure>
<!-- /wp:image -->
<!-- wp:navigation {"overlayMenu":"always","icon":"menu","hasIcon":true,"className":"ks-nav","layout":{"type":"flex","justifyContent":"right"}} -->
<!-- wp:navigation-link {"label":"Inicio","url":"<?php echo esc_url( home_url( '/' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->
<!-- wp:navigation-link {"label":"Servicios","url":"<?php echo esc_url( home_url( '/servicios/' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->
<!-- wp:navigation-link {"label":"Tecnología","url":"<?php echo esc_url( home_url( '/tecnologia/' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->
<!-- wp:navigation-link {"label":"Contacto","url":"<?php echo esc_url( home_url( '/contacto/' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->
<!-- wp:navigation-link {"label":"Carrito","url":"<?php echo esc_url( function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/carrito/' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->
<!-- wp:navigation-link {"label":"Agenda tu cita","url":"<?php echo esc_url( kinesilk_wa( 'general' ) ); ?>","kind":"custom","className":"ks-nav-whatsapp","opensInNewTab":true} /-->
<!-- /wp:navigation -->
<!-- wp:html -->
<?php echo kinesilk_minicart_shortcode(); // Carrito dinámico del tema (el bloque Shortcode no se procesa dentro de un template part). ?>
<!-- /wp:html -->
<!-- wp:buttons {"className":"ks-header__cta"} -->
<div class="wp-block-buttons ks-header__cta"><!-- wp:button {"className":"is-style-ks-ghost ks-header__checkout"} -->
<div class="wp-block-button is-style-ks-ghost ks-header__checkout"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $ks_checkout ); ?>">Finalizar compra</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"is-style-ks-whatsapp","linkTarget":"_blank","rel":"noreferrer noopener"} -->
<div class="wp-block-button is-style-ks-whatsapp"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( kinesilk_wa( 'general' ) ); ?>" target="_blank" rel="noreferrer noopener">Agenda tu cita</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
