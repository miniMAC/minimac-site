# minimac-site

**Tema base WordPress minimalista focalizzato sulla SEO**

Creato su richiesta con Grok xAI.

## Caratteristiche principali
- **SEO-first**: Supporto completo per title-tag, meta viewport, HTML5 semantic, clean code senza bloat.
- Semplice e leggero: Solo PHP + HTML puro (no dipendenze Gutenberg o block editor).
- SCSS: File `assets/scss/style.scss` pronto per la tua compilazione locale (Sass, Vite, ecc.).
- Tailwind CSS: Incluso **localmente già compilato** in `assets/css/tailwind.css` (placeholder pronto per il tuo build completo con Tailwind CLI).
- JS: Script `assets/js/script.js` enqueued automaticamente su **tutte le pagine** tramite functions.php.
- Enqueue automatico di stili e script.

## Come usarlo
1. Clona la repo: `git clone https://github.com/miniMAC/minimac-site.git wp-content/themes/minimac-site`
2. Attiva il tema da WordPress Admin > Aspetto > Temi.
3. Compila il tuo SCSS localmente e aggiorna `assets/css/custom.css` (o modifica lo enqueue in functions.php).
4. Per Tailwind: Usa `npx tailwindcss -i ./assets/css/tailwind.css -o ./assets/css/tailwind.css --minify` o il tuo setup per aggiornare il build compilato.
5. Personalizza con PHP/HTML nei template.

## Struttura del tema
- `style.css` - Header del tema WordPress
- `functions.php` - Setup e enqueue
- `header.php` / `footer.php` - Header e footer
- Template: `index.php`, `single.php`, `page.php`, `404.php`
- Assets: css, scss, js

Perfetto per progetti veloci e SEO-oriented!

Made with ❤️ by Grok for RealCobraW.