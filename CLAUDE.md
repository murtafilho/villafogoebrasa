# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Villa Fogo & Brasa is a premium Brazilian steakhouse (churrascaria) website built with Laravel 12 and Tailwind CSS 4. It's a single-page application showcasing the restaurant with sections for menu, experience, gallery, reservations, and contact.

## Environments

| Environment | SSH Alias | Directory | Domain |
|-------------|-----------|-----------|--------|
| Stage | `villafogo` | `~/stage.villafogoebrasa.com.br` | stage.villafogoebrasa.com.br |
| Production | `villafogo` | `~/villafogoebrasa.com.br` | villafogoebrasa.com.br |

## CRITICAL WARNINGS

### Deploy - NEVER use route cache!

```bash
# Deploy to STAGE:
ssh villafogo "cd ~/stage.villafogoebrasa.com.br && git pull && php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan view:clear"

# Deploy to PRODUCTION:
ssh villafogo "cd ~/villafogoebrasa.com.br && git pull && php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan view:clear"

# FORBIDDEN - causes 405 errors:
php artisan optimize      # NEVER USE
php artisan route:cache   # NEVER USE
```

Fix "Method Not Allowed" errors:
```bash
ssh villafogo "cd ~/villafogoebrasa.com.br && rm -rf bootstrap/cache/*.php && php artisan route:clear && php artisan cache:clear && php artisan config:clear"
```

See `PERIGO.md` for details.

### Tailwind CSS v4

**This project uses Tailwind CSS v4. NEVER use v3 syntax.**

```css
/* CORRECT (v4) */
@import "tailwindcss";
@theme {
  --color-villa-ember: #c45c26;
}

/* WRONG (v3) - DO NOT USE */
@tailwind base;
@tailwind components;
```

Deprecated utilities to avoid:
- `bg-opacity-*` → use `bg-black/50`
- `flex-shrink-0` → use `shrink-0`
- `flex-grow` → use `grow`
- `overflow-ellipsis` → use `text-ellipsis`

Before modifying CSS, check `resources/css/app.css` for existing patterns.

## Development Commands

```bash
composer dev          # Full dev environment (server + queue + vite)
composer test         # Run tests
composer setup        # Initial setup
npm run build         # Build frontend assets
npm run dev           # Vite dev server with HMR
./vendor/bin/pint     # Code formatting
```

## Testing

```bash
php artisan test                              # All tests
php artisan test tests/Feature/ExampleTest.php  # Single file
php artisan test --filter=test_name           # Filter by name
```

## Architecture

### Stack
- Laravel 12 with streamlined structure (no Kernel files)
- Tailwind CSS 4 via `@tailwindcss/vite`
- Blade templates with layouts/partials pattern
- Lucide icons via CDN
- Alpine.js for interactions

### Template Structure
- `resources/views/layouts/app.blade.php` - Main layout
- `resources/views/home.blade.php` - Homepage
- `resources/views/partials/` - Reusable sections (menu, gallery, reservations, contact)

### Custom Theme Colors
Defined in `resources/css/app.css` via `@theme`:
- Dark: `villa-charcoal`, `villa-espresso`, `villa-coffee`
- Accent: `villa-ember`, `villa-flame` (orange)
- Highlight: `villa-gold`
- Light: `villa-cream`

### Custom CSS Components
Available in `resources/css/app.css`:
- `.animate-fadeInUp`, `.animate-flicker`, `.ember-glow` - Animations
- `.hero-overlay` - Gradient overlay for hero sections
- `.line-accent` - Decorative line after headings
- `.card-hover` - Card lift effect on hover
- `.nav-link` - Navigation with animated underline
- `.stagger-1` through `.stagger-4` - Animation delays
