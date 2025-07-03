# DadeCore Theme - Versión Profesional

**DadeCore Theme** es un tema de WordPress premium, altamente personalizable y enfocado en la creación y gestión visual de sitios web directamente desde el backend de WordPress. Diseñado con una estética digital/tech moderna, es totalmente compatible con el editor de bloques Gutenberg y está optimizado para rendimiento, SEO y seguridad.

## Características Principales

### Diseño y Personalización Visual
*   **Estética Digital/Tech:** Colores predefinidos (azul oscuro, verde tech, grises) y tipografías (Inter, Poppins) que proporcionan una base moderna y tecnológica.
*   **Personalización Completa con `theme.json`:**
    *   Define y ajusta la paleta de colores global y por bloque.
    *   Configura la tipografía (familias, tamaños, pesos) para todo el sitio y elementos específicos.
    *   Controla el espaciado, dimensiones y layout por defecto.
    *   Estilos para bloques de Gutenberg directamente desde `theme.json`.
*   **Editor de Bloques (Gutenberg):**
    *   Soporte completo para el editor de bloques, incluyendo estilos de editor que reflejan el frontend.
    *   Soporte para alineaciones amplias y completas (`alignwide`, `alignfull`).
    *   **Patrones de Bloques Predefinidos:** Incluye patrones para secciones comunes como Héroe, Servicios, Portfolio y Blog Reciente, facilitando la construcción de páginas. (Ver "DadeCore Patterns" en el insertador de bloques).
*   **Diseño Responsivo:** Adaptable a todos los tamaños de pantalla, desde móviles hasta escritorios.
*   **Efectos Visuales Sutiles:**
    *   Efecto "Glow" en tarjetas al pasar el cursor.
    *   Bordes animados "Rainbow" para destacar elementos.
    *   Uso de Glassmorphism en elementos como la cabecera y tarjetas.
    *   Animaciones suaves en transiciones y hovers.
*   **Logo Personalizado:** Sube tu logo fácilmente desde el Personalizador de WordPress.

### Gestión de Contenido
*   **Blog Funcional:**
    *   Plantillas para listado de entradas (blog, archivos de categoría/etiqueta, resultados de búsqueda).
    *   Plantilla para entradas individuales.
    *   Soporte para comentarios de WordPress.
    *   Paginación y navegación entre entradas.
*   **Gestión Visual de Páginas:** Crea páginas, landings, y otras secciones utilizando el editor de bloques y los patrones predefinidos.
*   **Áreas de Widgets:**
    *   Barra lateral principal (Primary Sidebar).
    *   Múltiples columnas en el pie de página (Footer Columns 1-3).
    *   **Zonas de Anuncios:**
        *   `Ads: Header`: Para anuncios en la cabecera.
        *   `Ads: After Content`: Para anuncios después del contenido principal en posts y páginas.
        *   `Ads: In-Feed`: Para anuncios entre los posts en listados de blog/archivos.

### SEO y Optimización
*   **SEO Nativo:**
    *   **Meta Tags Automáticos:** Títulos, descripciones, canónicas, y Open Graph (og:title, og:description, og:image, og:type, og:url, og:site_name) y Twitter Cards para un mejor compartido en redes sociales.
    *   **Schema Markup JSON-LD:**
        *   `Organization`: Para la página de inicio, incluyendo logo y perfiles sociales (configurables en Opciones del Tema).
        *   `WebSite`: Incluye Sitelinks Searchbox.
        *   `Article` / `BlogPosting`: Para entradas de blog, con detalles como autor, publisher, fechas, imagen.
        *   `WebPage`: Para páginas genéricas.
        *   (Preparado para `Service` schema con futura implementación).
*   **Optimización de Velocidad:**
    *   **Lazy Loading:** Para imágenes (nativo de WordPress).
    *   **CSS y JS optimizados:** Código limpio y modular. Versionado de archivos CSS/JS para cache busting.
    *   **Fuentes:** Uso de Google Fonts con `precache` y posibilidad de servir fuentes locales (Inter, Poppins) definidas en `theme.json`.
    *   **Sin dependencias innecesarias:** JavaScript nativo siempre que es posible.

