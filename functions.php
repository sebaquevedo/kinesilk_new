<?php
/**
 * Kinesilk New — funciones del tema.
 *
 * @package kinesilk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Soportes del tema y estilos del editor.
 */
function kinesilk_setup() {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'styles.css' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'woocommerce' );
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'kinesilk_setup' );

/**
 * Hoja de estilos principal (todo el CSS del tema).
 */
function kinesilk_enqueue() {
	$ver     = wp_get_theme()->get( 'Version' );
	$css     = get_theme_file_path( 'styles.css' );
	$css_ver = file_exists( $css ) ? filemtime( $css ) : $ver;
	wp_enqueue_style( 'kinesilk', get_theme_file_uri( 'styles.css' ), array(), $css_ver );
	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_script( 'wc-add-to-cart' );
		wp_enqueue_script( 'kinesilk-minicart', get_theme_file_uri( 'assets/js/minicart.js' ), array( 'jquery', 'wc-cart-fragments' ), $ver, true );
		wp_enqueue_script( 'kinesilk-packs', get_theme_file_uri( 'assets/js/packs.js' ), array(), $ver, true );
		wp_localize_script( 'kinesilk-packs', 'ksPacks', array( 'endpoint' => esc_url_raw( rest_url( 'kinesilk/v1/productos' ) ) ) );
		wp_enqueue_script( 'kinesilk-quantity', get_theme_file_uri( 'assets/js/quantity.js' ), array(), $ver, true );
		wp_enqueue_script( 'kinesilk-shop-filters', get_theme_file_uri( 'assets/js/shop-filters.js' ), array(), $ver, true );
		wp_enqueue_script( 'kinesilk-cart-fx', get_theme_file_uri( 'assets/js/cart-fx.js' ), array( 'jquery' ), $ver, true );
		wp_enqueue_script( 'kinesilk-card-qty', get_theme_file_uri( 'assets/js/card-qty.js' ), array( 'jquery' ), $ver, true );
	}
}
add_action( 'wp_enqueue_scripts', 'kinesilk_enqueue' );

/**
 * Enlace de WhatsApp con mensaje prellenado.
 * Cambia aquí el número o los mensajes y se actualizan en todo el tema
 * (en patrones nuevos; los ya insertados en una página se editan en el editor).
 *
 * @param string $key Clave del mensaje.
 * @return string
 */
function kinesilk_wa( $key = 'general' ) {
	$number   = apply_filters( 'kinesilk_whatsapp_number', '56987524346' );
	$messages = apply_filters(
		'kinesilk_whatsapp_messages',
		array(
			'general'          => 'Hola Kinesilk, quiero agendar una cita. ¿Me pueden indicar los horarios disponibles?',
			'evaluacion'       => 'Hola Kinesilk, me gustaría agendar mi evaluación gratuita. Quiero saber qué tratamiento es el más adecuado para mi piel y conocer los horarios disponibles. ¡Gracias!',
			'depilacion'       => 'Hola Kinesilk, quiero agendar mi sesión de Depilación Láser. ¿Qué zonas tratan y qué horarios tienen disponibles?',
			'despigmentacion'  => 'Hola Kinesilk, quiero consultar por el Aclarado y Despigmentación Láser para disminuir manchas. ¿Cómo es el tratamiento y cuántas sesiones necesitaría?',
			'tatuajes'         => 'Hola Kinesilk, quiero cotizar la Eliminación de un Tatuaje. Puedo enviarles una foto con el tamaño y colores del diseño.',
			'rejuvenecimiento' => 'Hola Kinesilk, quiero consultar por el Rejuvenecimiento Facial Láser / Hollywood Peel. ¿Me pueden contar cómo funciona y sus valores?',
			'multilaser'       => 'Hola Kinesilk, quiero reservar una hora de depilación con el Multiláser de 4 longitudes de onda. ¿Qué horarios tienen disponibles?',
			'ndyag'            => 'Hola Kinesilk, quiero reservar una hora con el láser ND:YAG (Hollywood Peel, manchas o tatuajes). ¿Me pueden orientar sobre el tratamiento adecuado?',
			'pago'             => 'Hola Kinesilk, quiero información sobre medios de pago y cuotas.',
		)
	);
	$url = 'https://wa.me/' . $number;
	if ( isset( $messages[ $key ] ) ) {
		$url .= '?text=' . rawurlencode( $messages[ $key ] );
	}
	return $url;
}

