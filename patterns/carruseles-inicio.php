<?php
/**
 * Title: Carruseles de categorías y productos
 * Slug: kinesilk/carruseles-inicio
 * Categories: kinesilk
 * Description: Usa el plugin Custom Woo Pro Carousel ([cwc_carousel]). El tema le aplica sus colores, tipografía y bordes.
 */
?>
<!-- wp:group {"tagName":"section","className":"ks-section ks-carousel ks-carousel--cats","layout":{"type":"constrained"}} -->
<section class="wp-block-group ks-section ks-carousel ks-carousel--cats"><!-- wp:group {"className":"ks-section__head","layout":{"type":"default"}} -->
<div class="wp-block-group ks-section__head"><!-- wp:paragraph {"className":"ks-eyebrow"} -->
<p class="ks-eyebrow">Categorías</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"ks-title"} -->
<h2 class="wp-block-heading ks-title">Encuentra tu tratamiento</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->
<!-- wp:shortcode -->
[cwc_carousel name="categorias"]
<!-- /wp:shortcode --></section>
<!-- /wp:group -->
<!-- wp:group {"tagName":"section","className":"ks-section ks-carousel ks-carousel--products","layout":{"type":"constrained"}} -->
<section class="wp-block-group ks-section ks-carousel ks-carousel--products"><!-- wp:group {"className":"ks-section__head","layout":{"type":"default"}} -->
<div class="wp-block-group ks-section__head"><!-- wp:paragraph {"className":"ks-eyebrow"} -->
<p class="ks-eyebrow">Promociones</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"ks-title"} -->
<h2 class="wp-block-heading ks-title">Sesiones y packs destacados</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->
<!-- wp:shortcode -->
[cwc_carousel name="productos"]
<!-- /wp:shortcode --></section>
<!-- /wp:group -->