### Seguridad
*   **URL de Login Personalizada:** Configurable desde Opciones del Tema para ocultar `wp-login.php`.
*   **Límite de Intentos de Acceso:** Protección contra ataques de fuerza bruta, configurable (intentos máximos, tiempo de bloqueo).
*   **Cabeceras de Seguridad Estándar:** Incluye `X-Frame-Options`, `X-Content-Type-Options`, `Referrer-Policy` (configurable).
*   Diseñado para no entrar en conflicto con plugins de seguridad populares como Wordfence.

### Funcionalidades Adicionales
*   **Integración con Google Tag Manager (GTM):** Fácil configuración mediante ID en Opciones del Tema.
*   **Sistema de Consentimiento de Cookies (GDPR / Consent Mode v2):**
    *   Banner de consentimiento y modal de configuración personalizable.
    *   Permite al usuario gestionar categorías de consentimiento (Necesarias, Analíticas, Marketing).
    *   Integrado con Google Consent Mode v2: ajusta el comportamiento de las etiquetas de Google (Analytics, Ads) según el consentimiento del usuario.
    *   Configuración por defecto "denegar todo" (excepto esenciales) antes de la interacción del usuario.
*   **Opciones del Tema:** Panel dedicado ("DadeCore Theme") en el admin de WordPress para:
    *   **Integraciones:** Google Tag Manager ID, Perfiles Sociales para Schema.
    *   **Seguridad:** Configuración de protección de login y cabeceras de seguridad.

## Instalación

1.  Descarga el archivo `.zip` del tema.
2.  En tu panel de WordPress, ve a `Apariencia > Temas > Añadir nuevo > Subir tema`.
3.  Sube el archivo `.zip` e instálalo.
4.  Activa el tema "DadeCore Theme".

## Configuración Recomendada

1.  **Personalizador de WordPress (`Apariencia > Personalizar`):**
    *   Sube tu **Logo del Sitio**.
    *   Configura el **Título del sitio** y la **Descripción corta**.
    *   Crea y asigna el **Menú Principal** a la ubicación "Menú Principal".
2.  **Opciones del Tema (`DadeCore Theme` en el menú lateral del admin):**
    *   **Pestaña Integraciones:**
        *   Introduce tu **Google Tag Manager ID**.
        *   Añade las **URLs de tus Perfiles Sociales**.
    *   **Pestaña Seguridad:**
        *   Configura el **Login URL Slug**, los **Intentos Máximos de Login**, y el **Tiempo de Bloqueo** según tus preferencias.
        *   Habilita o deshabilita las **Cabeceras de Seguridad** (recomendado habilitar si no usas un CDN/firewall que ya las gestione).
3.  **Widgets (`Apariencia > Widgets`):**
    *   Añade widgets a las áreas disponibles: `Primary Sidebar`, `Footer Column 1-3`, y las áreas de anuncios (`Ads: Header`, `Ads: After Content`, `Ads: In-Feed`).
4.  **Página de Inicio:**
    *   Ve a `Ajustes > Lectura`.
    *   Configura "Tu página de inicio muestra" a "Una página estática".
    *   Selecciona la página que deseas como "Portada". Puedes construir esta página usando el editor de bloques y los "DadeCore Patterns".
5.  **Consentimiento de Cookies:**
    *   El banner de consentimiento aparecerá automáticamente. Los usuarios podrán gestionar sus preferencias. La configuración de categorías está en `inc/cookie-consent.php` (para desarrolladores).

## Estructura de Archivos y Desarrollo

El tema sigue la estructura estándar de WordPress y está organizado de forma modular:

*   `assets/`: Contiene CSS, JS, imágenes y fuentes.
*   `inc/`: Funcionalidad modular del tema (personalizador, gutenberg, seguridad, seo, opciones, widgets, helpers).
*   `template-parts/`: Partes de plantillas reutilizables (ej. contenido de página, contenido "nada encontrado").
*   `*.php`: Archivos de plantilla principales de WordPress.
*   `theme.json`: Define la configuración y estilos base para el editor de bloques y el frontend.

El código está comentado para facilitar su comprensión y futuras modificaciones. Sigue las buenas prácticas de desarrollo de WordPress y está preparado para escalar.

## Contribuir y Soporte

Este tema es un proyecto base robusto. Para personalizaciones avanzadas o nuevas funcionalidades, se recomienda crear un tema hijo o contactar a un desarrollador.

---

*DadeCore Bizz LLC - Potenciando Operaciones Digitales*
