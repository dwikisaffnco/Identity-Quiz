# SAFF & Co. — Identity Quiz 2026

A simple Laravel application for running the **SAFF & Co. Identity Quiz 2026** with:

-   Public quiz page for guests
-   Result scoring and recommendation logic in JavaScript
-   Persistent storage of quiz responses in MySQL
-   Admin dashboard to review, edit, and delete results
-   Export tools for **CSV** and **Google Sheets**

Built on Laravel, but this README focuses on how to use this specific quiz system.

---

## Features

-   **Public Quiz**

    -   Single landing page at `/` showing 6 questions (Q1–Q6).
    -   Client-side scoring to determine category **A–E** with title and description.
    -   Recommended SKUs and rolling percentages calculated in `public/js/script.js`.
    -   After submit, result is saved to the database via `/quiz/submit`.

-   **Result Storage**

    -   Quiz submissions are saved into `quiz_results` table.
    -   If a user is authenticated when submitting, the result is linked to that user.

-   **Admin Area**

    -   Protected under `/admin` using `EnsureAdmin` middleware.
    -   If not logged in, any `/admin` route redirects to `/login`.
    -   Non-admin authenticated users get HTTP 403.
    -   Dashboard (`/admin/quiz-results`) shows:
        -   Total responses
        -   Paginated list of results
        -   Links to **view**, **edit**, and **delete** individual results

-   **Exports (Dashboard only)**

    -   `Export to CSV` — downloads all results as CSV via `admin.quiz_results.export`.
    -   `Send to Google Sheets` — sends all results to a Google Apps Script endpoint for real-time insertion into a Google Sheet.
    -   These buttons are **only visible on the admin dashboard**, not on the public quiz page.

-   **Authentication**
    -   Email/password login at `/login`.
    -   Registration at `/register` (new users are non-admin by default).
    -   Password reset flow (`/forgot-password`, `/reset-password/...`).

---

## Tech Stack

-   **Backend**: Laravel (PHP 8+)
-   **Frontend**: Blade views + vanilla JavaScript + SweetAlert2
-   **Database**: MySQL
-   **Container (optional)**: Docker + docker-compose

Key custom files:

-   `resources/views/quiz.blade.php` — public quiz UI
-   `public/js/script.js` — scoring + client logic + quiz submit
-   `app/Http/Controllers/Admin/QuizResultController.php` — admin & export logic
-   `resources/views/admin/dashboard.blade.php` — admin dashboard UI
-   `app/Http/Middleware/EnsureAdmin.php` — admin gate

---

## Running Locally (Without Docker)

1. **Install dependencies**

    ```bash
    composer install
    npm install # if you later add any front-end tooling
    ```

2. **Create `.env`**

    ```bash
    cp .env.example .env
    ```

    Update database and app settings as needed (DB name, user, password, etc.).

3. **Generate key & migrate**

    ```bash
    php artisan key:generate
    php artisan migrate
    ```

4. **Run dev server**

    ```bash
    php artisan serve
    ```

    - Public quiz: `http://127.0.0.1:8000/`
    - Login: `http://127.0.0.1:8000/login`
    - Admin dashboard: `http://127.0.0.1:8000/admin` (redirects to login if not logged in).

---

## Docker Setup

This repo includes a simple Docker setup for running the app and MySQL.

### Files

-   `docker.compose.yml` — defines `app` (PHP + Apache) and `db` (MySQL 8.3) services.
-   `dockerfile` — builds the PHP 8.3 Apache image, installs PHP extensions, and runs Composer install.
-   `docker/apache/vhost.conf` — Apache vhost pointing to `/var/www/html/public` with `AllowOverride All`.

### Start via Docker

1. Build and start containers:

    ```bash
    docker compose -f docker.compose.yml up -d --build
    ```

2. Access the app:

    - App: `http://127.0.0.1:2025/` (proxied to Apache inside the `app` container).

3. Database connection (from Laravel):

    - Host: `db`
    - Port: `3306`
    - Database: `form_db`
    - Username: `root`
    - Password: `rootpass`

Make sure `.env` DB settings match the above when using Docker.

---

## Admin & Authorization

-   Users are stored in the default `users` table.
-   Each user has an `is_admin` flag.
-   `EnsureAdmin` middleware logic:
    -   If not authenticated → redirect to `login` route.
    -   If authenticated but `is_admin !== true` → abort with 403.
    -   If admin → access granted.

To create an admin quickly, you can manually update `is_admin` to `1` in the database for a user.

---

## Export to CSV and Google Sheets

### CSV Export

-   Dashboard button **Export to CSV** calls:
    -   Route: `admin.quiz_results.export` (`GET /admin/quiz-results/export`)
    -   Controller: `QuizResultController@export`
    -   Returns a streaming CSV download of all quiz results.

### Google Sheets Export

-   Dashboard button **Send to Google Sheets** calls:
    -   Route: `admin.quiz_results.export_sheets` (`POST /admin/quiz-results/export-sheets`)
    -   Controller: `QuizResultController@exportToSheets`
    -   Loops through all quiz results and POSTs JSON payloads to a Google Apps Script URL.

The same Apps Script URL is also used on the client side for sending a **single** result (legacy function `sendToGoogleSheets()` in `public/js/script.js`), but the quiz UI no longer exposes export buttons to guests.

> **Security note:** Do not expose the Apps Script URL publicly if you treat the sheet as sensitive data. Consider restricting or rotating the script if necessary.

---

## Quiz Flow Overview

1. Guest opens `/` and fills out Q1–Q6.
2. `calculateResult()` in `public/js/script.js` computes category scores and the final category (A–E).
3. Result is shown in a SweetAlert modal with description and SKU recommendations.
4. Client posts the data to `/quiz/submit` (JSON) with CSRF token.
5. Laravel saves the result in `quiz_results` table and returns `{ ok: true, id: ... }`.
6. User sees a simple thank-you screen with an option to **submit another response**.

All export controls are handled only in the admin dashboard.

---

## License

This project is based on Laravel, which is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