/**
 * Categoría de patrones y estilos de bloque (el CSS está en styles.css).
 */
function kinesilk_register_blocks() {
	register_block_pattern_category( 'kinesilk', array( 'label' => __( 'Kinesilk', 'kinesilk' ) ) );

	$styles = array(
		'core/button'    => array(
			'ks-primary'      => __( 'Principal (coral)', 'kinesilk' ),
			'ks-whatsapp'     => __( 'WhatsApp (menta)', 'kinesilk' ),
			'ks-whatsapp-xl'  => __( 'WhatsApp grande', 'kinesilk' ),
			'ks-ghost'        => __( 'Contorno', 'kinesilk' ),
		),
		'core/paragraph' => array(
			'ks-cyber-pink'   => __( 'Promo rosa', 'kinesilk' ),
			'ks-cyber-yellow' => __( 'Promo amarillo', 'kinesilk' ),
			'ks-ribbon'       => __( 'Cinta promo', 'kinesilk' ),
		),
		'core/image'     => array(
			'ks-logo-ink'     => __( 'Logo oscuro (tiñe un logo blanco)', 'kinesilk' ),
			'ks-logo-pink'    => __( 'Logo rosa (tiñe un logo blanco)', 'kinesilk' ),
		),
		'core/heading'   => array(
			'ks-cyber-pink'   => __( 'Promo rosa', 'kinesilk' ),
			'ks-cyber-yellow' => __( 'Promo amarillo', 'kinesilk' ),
		),
	);
	foreach ( array( 'core/paragraph', 'core/heading', 'core/group', 'core/buttons', 'core/columns' ) as $block ) {
		$styles[ $block ]['ks-hidden'] = __( 'Oculto en el sitio', 'kinesilk' );
	}
	foreach ( $styles as $block => $list ) {
		foreach ( $list as $name => $label ) {
			register_block_style( $block, array( 'name' => $name, 'label' => $label ) );
		}
	}
}
add_action( 'init', 'kinesilk_register_blocks' );

/**
 * Al activar el tema: crea solo las páginas que NO existan (nunca toca las actuales).
 * Inicio Kinesilk queda en borrador para revisarla antes de usarla como portada.
 */
function kinesilk_create_pages() {
	$pages = array(
		'inicio-kinesilk' => array( 'Inicio Kinesilk', '<!-- wp:pattern {"slug":"kinesilk/landing"} /-->', 'page-landing', 'draft' ),
		'servicios'       => array( 'Servicios', '', '', 'publish' ),
		'tecnologia'      => array( 'Tecnología', '', '', 'publish' ),
		'contacto'        => array( 'Contacto', '', '', 'publish' ),
	);
	foreach ( $pages as $slug => $data ) {
		if ( get_page_by_path( $slug ) ) {
			continue;
		}
		wp_insert_post(
			array(
				'post_title'    => $data[0],
				'post_name'     => $slug,
				'post_content'  => $data[1],
				'page_template' => $data[2],
				'post_status'   => $data[3],
				'post_type'     => 'page',
			)
		);
	}
}
add_action( 'after_switch_theme', 'kinesilk_create_pages' );

/**
 * Insignias de destaque sobre la imagen del producto (además de "Oferta"):
 * Destacado (producto con ★), Nuevo (publicado hace menos de 30 días) y Agotado.
 * Se añaden a la salida del bloque nativo de imagen/galería de WooCommerce.
 *
 * @param string $content Bloque renderizado.
 * @return string
 */
function kinesilk_product_badges( $content ) {
	global $product;
	$p = $product instanceof WC_Product ? $product : wc_get_product( get_the_ID() );
	if ( ! $p ) {
		return $content;
	}
	$html = kinesilk_badges_html( $p );
	return $html ? '<div class="ks-product-media">' . $html . $content . '</div>' : $content;
}

/**
 * HTML de las insignias de un producto (o cadena vacía).
 *
 * @param WC_Product $p Producto.
 * @return string
 */
