<?php
/**
 * Title: Producto — caja de compra
 * Slug: kinesilk/producto-compra
 * Categories: kinesilk
 * Inserter: false
 */
$checkout = function_exists( 'wc_get_checkout_url' ) ? wc_get_checkout_url() : '/finalizar-compra/';
$cart     = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : '/carrito/';
?>
<!-- wp:group {"className":"ks-buybox","layout":{"type":"default"}} -->
<div class="wp-block-group ks-buybox"><!-- wp:woocommerce/add-to-cart-form {"className":"ks-buybox__form"} /-->
<!-- wp:buttons {"className":"ks-buybox__checkout"} -->
<div class="wp-block-buttons ks-buybox__checkout"><!-- wp:button {"className":"is-style-ks-primary"} -->
<div class="wp-block-button is-style-ks-primary"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $checkout ); ?>">Finalizar compra</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"is-style-ks-ghost"} -->
<div class="wp-block-button is-style-ks-ghost"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $cart ); ?>">Ver carrito</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- wp:paragraph {"className":"ks-buybox__help"} -->
<p class="ks-buybox__help">¿Dudas sobre este tratamiento? <a href="<?php echo esc_url( kinesilk_wa( 'evaluacion' ) ); ?>" target="_blank" rel="noreferrer noopener">Escríbenos por WhatsApp</a> · Evaluación gratuita</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
