# Cvetanichin WordPress Theme

Premium editorial WordPress theme for the Cvetanichin personal brand.
Two domain templates · Full widget sidebar support · Customizer controls · Complete design system.

---

## Requirements

| Item | Minimum |
|---|---|
| WordPress | 6.4+ |
| PHP | 8.1+ |
| MySQL | 5.7+ / MariaDB 10.4+ |

---

## Installation

### Theme

1. Upload the `cvetanichin-theme` folder to `/wp-content/themes/`
2. Activate via **Appearance → Themes**
3. Go to **Appearance → Customizer → Cvetanichin Brand** to configure

### Plugin

1. Upload `cvetanichin-widgets` to `/wp-content/plugins/`
2. Activate via **Plugins → Installed Plugins**
3. Add widgets via **Appearance → Widgets**

---

## Page Templates

Assign a template to any Page via **Page Attributes → Template**:

| Template | Domain | File |
|---|---|---|
| Default Page | Inherits active domain | `page.php` |
| **Consultancy Page** | Domain 1 — Gold · Stone · Slate | `page-consultancy.php` |
| **Self-Improvement Page** | Domain 2 — Pink · Blush · Purple | `page-selfimprovement.php` |

Both landing templates load their domain CSS automatically — no manual steps needed.

---

## Widget Areas

| Area ID | Used on |
|---|---|
| `sidebar-1` | Standard pages (default) |
| `sidebar-consultancy` | Consultancy Page template |
| `sidebar-selfimprovement` | Self-Improvement Page template |
| `sidebar-blog` | Blog index + single posts + archives |
| `footer-1/2/3` | Footer (all pages) |

---

## Custom Widgets (from plugin)

| Widget | Description |
|---|---|
| **Cvetanichin — CTA** | Headline + body + button block; accent / inverse / plain styles |
| **Cvetanichin — Bio Card** | Creator portrait + name + role + bio + link |
| **Cvetanichin — Stat Row** | Up to 3 editorial stat figures; dark/light mode |
| **Cvetanichin — Newsletter** | Email opt-in; supports shortcode for Mailchimp / CF7 / GF |
| **Cvetanichin — Recent Posts** | Brand-styled post list with optional thumbnails |
| **Cvetanichin — Product Card** | Price card with accent strip + CTA; for sidebars |
| **Cvetanichin — Pull Quote** | Italic serif quote; inset / plain / accent variant |

---

## Customizer Settings

**Appearance → Customize → Cvetanichin Brand**

- **Active Domain** — Self-Improvement (B2C) or CSO Consultancy (B2B)
- **Brand Identity** — Nav CTA label + URL, hero tagline
- **Layout** — Sidebar position (left / right / none), landing page sidebar toggle, footer columns
- **Typography** — Headline style (soft-italic / upright / direct)
- **Accent Presence** — Expressive / Restrained / Editorial

---

## Navigation Menus

Register menus at **Appearance → Menus**:

| Location | Slot |
|---|---|
| `primary` | Sticky nav bar |
| `footer` | Footer bar |
| `social` | Social links (use URL as menu item) |

---

## Recommended Plugins

| Plugin | Purpose |
|---|---|
| **WooCommerce** | Add to cart on Self-Improvement page (auto-detected) |
| **Gravity Forms** | Enquiry form on Consultancy page (auto-detected) |
| **Contact Form 7** | Alternative contact form |
| **Yoast SEO** | SEO titles + meta |
| **W3 Total Cache** | Page caching |
| **Smush** | Image optimisation |

---

## Design System

The theme embeds the full Cvetanichin design system tokens:

- `assets/css/tokens.css` — All CSS custom properties (spacing, type, effects)
- `assets/css/selfimprovement.css` — Domain 2 semantic overrides
- `assets/css/consultancy.css` — Domain 1 semantic overrides

Reference any token via `var(--token-name)` in child-theme stylesheets.

---

## Child Theme

Create a child theme to safely override styles:

```css
/* child-theme/style.css */
/*
Theme Name:   Cvetanichin Child
Template:     cvetanichin-theme
*/

/* Your overrides here — all tokens available */
.cv-nav { border-bottom-color: var(--accent-primary); }
```

---

## Colour Reference

### Domain 1 — CSO Consultancy

| Token | Value | Use |
|---|---|---|
| `--accent-primary` | `#E2C044` | CTA, markers, eyebrows |
| `--surface-base` | `#EDEAE5` | Body background |
| `--surface-inverse` | `#393E41` | Hero, footer |
| `--surface-white` | `#FAF9F6` | Cards |

### Domain 2 — Self-Improvement

| Token | Value | Use |
|---|---|---|
| `--accent-primary` | `#E55381` | CTA, markers, eyebrows |
| `--surface-base` | `#F5F0F1` | Body background |
| `--surface-inverse` | `#190828` | Hero, footer |
| `--surface-white` | `#FDF8F9` | Cards |

---

## File Structure

```
cvetanichin-theme/
├── style.css                    Theme declaration + base CSS
├── functions.php                Theme setup, enqueue, sidebars, nav walker
├── index.php                    Blog index / fallback
├── header.php                   Nav + site header
├── footer.php                   Footer widgets + bar
├── sidebar.php                  Sidebar widget area
├── page.php                     Default page template
├── page-consultancy.php         Domain 1 landing template
├── page-selfimprovement.php     Domain 2 landing template
├── single.php                   Single post
├── archive.php                  Post archives
├── search.php                   Search results
├── 404.php                      404 page
├── inc/
│   └── customizer.php           Customizer panel + settings
└── assets/
    ├── css/
    │   ├── tokens.css           Design system tokens
    │   ├── consultancy.css      Domain 1 theme
    │   └── selfimprovement.css  Domain 2 theme
    └── js/
        ├── main.js              Scroll reveal, nav, smooth scroll
        └── customizer.js        Live preview bindings

cvetanichin-plugins/
└── cvetanichin-widgets/
    ├── cvetanichin-widgets.php  Plugin bootstrap
    ├── assets/
    │   └── widgets.css
    └── widgets/
        ├── class-cvw-cta-widget.php
        ├── class-cvw-bio-widget.php
        ├── class-cvw-stat-widget.php
        ├── class-cvw-newsletter-widget.php
        ├── class-cvw-recent-posts-widget.php
        ├── class-cvw-product-card-widget.php
        └── class-cvw-quote-widget.php
```

---

© 2025 Cvetanichin. All rights reserved.