function kinesilk_badges_html( $p ) {
	$badges = array();
	if ( $p->is_on_sale() && $p->get_regular_price() && $p->get_sale_price() ) {
		$pct      = round( 100 - ( (float) $p->get_sale_price() / (float) $p->get_regular_price() ) * 100 );
		$badges[] = array( 'sale', sprintf( '-%d%%', $pct ) );
	}
	if ( $p->is_featured() ) {
		$badges[] = array( 'featured', __( 'Destacado', 'kinesilk' ) );
	}
	if ( strtotime( $p->get_date_created() ) > strtotime( '-30 days' ) ) {
		$badges[] = array( 'new', __( 'Nuevo', 'kinesilk' ) );
	}
	if ( ! $p->is_in_stock() ) {
		$badges[] = array( 'out', __( 'Agotado', 'kinesilk' ) );
	}
	if ( ! $badges ) {
		return '';
	}
	$html = '<div class="ks-badges-overlay">';
	foreach ( $badges as $b ) {
		$html .= '<span class="ks-pbadge ks-pbadge--' . esc_attr( $b[0] ) . '">' . esc_html( $b[1] ) . '</span>';
	}
	return $html . '</div>';
}
if ( class_exists( 'WooCommerce' ) || defined( 'WC_VERSION' ) ) {
	add_filter( 'render_block_woocommerce/product-image-gallery', 'kinesilk_product_badges' );
	add_filter( 'render_block_woocommerce/product-image', 'kinesilk_product_badges' );
}

/* ==========================================================================
   Mini carrito desplegable [ks_minicart]
   ========================================================================== */

function kinesilk_minicart_count() {
	$n = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
	return '<span class="ks-mc__count" data-count="' . esc_attr( $n ) . '"' . ( $n ? '' : ' hidden' ) . '>' . esc_html( $n ) . '</span>';
}

/**
 * Contenido del desplegable: hasta 5 productos, aviso si hay más, subtotal y botones.
 */
function kinesilk_minicart_body() {
	$max   = 5;
	$cart  = WC()->cart;
	$items = $cart ? $cart->get_cart() : array();
	$html  = '<div class="ks-mc__body">';
	if ( ! $items ) {
		$html .= '<p class="ks-mc__empty">' . esc_html__( 'Tu carrito está vacío.', 'kinesilk' ) . '</p>';
		$html .= '<div class="ks-mc__actions"><a class="ks-mc__btn ks-mc__btn--ghost" href="' . esc_url( home_url( '/servicios/' ) ) . '">' . esc_html__( 'Ver servicios', 'kinesilk' ) . '</a></div>';
		return $html . '</div>';
	}
	$html .= '<ul class="ks-mc__list">';
	$i     = 0;
	foreach ( $items as $item ) {
		if ( $i++ >= $max ) {
			break;
		}
		$p = $item['data'];
		if ( ! $p instanceof WC_Product ) {
			continue;
		}
		$html .= '<li class="ks-mc__item">';
		$html .= '<a class="ks-mc__thumb" href="' . esc_url( $p->get_permalink() ) . '" tabindex="-1" aria-hidden="true">' . $p->get_image( 'woocommerce_gallery_thumbnail' ) . '</a>';
		$html .= '<div class="ks-mc__info"><a class="ks-mc__name" href="' . esc_url( $p->get_permalink() ) . '">' . esc_html( $p->get_name() ) . '</a>';
		$html .= '<span class="ks-mc__meta">' . esc_html( $item['quantity'] ) . ' × ' . wp_kses_post( wc_price( wc_get_price_to_display( $p ) ) ) . '</span></div>';
		$html .= '</li>';
	}
	$html .= '</ul>';
	$extra = count( $items ) - $max;
	if ( $extra > 0 ) {
		/* translators: %d: productos adicionales */
		$html .= '<p class="ks-mc__more">' . esc_html( sprintf( _n( 'y %d producto más en tu carrito', 'y %d productos más en tu carrito', $extra, 'kinesilk' ), $extra ) ) . '</p>';
	}
	$html .= '<p class="ks-mc__subtotal"><span>' . esc_html__( 'Subtotal', 'kinesilk' ) . '</span><strong>' . wp_kses_post( $cart->get_cart_subtotal() ) . '</strong></p>';
	$html .= '<div class="ks-mc__actions"><a class="ks-mc__btn" href="' . esc_url( wc_get_cart_url() ) . '">' . esc_html__( 'Ir al carrito', 'kinesilk' ) . '</a>';
	$html .= '<a class="ks-mc__btn ks-mc__btn--ghost" href="' . esc_url( wc_get_checkout_url() ) . '">' . esc_html__( 'Finalizar compra', 'kinesilk' ) . '</a></div>';
	return $html . '</div>';
}

