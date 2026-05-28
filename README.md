# Udemy Clone Project (Laravel 12 + Blade)

---

## Project Summary

This repository is a polished online learning marketplace built on Laravel 12, Blade templates, AlpineJS and Tailwind CSS. It is a complete production-grade application that showcases a modern SaaS-style course platform with:

- full **student**, **instructor**, and **admin** workflows
- **Stripe checkout**, **Stripe Connect**, and webhook-based enrollment processing
- **Google OAuth** login and email verification
- advanced course management, search, progress tracking, certificates, and more

This starter kit is perfect for recruiters or product owners who want to see a real-world, production-oriented Blade application built using Laravel best practices.

---

## Why this project stands out

- Designed to feel like a real learning marketplace, not a toy demo.
- Uses a clean, maintainable architecture: controller resources, service classes, middleware, policies and reusable form requests.
- Supports multiple user journeys: customer purchase flow, instructor onboarding, and admin moderation.
- Built with modern Laravel tooling: Vite, Tailwind v4, AlpineJS, Cashier, Scout, Socialite, and Spatie packages.

---

## Core Features

### Student Experience

- Course discovery with search and category filtering
- Course detail pages with preview lessons, instructor info, ratings, and enrollment checks
- Add to cart, wishlist, coupon application, and checkout flow
- Stripe payment integration with order processing and automatic enrollment
- My Learning dashboard with lesson progress tracking
- Downloadable certificates after course completion
- Course reviews, discussion threads, and student notifications

### Instructor Experience

- Instructor dashboard and protected instructor routes
- Stripe Connect onboarding for instructor payouts
- Course creation and lesson management
- Discussion management and instructor replies
- Course statistics surfaced in instructor views

### Admin Experience

- Admin dashboard with role-based access control
- Full CRUD for users, courses, lessons, enrollments, reviews, certificates, categories, coupons, contacts, and newsletters
- Role and permission management using Spatie Permission
- Course import and export using Maatwebsite Excel
- Newsletter subscription management and contact response workflow

### Authentication & Account Management

- Laravel authentication scaffolding with registration, login, logout
- Email verification and password reset flow
- Google OAuth login via Laravel Socialite
- Profile settings, password updates, and appearance preferences

### Platform Essentials

- Stripe webhook handler for secure payment status updates
- Course progress completion and lesson tracking
- Cart and wishlist persistence per user
- Cache-optimized home page queries for top categories, instructors, and courses
- Soft deletes, searchable models, and media-rich course pages

---

## Technology Stack

- PHP 8.2
- Laravel 12
- Blade Templates
- AlpineJS
- Tailwind CSS v4
- Vite
- MySQL / SQLite compatible

### Packages and integrations

- `laravel/cashier` — Stripe checkout plus billing/webhook handling
- `laravel/socialite` — Google OAuth login
- `laravel/scout` + `typesense/typesense-php` — course search and indexing
- `spatie/permission` — role and permission management
- `spatie/laravel-medialibrary` — image/video/media uploads and responsive handling
- `maatwebsite/excel` — import and export course data
- `spatie/laravel-pdf`, `spatie/browsershot`, `pbmedia/laravel-ffmpeg` — rich content generation and media handling
- `owenvoke/blade-fontawesome`, `blade-ui-kit/blade-icons` — iconography and UI components
- `alpinejs` — lightweight interactivity

---

## Architecture & Design

- Uses RESTful resource controllers for admin CRUD operations
- Applies route grouping, middleware, and named routes for clean navigation
- Employs service classes for business logic separation (`CourseService`, `ContactService`, `StripeConnectService`, etc.)
- Uses model scopes and relationships to keep controllers focused on HTTP behavior
- Produces reusable UI patterns with Blade components and partials
- Includes a scalable course data model with sections, lessons, reviews, enrollments, and certificates

---

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev
```

> If you are using Windows PowerShell, replace `cp` with `copy`.

### Recommended local startup

```bash
npm run dev
php artisan serve
```

---

## Useful commands

- `composer install` — install PHP dependencies
- `npm install` — install frontend dependencies
- `php artisan migrate` — run database migrations
- `php artisan db:seed` — seed demo data if available
- `npm run dev` — start Vite development mode
- `npm run build` — build production assets
- `php artisan test --compact` — run the test suite

---

## What a recruiter should notice

- A robust multi-role application built without Vue/React or Livewire
- Complete payment workflow with Stripe checkout and webhook reconciliation
- Admin, instructor, and student interfaces that mirror real SaaS products
- Strong package selection that demonstrates modern Laravel craftsmanship
- Scalable course marketplace architecture ready for extension

---

## Screenshots

![](./screenshots/Screenshot%202026-05-28%20161141.png)

---

## License

This starter kit is open sourced under the MIT License.
