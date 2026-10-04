<?php
/**
 * Title: Servicios — categorías navegables y catálogo
 * Slug: kinesilk/servicios-catalogo
 * Categories: kinesilk
 */
?>
<!-- wp:group {"tagName":"section","align":"wide","className":"ks-section ks-services-page","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignwide ks-section ks-services-page"><!-- wp:group {"className":"ks-section__head","layout":{"type":"default"}} -->
<div class="wp-block-group ks-section__head"><!-- wp:paragraph {"className":"ks-eyebrow"} -->
<p class="ks-eyebrow">Servicios Kinesilk · Punta Arenas</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":1,"className":"ks-title"} -->
<h1 class="wp-block-heading ks-title">Depilación láser, despigmentación y eliminación de tatuajes</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"ks-lead"} -->
<p class="ks-lead">Filtra por precio o elige una categoría para encontrar tu tratamiento. ¿No sabes cuál es para ti? Agenda tu evaluación gratuita.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"className":"ks-head__cta"} -->
<div class="wp-block-buttons ks-head__cta"><!-- wp:button {"className":"is-style-ks-whatsapp","linkTarget":"_blank","rel":"noreferrer noopener"} -->
<div class="wp-block-button is-style-ks-whatsapp"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( kinesilk_wa( 'evaluacion' ) ); ?>" target="_blank" rel="noreferrer noopener">Escríbenos por WhatsApp</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","className":"ks-shop-layout"} -->
<div class="wp-block-columns alignwide ks-shop-layout"><!-- wp:column {"width":"26%","className":"ks-shop-sidebar"} -->
<div class="wp-block-column ks-shop-sidebar" style="flex-basis:26%"><!-- wp:group {"className":"ks-filter-card","layout":{"type":"default"}} -->
<div class="wp-block-group ks-filter-card"><!-- wp:heading {"level":3,"className":"ks-filter__title"} -->
<h3 class="wp-block-heading ks-filter__title">Filtrar por precio</h3>
<!-- /wp:heading -->
<!-- wp:woocommerce/price-filter {"showInputFields":true,"showFilterButton":true} -->
<div class="wp-block-woocommerce-price-filter is-loading" data-show-input-fields="true" data-show-filter-button="true"><span aria-hidden="true" class="wc-block-product-categories__placeholder"></span></div>
<!-- /wp:woocommerce/price-filter --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"ks-filter-card","layout":{"type":"default"}} -->
<div class="wp-block-group ks-filter-card"><!-- wp:heading {"level":3,"className":"ks-filter__title"} -->
<h3 class="wp-block-heading ks-filter__title">Filtros activos</h3>
<!-- /wp:heading -->
<!-- wp:woocommerce/active-filters {"displayStyle":"chips"} -->
<div class="wp-block-woocommerce-active-filters is-loading" data-display-style="chips"><span aria-hidden="true" class="wc-block-active-filters__placeholder"></span></div>
<!-- /wp:woocommerce/active-filters --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"ks-filter-card","layout":{"type":"default"}} -->
<div class="wp-block-group ks-filter-card"><!-- wp:heading {"level":3,"className":"ks-filter__title"} -->
<h3 class="wp-block-heading ks-filter__title">Categorías</h3>
<!-- /wp:heading -->
<!-- wp:woocommerce/product-categories {"hasCount":true,"hasEmpty":false,"isHierarchical":false,"showChildrenOnly":false} /--></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"74%","className":"ks-shop-main"} -->
<div class="wp-block-column ks-shop-main" style="flex-basis:74%"><!-- wp:group {"className":"ks-shop-toolbar","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group ks-shop-toolbar"><!-- wp:woocommerce/product-results-count /-->
<!-- wp:woocommerce/catalog-sorting /--></div>
<!-- /wp:group -->

<!-- wp:woocommerce/product-collection {"queryId":21,"query":{"perPage":48,"pages":0,"offset":0,"postType":"product","order":"asc","orderBy":"menu_order","search":"","exclude":[],"inherit":true,"taxQuery":[],"isProductCollectionBlock":true,"woocommerceStockStatus":["instock","outofstock","onbackorder"],"woocommerceAttributes":[],"woocommerceHandPickedProducts":[]},"tagName":"div","displayLayout":{"type":"flex","columns":3,"shrinkColumns":true},"className":"ks-products ks-products--catalog"} -->
<div class="wp-block-woocommerce-product-collection ks-products ks-products--catalog"><!-- wp:woocommerce/product-template -->
<!-- wp:woocommerce/product-image {"showProductLink":true,"showSaleBadge":true,"saleBadgeAlign":"left","isDescendentOfQueryLoop":true} /-->
<!-- wp:post-title {"isLink":true,"level":3,"__woocommerceNamespace":"woocommerce/product-collection/product-title"} /-->
<!-- wp:woocommerce/product-rating {"isDescendentOfQueryLoop":true} /-->
<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true} /-->
<!-- wp:woocommerce/product-button {"isDescendentOfQueryLoop":true} /-->
<!-- /wp:woocommerce/product-template -->
<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous /-->
<!-- wp:query-pagination-numbers /-->
<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:woocommerce/product-collection --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:buttons {"className":"ks-packs__more","layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons ks-packs__more"><!-- wp:button {"className":"is-style-ks-whatsapp","linkTarget":"_blank","rel":"noreferrer noopener"} -->
<div class="wp-block-button is-style-ks-whatsapp"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( kinesilk_wa( 'evaluacion' ) ); ?>" target="_blank" rel="noreferrer noopener">Agenda tu evaluación gratuita</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></section>
<!-- /wp:group -->