function kinesilk_minicart_shortcode() {
	if ( ! function_exists( 'WC' ) || is_admin() ) {
		return '';
	}
	$icon  = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 4h2l2.4 11.2a1.5 1.5 0 0 0 1.5 1.2h8.6a1.5 1.5 0 0 0 1.5-1.1L21 8H6"/><circle cx="9.5" cy="20" r="1.3"/><circle cx="17.5" cy="20" r="1.3"/></svg>';
	$html  = '<div class="ks-mc ks-minicart">';
	$html .= '<button type="button" class="ks-mc__toggle" aria-expanded="false" aria-controls="ks-mc-panel" aria-label="' . esc_attr__( 'Carrito', 'kinesilk' ) . '">' . $icon . kinesilk_minicart_count() . '</button>';
	$html .= '<div class="ks-mc__panel" id="ks-mc-panel" role="region" aria-label="' . esc_attr__( 'Resumen del carrito', 'kinesilk' ) . '" hidden>';
	$html .= '<p class="ks-mc__title">' . esc_html__( 'Tu carrito', 'kinesilk' ) . '</p>' . kinesilk_minicart_body() . '</div></div>';
	return $html;
}
add_shortcode( 'ks_minicart', 'kinesilk_minicart_shortcode' );

add_filter(
	'woocommerce_add_to_cart_fragments',
	function ( $fragments ) {
		$fragments['span.ks-mc__count'] = kinesilk_minicart_count();
		$fragments['div.ks-mc__body']   = kinesilk_minicart_body();
		return $fragments;
	}
);

/**
 * body.ks-has-cart cuando hay productos sin checkout completo (muestra "Finalizar compra").
 */
add_filter(
	'body_class',
	function ( $classes ) {
		if ( function_exists( 'WC' ) && WC()->cart && WC()->cart->get_cart_contents_count() > 0 && ! is_checkout() ) {
			$classes[] = 'ks-has-cart';
		}
		return $classes;
	}
);

/**
 * Añade "Finalizar compra" al final del menú .ks-nav (visible solo con body.ks-has-cart).
 */
function kinesilk_nav_checkout( $content, $block ) {
	if ( ! function_exists( 'wc_get_checkout_url' ) || false === strpos( $block['attrs']['className'] ?? '', 'ks-nav' ) ) {
		return $content;
	}
	$pos = strrpos( $content, '</ul>' );
	if ( false === $pos ) {
		return $content;
	}
	$li = '<li class="wp-block-navigation-item ks-nav-checkout"><a class="wp-block-navigation-item__content" href="' . esc_url( wc_get_checkout_url() ) . '"><span class="wp-block-navigation-item__label">' . esc_html__( 'Finalizar compra', 'kinesilk' ) . '</span></a></li>';
	return substr_replace( $content, $li, $pos, 0 );
}
add_filter( 'render_block_core/navigation', 'kinesilk_nav_checkout', 10, 2 );

/* ==========================================================================
   Subcategorías en la página de categoría [ks_subcategorias]
   Muestra las hijas de la categoría actual; si no tiene, sus hermanas.
   ========================================================================== */
