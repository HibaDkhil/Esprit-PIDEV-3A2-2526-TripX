# TripX (Symfony) — Travel & Leisure Management Web Application

## Overview
TripX is a Symfony web application that provides travel offers, destinations, accommodations, and transport services, with an integrated blog module where users can interact and share content.

This project was developed as part of the **PIDEV** program at **Esprit School of Engineering – Tunisia** (Academic Year **2025–2026**).

## Features
- Travel offers management (destinations, accommodations, transport)
- Community blog module (user interaction and content)
- Admin dashboard for platform management
- Payments integration (Stripe) *(if implemented in this version)*
- Recommendation/AI modules *(if implemented in this version)*

## Tech Stack

### Frontend
- Twig
- HTML
- CSS
- JavaScript *(if used)*
- Bootstrap *(if used)*

### Backend
- PHP
- Symfony
- Doctrine ORM *(if used)*

### Database
- MySQL (phpMyAdmin / XAMPP)

## Architecture
- Symfony MVC (Controllers, Services, Templates)
- Doctrine entities + repositories
- Twig templates for UI

> Tip: Add a simple diagram or a short “Modules” list (Offers / Transport / Blog / Payments / Admin).

## Contributors
- Hiba Dkhil (@HibaDkhil)
- Seifeddine Meddeb (@SeifMeddebb)
- Raghed Selmi (@raghed1)
- Fatma Mdaghi (@fatmamdaghi)
- Nour Mourali (@Nour-Mourali)
- Islem Medfai (@Islem-medfai)

## Academic Context
Developed at **Esprit School of Engineering – Tunisia**  
PIDEV — International Class — 3A2 | Academic Year 2025–2026

## Getting Started

### Prerequisites
- PHP 8.1+ (or the version required by your Symfony version)
- Composer
- Symfony CLI *(recommended)*
- MySQL + phpMyAdmin (XAMPP)

### Setup
1. Clone the repository:
   ```bash
   git clone https://github.com/HibaDkhil/Esprit-PIDEV-3A2-2026-TripX-Symfony.git
   ```
2. Install dependencies:
   ```bash
   composer install
   ```
3. Configure environment variables:
   - Copy `.env` to `.env.local` (or edit `.env.local`)
   - Set your database URL (example):
     ```text
     DATABASE_URL="mysql://root:@127.0.0.1:3306/tripx?serverVersion=8.0"
     ```
4. Create database + run migrations:
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```
5. Start the server:
   ```bash
   symfony serve
   ```
   or
   ```bash
   php -S localhost:8000 -t public
   ```
6. Open the app:
   - http://localhost:8000

## Acknowledgments
- **Esprit School of Engineering** for the academic and technical environment.
- Symfony, Doctrine, Twig, and other open-source dependencies.
