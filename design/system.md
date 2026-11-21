# Kinesilk — Design System (sync desde el tema)

Sincronizado desde las fuentes reales del tema `kinesilk_new`. No es un starter propuesto: todos los valores provienen de los archivos del tema.

## Colores

| Token | Valor | Uso |
| --- | --- | --- |
| `--ks-cream` | `#FCF9EA` | Fondo global del sitio |
| `--ks-white` | `#FFFFFF` | Tarjetas, píldoras |
| `--ks-ink` | `#1E2B2A` | Texto, botón CTA primario |
| `--ks-ink-soft` | `#4A5856` | Texto secundario, precios de píldora |
| `--ks-mint` | `#87E9CE` | Etiqueta "Recomendada", estados de éxito |
| `--ks-coral` | `#FEA4A4` | Acento: hover, pestaña activa, subrayado de tabs |
| `--ks-blush` | `#FFBDBE` | Acento suave |
| `--ks-aqua` | `#BADEDA` | Acento frío |
| `--ks-promo-pink` | `#C2366B` | Badge de descuento (-47% OFF) |
| `--ks-promo-yellow` | `#FFC22E` | Promos gráficas |

Fuentes: `styles.css:9-29` y `theme.json:77-133`.

## Tipografía

| Token | Valor | Uso |
| --- | --- | --- |
| `--wp--preset--font-family--heading` | Outfit (local, 400–700) | Títulos, números de píldora, precio principal |
| `--wp--preset--font-family--body` | DM Sans (local, 400–700) | Cuerpo, precios secundarios |

## Radio y sombra

| Token | Valor | Uso |
| --- | --- | --- |
| `--ks-radius` | `24px` | Tarjetas, secciones |
| `--ks-radius-sm` | `14px` | Píldoras, controles internos |
| — | `999px` | Botones CTA y chips (totalmente redondeados) |
| — | `6px`–`7px` | Badges pequeños (off, tag) |
| `--ks-shadow` | `0 1px 2px rgba(30,43,42,.04), 0 12px 32px -16px rgba(30,43,42,.18)` | Tarjetas de producto |

## Componentes clave (fuente: `styles.css`)

- **Píldora seleccionable** (`.ks-sel__pill`, :4484-4500): fondo blanco, borde `1.5px solid rgba(30,43,42,.16)`, radio `--ks-radius-sm`; activa → borde coral + fondo `rgba(254,164,164,.16)`; hover → borde coral. Etiqueta en Outfit 700, precio `.78rem` en ink-soft.
- **Tag "Recomendada"** (`.ks-sel__tag`, :4503-4517): fondo mint, `.58rem` uppercase, radio `7px`, posición absoluta sobre la primera píldora.
- **CTA de tarjeta** (`.ks-sel__cta`, :4526-4542): fondo ink, texto cream, radio `999px`, `min-height:48px`; hover → coral con texto ink.
- **Tabs WooCommerce** (`.wc-tabs`, :1898-1919): fila con `gap:.5rem`, regla inferior `1px solid rgba(30,43,42,.12)`, ítem activo con `border-bottom:3px solid var(--ks-coral)`.
- **Badge descuento** (`.ks-sel__off`, :4521): fondo promo-pink, texto blanco, radio `6px`, `.72rem`.
- **Tarjeta de producto** (`.wc-block-product`, :846-855): fondo blanco, radio `24px`, sombra `--ks-shadow`, padding inferior `1.25rem`.

## Reglas de interacción (fuente: `assets/js/session-select.js`)

- Conmutación por click con `aria-pressed`; el bloque de precio se repinta desde atributos `data-now/data-reg/data-ses`.
- Precios formateados con `Intl.NumberFormat('es-CL', { style:'currency', currency:'CLP' })`.
- Re-inicialización en `wc-blocks_product_list_rendered` + `MutationObserver`.