function kinesilk_subcats_shortcode() {
	if ( ! function_exists( 'is_product_category' ) || ! is_product_category() ) {
		return '';
	}
	$current = get_queried_object();
	$terms   = get_terms( array( 'taxonomy' => 'product_cat', 'parent' => $current->term_id, 'hide_empty' => true ) );
	$context = $current->name;
	if ( ! $terms && $current->parent ) {
		$terms  = get_terms( array( 'taxonomy' => 'product_cat', 'parent' => $current->parent, 'hide_empty' => true ) );
		$parent = get_term( $current->parent, 'product_cat' );
		if ( $parent && ! is_wp_error( $parent ) ) {
			$context = $parent->name;
		}
	}
	if ( is_wp_error( $terms ) || ! $terms ) {
		return '';
	}
	/* translators: %s: nombre de la categoría actual */
	$label = sprintf( __( 'Subcategorías de %s', 'kinesilk' ), $context );
	$html  = '<p class="ks-group-label">' . esc_html( $label ) . '</p>';
	$html .= '<nav class="ks-subcats" aria-label="' . esc_attr( $label ) . '"><ul>';
	foreach ( $terms as $t ) {
		$html .= '<li><a href="' . esc_url( get_term_link( $t ) ) . '"' . ( $t->term_id === $current->term_id ? ' aria-current="page"' : '' ) . '>' . esc_html( $t->name ) . '</a></li>';
	}
	return $html . '</ul></nav>';
}
add_shortcode( 'ks_subcategorias', 'kinesilk_subcats_shortcode' );

/* ==========================================================================
   Packs del inicio [ks_packs]: los filtros cargan los servicios en el mismo
   lugar y el botón inferior cambia a "Ver todo en {categoría}".
   Sin JS, cada filtro es un enlace normal a la página de la categoría.
   ========================================================================== */

function kinesilk_packs_products( $slug = '' ) {
	$args = array( 'status' => 'publish', 'limit' => 4, 'visibility' => 'catalog' );
	if ( $slug ) {
		return wc_get_products( $args + array( 'category' => array( $slug ), 'orderby' => 'menu_order', 'order' => 'ASC' ) );
	}
	$items = wc_get_products( $args + array( 'featured' => true ) );
	return $items ? $items : wc_get_products( $args );
}

function kinesilk_pcard( $p ) {
	$link  = $p->get_permalink();
	$ajax  = $p->is_type( 'simple' ) && $p->is_purchasable() && $p->is_in_stock();
	$btn   = $ajax
		? '<a href="' . esc_url( $p->add_to_cart_url() ) . '" data-quantity="1" data-product_id="' . esc_attr( $p->get_id() ) . '" class="ks-pcard__btn add_to_cart_button ajax_add_to_cart wp-element-button" rel="nofollow">' . esc_html__( 'Agregar al carrito', 'kinesilk' ) . '</a>'
		: '<a href="' . esc_url( $link ) . '" class="ks-pcard__btn wp-element-button">' . esc_html__( 'Ver detalle', 'kinesilk' ) . '</a>';
	$html  = '<li class="ks-pcard">';
	$html .= '<a class="ks-pcard__media" href="' . esc_url( $link ) . '" tabindex="-1" aria-hidden="true">' . kinesilk_badges_html( $p ) . $p->get_image( 'woocommerce_thumbnail' ) . '</a>';
	$html .= '<h3 class="ks-pcard__title"><a href="' . esc_url( $link ) . '">' . esc_html( $p->get_name() ) . '</a></h3>';
	$html .= '<div class="ks-pcard__price">' . wp_kses_post( $p->get_price_html() ) . '</div>' . $btn . '</li>';
	return $html;
}

function kinesilk_packs_payload( $slug = '' ) {
	$html = '';
	foreach ( kinesilk_packs_products( $slug ) as $p ) {
		$html .= kinesilk_pcard( $p );
	}
	if ( ! $html ) {
		$html = '<li class="ks-pcard ks-pcard--empty">' . esc_html__( 'Pronto tendremos servicios en esta categoría.', 'kinesilk' ) . '</li>';
	}
	$term = $slug ? get_term_by( 'slug', $slug, 'product_cat' ) : null;
	return array(
		'html'  => $html,
		'link'  => $term ? get_term_link( $term ) : home_url( '/servicios/' ),
		/* translators: %s: nombre de categoría */
		'label' => $term ? sprintf( __( 'Ver todo en %s', 'kinesilk' ), $term->name ) : __( 'Ver todos los servicios', 'kinesilk' ),
	);
}

