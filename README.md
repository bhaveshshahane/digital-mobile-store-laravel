# 📱 phoneKART

**phoneKART** is a modern, feature-rich e-commerce web application specifically tailored for selling mobile devices and digital accessories. Built on the robust **Laravel** framework and styled with **Tailwind CSS**, it offers a premium, responsive shopping experience for customers and a powerful management dashboard for administrators.

---

## 🌟 Key Features

### For Customers
- **Modern UI/UX:** A stunning, fully responsive storefront built with Tailwind CSS, featuring smooth hover effects, interactive components, and premium color gradients.
- **Secure Authentication:** Complete user login and registration system with built-in email verification to ensure account security.
- **Product Discovery:** Browse the latest mobile phones, filter by category and price, and read detailed product descriptions rendered beautifully with rich HTML.
- **Smart Shopping Cart:** AJAX-powered cart that validates product stock in real-time. Prevents you from adding more items than what's available.
- **Flexible Checkout:** Support for both **Cash on Delivery (COD)** and **Online Payments**.
- **Customer Dashboard:** A dedicated space for users to track their order history and manage their profile.
- **Review System:** Logged-in users can leave 1-to-5 star ratings and comments on products they've purchased. Includes anti-spam logic to prevent duplicate reviews.
- **Share Capability:** Native one-click copy-to-clipboard functionality to easily share products with friends.
- **Email Receipts:** Beautiful, mobile-friendly HTML email confirmations sent automatically upon successful checkout.

### For Administrators
- **Secure Admin Panel:** Protected by dedicated admin authentication middleware.
- **Analytics Dashboard:** A comprehensive overview featuring a dynamic sales chart (using Chart.js), total user counts, revenue metrics, and low-stock alerts.
- **Advanced Data Management:** "Orders," "Users," "Enquiries," and "Reviews" are managed using powerful, high-performance DataTables (v1.13.6) allowing instant search, sorting, and pagination.
- **Product Management:** Create and edit products with ease. Features an integrated **TinyMCE** rich-text editor for crafting engaging product descriptions.
- **Inventory Control:** Automatic stock deduction when orders are placed, with visual "Out of Stock" alerts pushed directly to the dashboard.

---

## 🛠️ Technology Stack

- **Backend Framework:** Laravel 12 (PHP)
- **Frontend Styling:** Tailwind CSS
- **Database:** MySQL
- **Javascript Libraries:** 
  - jQuery (AJAX handling)
  - DataTables.js (Admin tables)
  - Chart.js (Dashboard analytics)
  - Toastr.js (Non-intrusive notifications)
  - TinyMCE (Rich text editing)

---

## 🚀 Getting Started

### Prerequisites
- PHP >= 8.2
- Composer
- MySQL Database
- Node.js & NPM (for Tailwind asset compilation)

### Installation Steps

1. **Clone the repository** (if applicable) and navigate to the project directory:
   ```bash
   cd digital-mobile-store-laravel
   ```

2. **Install PHP Dependencies:**
   ```bash
   composer install
   ```

3. **Install Frontend Dependencies:**
   ```bash
   npm install
   ```

4. **Environment Configuration:**
   Copy the `.env.example` file to `.env` and configure your database and mail server credentials:
   ```bash
   cp .env.example .env
   ```
   *Make sure to update `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, and your `MAIL_*` settings.*

5. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

6. **Run Database Migrations & Seeders:**
   This will create the necessary tables and populate the database with an initial Admin user and some default data.
   ```bash
   php artisan migrate --seed
   ```

7. **Compile Assets:**
   Build the Tailwind CSS files.
   ```bash
   npm run build
   ```

8. **Start the Local Server:**
   ```bash
   php artisan serve
   ```

You can now visit `http://localhost:8000` in your browser to view the application!

---

## 🔐 Default Credentials

If you ran the database seeders, you can access the admin panel using:
- **Email:** `admin@example.com`
- **Password:** `password`

*(Please change this immediately in a production environment!)*
