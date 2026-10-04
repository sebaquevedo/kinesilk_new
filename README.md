# Kinesilk New — tema de bloques (FSE)

Tema propio para reemplazar a Astra. Solo bloques nativos de WordPress y WooCommerce. Todo el CSS está en `styles.css`.

## Estructura (todo vive en `wp-content/themes/kinesilk_new/`)

```
kinesilk_new/
├── style.css            → solo la cabecera del tema (WordPress lo exige)
├── styles.css           → TODO el CSS, organizado por secciones
├── theme.json           → paleta, fuentes, tamaños, plantillas
├── functions.php        → carga de CSS, estilos de bloque, enlaces de WhatsApp
├── screenshot.png
├── assets/fonts/        → DM Sans, Outfit, Poppins (alojadas en el tema, sin Google)
├── assets/images/       → hero (escritorio/tablet/móvil) + imágenes de muestra
├── parts/               → header.html, footer.html
├── templates/           → page-landing (Landing Kinesilk), page, single, index, archive, search, 404
└── patterns/            → cada sección de la landing es un patrón editable
```

## Instalar en LocalWP

1. Copia la carpeta `kinesilk_new` en `app/public/wp-content/themes/` (o sube el zip en *Apariencia → Temas → Añadir → Subir*).
2. *Apariencia → Temas* → activa **Kinesilk New**. Astra queda instalado por si quieres volver atrás.
3. Al activarlo se crea la página **Inicio Kinesilk** en borrador, con la plantilla *Landing Kinesilk* y la landing completa.
4. Abre la página, revisa y publica. Después ve a *Ajustes → Lectura → Una página estática* → Portada: **Inicio Kinesilk**.
5. *Apariencia → Editor → Navegación*: confirma que se muestra el menú actual (el bloque Navegación usa el menú existente).
6. **Logo:** es un bloque Imagen en la cabecera y en el pie. Para cambiarlo: *Editor → Patrones → Cabecera* (y *Pie*) → selecciona el logo → **Reemplazar**. Sube el logo blanco tal cual: en la cabecera (fondo claro) ya tiene el estilo *Logo oscuro*, que lo tiñe automáticamente; en el pie (fondo oscuro) se ve blanco. También hay un estilo *Logo rosa*. Archivo incluido: `assets/images/logo-kinesilk-white.png` (+ versión `-ink` ya teñida).
7. **Menú móvil:** bajo 600 px el menú pasa a hamburguesa a la izquierda con el logo centrado; el botón fijo "Evaluación gratuita" queda como acción principal.

## Git / despliegue

Todos los cambios van dentro de `wp-content/themes/kinesilk_new/`:
```
git add wp-content/themes/kinesilk_new
git commit -m "Tema Kinesilk New"
git push
```
**Importante:** el contenido de la página (textos que edites en el editor) y lo que cambies en el Editor del sitio se guarda en la **base de datos**, no en Git. Para que un cambio de plantilla quede versionado, edítalo en el archivo del tema; si lo cambiaste en el editor, usa *Editor → ⋮ → Herramientas → Exportar*, o el plugin oficial *Create Block Theme* para guardar los cambios en los archivos del tema.

## Páginas del sitio

Se mantienen las páginas actuales: **Inicio, Servicios, Tecnología, Contacto y Carrito**. El tema trae una plantilla por página que se aplica **sola según el slug** (no hay que asignar nada):

- `templates/page-servicios.html` → `/servicios/`: categorías navegables + catálogo + CTA.
- `templates/page-tecnologia.html` → `/tecnologia/`: tecnología, fundadora, proceso y CTA.
- `templates/page-contacto.html` → `/contacto/`: datos de contacto, WhatsApp, Cómo llegar, Instagram y FAQ.
- `templates/page-cart.html` y `page-checkout.html`: carrito y pago de WooCommerce con la cabecera y el pie del tema. El contenido (bloques de carrito/checkout, TuuPago) no se toca.
- Inicio: página **Inicio Kinesilk** (plantilla *Landing Kinesilk*).

El contenido que ya tienen esas páginas (por ejemplo, el carrusel o un formulario) aparece **debajo** del diseño. Si sobra, bórralo en el editor de la página. Si el slug de tu página no coincide (por ejemplo `/tecnologia-2/`), renómbralo en *Páginas → Edición rápida → Slug*. Al activar el tema, solo se crean las páginas que falten. **Servicios:** la plantilla de la página ya incluye el patrón *Servicios — categorías navegables y catálogo*. Muestra las categorías con productos como botones deslizables (fijos al hacer scroll) y el catálogo paginado. Cada categoría usa la plantilla `templates/taxonomy-product_cat.html` con la misma barra de categorías. Si el carrusel del plugin ya está en Servicios, déjalo arriba del patrón.

**Inicio:** la sección "Packs y Tratamientos Destacados" también muestra las categorías como enlaces y un botón a Servicios.