function kinesilk_packs_shortcode() {
	if ( ! function_exists( 'wc_get_products' ) ) {
		return '';
	}
	$terms = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'parent'     => 0,
			'hide_empty' => true,
			'exclude'    => array( (int) get_option( 'default_product_cat' ) ),
		)
	);
	$data  = kinesilk_packs_payload();
	$html  = '<div class="ks-packs-ui" data-ks-packs>';
	$html .= '<nav class="ks-cats" aria-label="' . esc_attr__( 'Filtrar por categoría', 'kinesilk' ) . '"><ul class="wc-block-product-categories-list">';
	$html .= '<li class="wc-block-product-categories-list-item"><a href="' . esc_url( home_url( '/servicios/' ) ) . '" data-cat="" aria-current="true">' . esc_html__( 'Destacados', 'kinesilk' ) . '</a></li>';
	if ( ! is_wp_error( $terms ) ) {
		foreach ( $terms as $t ) {
			$html .= '<li class="wc-block-product-categories-list-item"><a href="' . esc_url( get_term_link( $t ) ) . '" data-cat="' . esc_attr( $t->slug ) . '">' . esc_html( $t->name ) . '</a></li>';
		}
	}
	$html .= '</ul></nav>';
	$html .= '<ul class="ks-pgrid" aria-live="polite">' . $data['html'] . '</ul>';
	$html .= '<div class="wp-block-buttons ks-packs__more"><div class="wp-block-button is-style-ks-ghost"><a class="wp-block-button__link wp-element-button ks-packs__link" href="' . esc_url( $data['link'] ) . '">' . esc_html( $data['label'] ) . '</a></div></div>';
	return $html . '</div>';
}
add_shortcode( 'ks_packs', 'kinesilk_packs_shortcode' );

add_action(
	'rest_api_init',
	function () {
		register_rest_route(
			'kinesilk/v1',
			'/productos',
			array(
				'methods'             => 'GET',
				'permission_callback' => '__return_true',
				'args'                => array( 'cat' => array( 'sanitize_callback' => 'sanitize_title' ) ),
				'callback'            => function ( $req ) {
					return rest_ensure_response( kinesilk_packs_payload( (string) $req->get_param( 'cat' ) ) );
				},
			)
		);
	}
);

/**
 * Marca la categoría actual en el bloque de categorías (estilo activo igual que en Inicio).
 */
add_filter(
	'render_block_woocommerce/product-categories',
	function ( $content ) {
		if ( ! function_exists( 'is_product_category' ) || ! is_product_category() ) {
			return $content;
		}
		$link = get_term_link( get_queried_object() );
		if ( is_wp_error( $link ) ) {
			return $content;
		}
		return str_replace( 'href="' . esc_url( $link ) . '"', 'href="' . esc_url( $link ) . '" aria-current="page"', $content );
	}
);


/**
 * SEO — Datos estructurados (schema.org) para posicionamiento local en Google
 * y descubrimiento por IA (Claude, ChatGPT, Gemini). Emite JSON-LD en el <head>.
 */
