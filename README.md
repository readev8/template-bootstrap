# Bootstrap v5.3.8 Template Collection

Koleksi template Bootstrap v5.3.8 dengan semua contoh resmi yang siap digunakan.

## Versi

- **Bootstrap**: v5.3.8
- **Bootstrap Icons**: v5.x
- **Node.js**: v18+

## Struktur Project

```
template-bootstrap/
├── node_modules/                    # Dependencies (npm install)
│   ├── bootstrap/                    # Bootstrap CSS & JS
│   └── bootstrap-icons/              # Bootstrap Icons
├── bootstrap-5.3.8-examples/        # Official Bootstrap examples
│   ├── album/                       # Gallery template
│   ├── blog/                        # Blog template
│   ├── carousel/                     # Carousel template
│   ├── checkout/                     # Checkout form template
│   ├── cover/                       # Landing page template
│   ├── dashboard/                   # Admin dashboard template
│   ├── features/                    # Features showcase template
│   ├── footers/                     # Footer templates
│   ├── headers/                     # Header templates
│   ├── pricing/                     # Pricing page template
│   ├── product/                     # Product page template
│   ├── sidebars/                    # Sidebar navigation templates
│   ├── sign-in/                     # Login page template
│   └── ...                          # More templates
├── pages/                           # Main pages (entry points)
│   ├── index.html                   # Homepage - Template gallery
│   ├── dashboard.html               # Dashboard page
│   ├── login.html                   # Login page
│   ├── album/                       # Album template
│   ├── blog/                        # Blog template
│   ├── carousel/                    # Carousel template
│   ├── checkout/                    # Checkout template
│   ├── cover/                       # Cover template
│   ├── pricing/                     # Pricing template
│   ├── product/                     # Product template
│   └── ...                          # All other templates
├── assets/                          # Custom assets
│   ├── css/
│   │   └── custom.css              # Custom styles
│   └── js/
│       └── custom.js               # Custom JavaScript
├── package.json                    # npm configuration
└── README.md                       # Documentation
```

## Instalasi

```bash
# Install dependencies
npm install

# Start development server (static)
npx serve pages
```

## Available Templates

### Main Pages
| Page | Description |
|------|-------------|
| `pages/index.html` | Homepage dengan gallery semua template |
| `pages/dashboard.html` | Admin dashboard dengan sidebar |
| `pages/login.html` | Sign-in form page |

### Full Templates
| Template | Description |
|----------|-------------|
| Album | Simple one-page photo gallery |
| Blog | Magazine-style blog layout |
| Carousel | Custom carousel slider |
| Checkout | Checkout form dengan validasi |
| Cover | One-page landing page |
| Dashboard | Admin dashboard shell |
| Features | Feature showcase layout |
| Footers | Footer component collection |
| Headers | Header component collection |
| Pricing | Pricing plan page |
| Product | Product marketing page |
| Sidebars | Sidebar navigation patterns |

### Components
| Template | Description |
|----------|-------------|
| Badges | Badge component examples |
| Breadcrumbs | Breadcrumb navigation |
| Buttons | Button variations |
| Dropdowns | Dropdown menus |
| List Groups | List group components |
| Modals | Modal dialog examples |
| Navbars | Navigation bar styles |

### Layouts
| Template | Description |
|----------|-------------|
| Grid | Grid system examples |
| Cheatsheet | Component kitchen sink |
| Jumbotron | Jumbotron component |

### Navigation
| Template | Description |
|----------|-------------|
| Navbar Fixed | Fixed top navbar |
| Navbar Static | Static top navbar |
| Navbar Bottom | Bottom navbar |
| Navbars | Multiple navbar styles |
| Navbars Offcanvas | Offcanvas navbar |

## Cara Penggunaan

### 1. Buka Homepage
Buka `pages/index.html` di browser untuk melihat gallery semua template.

### 2. Pilih Template
Klik tombol "View Demo" pada card template untuk melihat preview.

### 3. Edit Template
Salin template yang dibutuhkan ke folder project Anda dan customize sesuai kebutuhan.

## Dependencies

### Core
- **Bootstrap**: `^5.3.8` - CSS framework
- **Bootstrap Icons**: `^5.x` - Icon library

### External CDN (Dashboard)
- **Chart.js**: v4.3.2 - Untuk charts di dashboard

## Customization

### Custom CSS
Edit file `assets/css/custom.css` untuk menambahkan styles kustom.

### Custom JavaScript
Edit file `assets/js/custom.js` untuk menambahkan JavaScript kustom.

### Using Bootstrap Icons
```html
<link href="../node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Usage -->
<i class="bi bi-bootstrap-fill"></i>
<i class="bi bi-house-fill"></i>
<i class="bi bi-person-circle"></i>
```

## Browser Support

Bootstrap 5.3 mendukung semua browser modern:
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## Documentation

- [Bootstrap Docs](https://getbootstrap.com/docs/5.3/)
- [Bootstrap Icons](https://icons.getbootstrap.com/)
- [Bootstrap Examples](https://getbootstrap.com/docs/5.3/examples/)

## License

MIT License - Bootstrap is licensed under MIT. See [Bootstrap License](https://github.com/twbs/bootstrap/blob/main/LICENSE) for details.