"Ver promociones" lleva a **/servicios/** (si el slug es distinto, cámbialo en el botón).

## Colores

Solo la paleta de marca: crema #FCF9EA, coral #FEA4A4, rubor #FFBDBE, menta #87E9CE y agua #BADEDA, más tinta #1E2B2A para texto (los pasteles no alcanzan contraste AA como color de texto). El pie usa el degradado rubor → coral.

## Contacto, mapa y FAQ

- La página Contacto incluye tarjetas (dirección, WhatsApp, email, horario), el mapa de Google y las Preguntas frecuentes. Las FAQ ya no están en Inicio; para volver a ponerlas, inserta el patrón *Preguntas frecuentes*.
- El mapa es el único bloque **HTML personalizado** del tema: WordPress no tiene un bloque nativo de Google Maps. Para cambiar la ubicación, edita la dirección en la URL del iframe.

## Menú y animaciones

- Bajo 1024 px el menú es hamburguesa, con el logo centrado; desde 1024 px es horizontal. Es el bloque Navegación nativo.
- Animaciones solo con CSS: entrada del título promo y las cápsulas, imagen del hero flotando y aparición de tarjetas al hacer scroll (en navegadores compatibles; en el resto se ven sin animación). Se desactivan con "reducir movimiento" y dentro del editor.

## Qué editar y dónde

- **Número / mensajes de WhatsApp:** `functions.php` → `kinesilk_wa()`. Afecta a los patrones que se inserten desde ese momento; en la página ya creada, los enlaces se editan en el editor.
- **Título promo ("Semana Cyber" / "Descuentos imperdibles"):** son párrafos nativos. Cambia el texto en el editor. Estilos disponibles en el panel del bloque → *Estilos*: *Promo rosa*, *Promo amarillo*, *Cinta promo*.
- **Activar o desactivar el subtítulo (o cualquier grupo):** selecciona el bloque → *Estilos* → **Oculto en el sitio**. En el editor se verá semitransparente; en el sitio no aparece.
- **Volver al hero con video:** en la página, elimina el bloque *Hero promocional* e inserta el patrón **Hero con video institucional** (Insertar → Patrones → Kinesilk). Sube el video al bloque Portada.
- **Botón fijo "Evaluación gratuita":** `patterns/cta-flotante.php` (va en el pie de página).
- **Colores y fuentes:** `theme.json`. **Estilos visuales:** `styles.css`.

## Plugins que se conservan

- **WooCommerce:** compatible. "Packs y Tratamientos Destacados" muestra los productos marcados como **Destacado** (estrella ★ en *Productos*). Esa es la forma de elegir qué packs aparecen. Las categorías solo muestran las que tienen productos.
- **TuuPago / TuuCheckout:** el tema no toca el checkout. Se usan las plantillas de bloques de WooCommerce con la cabecera y el pie del tema.
- **Carrusel:** hay un patrón **Carrusel (plugin existente)** con un bloque Shortcode vacío: pega allí el shortcode del carrusel actual. En la landing, los tratamientos son tarjetas nativas que se deslizan en móvil.
- **Reseñas de Google:** el patrón *Testimonios* trae `[trustindex no-registration=google]`. Si el plugin instalado es otro, reemplaza el shortcode por el que se usa hoy en la página actual (no se modifica la configuración del plugin). Se actualiza solo cuando un cliente deja una reseña.

## Medidas de imágenes

- Hero: escritorio 1000×1000 · tablet 1200×760 · móvil 800×800 (WebP, bordes con degradado transparente). Se generaron a partir de la gráfica de Instagram (825×1024); para mayor nitidez, exporta la foto original a 2000 px de ancho.
- Diapositivas del carrusel: 1920×800 px (escritorio) y 1080×1350 px (móvil). Deja el texto fuera de la imagen.
- Foto "El momento de cuidar tu piel" / ofertas: 1000×1200 px (proporción 5:6).
- Retrato fundadora: 900×1100 px. Galería: 1080×1080 px (cuadradas).
- Reemplaza las imágenes de muestra (rayadas) desde el editor; el texto alternativo ya está escrito con enfoque SEO.

## SEO local (Punta Arenas)

- La portada tiene un H1 oculto para lectores de pantalla y buscadores: "Kinesilk: depilación láser, despigmentación y eliminación de tatuajes en Punta Arenas".
- Palabras clave sugeridas para productos y categorías: *depilación láser Punta Arenas, depilación definitiva, depilación íntima, despigmentación láser, manchas y melasma, eliminación / remoción de tatuajes, Hollywood Peel, cuidado de la piel, centro de estética Punta Arenas, bienestar*.
- En cada producto: título con tratamiento + zona ("Depilación láser axilas · Punta Arenas"), descripción corta de 1–2 frases con beneficio + ciudad, y texto alternativo en la imagen destacada.

## Revisar antes de publicar

- URL de Instagram: `https://www.instagram.com/kinesilk/` (confírmala).