function kinesilk_schema_jsonld() {
	if ( is_admin() ) {
		return;
	}

	$home = home_url( '/' );
	$logo = get_theme_file_uri( 'assets/images/logo-kinesilk-ink.png' );

	$business = array(
		'@type'       => array( 'HealthAndBeautyBusiness', 'MedicalBusiness' ),
		'@id'         => $home . '#business',
		'name'        => 'Kinesilk',
		'description' => 'Centro de estetica laser en Punta Arenas: depilacion laser facial y corporal, despigmentacion, eliminacion de tatuajes y rejuvenecimiento facial (Hollywood Peel).',
		'url'         => $home,
		'logo'        => $logo,
		'image'       => $logo,
		'telephone'   => '+56 9 8752 4346',
		'email'       => 'contactokinesilk@gmail.com',
		'priceRange'  => '$$',
		'currenciesAccepted' => 'CLP',
		'address'     => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'Gral. Juan Salvo 0183',
			'addressLocality' => 'Punta Arenas',
			'addressRegion'   => 'Magallanes y la Antartica Chilena',
			'postalCode'      => '6200000',
			'addressCountry'  => 'CL',
		),
		'areaServed'  => array( '@type' => 'City', 'name' => 'Punta Arenas' ),
		'sameAs'      => array( 'https://www.instagram.com/kinesilk/' ),
		'openingHoursSpecification' => array(
			array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ),
				'opens'     => '09:00',
				'closes'    => '19:00',
			),
			array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => 'Saturday',
				'opens'     => '09:00',
				'closes'    => '14:00',
			),
		),
		'hasOfferCatalog' => array(
			'@type' => 'OfferCatalog',
			'name'  => 'Tratamientos de estetica laser',
			'itemListElement' => array(
				array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Depilacion laser', 'areaServed' => 'Punta Arenas' ) ),
				array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Despigmentacion laser', 'areaServed' => 'Punta Arenas' ) ),
				array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Eliminacion de tatuajes con laser', 'areaServed' => 'Punta Arenas' ) ),
				array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Rejuvenecimiento facial (Hollywood Peel)', 'areaServed' => 'Punta Arenas' ) ),
			),
		),
	);

	$website = array(
		'@type'     => 'WebSite',
		'@id'       => $home . '#website',
		'url'       => $home,
		'name'      => 'Kinesilk',
		'publisher' => array( '@id' => $home . '#business' ),
		'inLanguage' => 'es-CL',
	);

	$graph = array( $business, $website );

	// FAQPage solo en la pagina de Contacto (donde se renderiza el FAQ).
	if ( is_page( 'contacto' ) ) {
		$faqs = array(
			array( 'La depilacion laser duele?', 'La mayoria de las personas la describen como una sensacion de calor o pequenos golpecitos. Es rapida, segura y bien tolerada.' ),
			array( 'Cuantas sesiones de depilacion laser necesito?', 'Entre 6 y 10 sesiones segun la zona, tipo de piel y tipo de vello.' ),
			array( 'La depilacion laser es definitiva?', 'Reduce el vello entre un 80% y 95% de manera permanente; luego se recomiendan mantenciones ocasionales.' ),
			array( 'Puedo depilarme si estoy bronceada?', 'Si, pero recomendamos esperar 7 a 10 dias despues de una exposicion solar intensa.' ),
			array( 'Que es el Hollywood Peel?', 'Un peeling laser donde se aplica carbon activado sobre la piel; al aplicar el laser genera luminosidad, afina poros y mejora la textura sin dolor ni tiempo de recuperacion.' ),
			array( 'Que es la despigmentacion laser?', 'Un tratamiento que usa energia laser para aclarar manchas, equilibrar la melanina y mejorar el tono de la piel. Ideal para melasma, lentigos solares, manchas por edad y dano solar.' ),
			array( 'El melasma se puede tratar con laser?', 'Si. El laser ayuda a regular la melanina y reducir la pigmentacion; el melasma es cronico, por lo que se recomienda mantencion y protector solar diario.' ),
			array( 'Realizan borrado de tatuajes?', 'Si. Eliminamos o atenuamos tatuajes con laser de forma segura y precisa, sesion a sesion.' ),
			array( 'Atienden hombres y mujeres?', 'Si, atendemos a hombres y mujeres con tratamientos adaptados a cada tipo de piel y vello.' ),
			array( 'Como puedo agendar una cita?', 'Puedes agendar por WhatsApp al +56 9 8752 4346. La evaluacion inicial es gratuita.' ),
		);
		$main = array();
		foreach ( $faqs as $f ) {
			$main[] = array(
				'@type'          => 'Question',
				'name'           => $f[0],
				'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f[1] ),
			);
		}
		$graph[] = array(
			'@type'      => 'FAQPage',
			'@id'        => $home . '#faq',
			'mainEntity' => $main,
		);
	}

	$data = array( '@context' => 'https://schema.org', '@graph' => $graph );

	echo "\n" . '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'kinesilk_schema_jsonld', 20 );

/**
 * SEO — noindex en paginas funcionales (carrito, checkout, mi cuenta) para que
 * no compitan en buscadores.
 */
function kinesilk_noindex_functional( $robots ) {
	if ( function_exists( 'is_cart' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
		$robots['noindex']  = true;
		$robots['follow']   = true;
	}
	return $robots;
}
add_filter( 'wp_robots', 'kinesilk_noindex_functional' );
