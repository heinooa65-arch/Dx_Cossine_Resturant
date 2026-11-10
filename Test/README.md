# Olive & Ember — HTML, PHP, MySQL

This deploy-ready copy keeps the public homepage in **`public/index.html`**. It loads the menu from a local PHP JSON endpoint and uses a bundled offline catalog; it does not need MealDB or another meal API.

## What is in the catalog

The catalog contains more than 100 entries: European classics, Myanmar traditional dishes, desserts, and drinks. It includes example MMK prices, short descriptions, and one distinct Wikimedia Commons photo per seeded item. Use **Menu photo credits** in the footer for the source, creator, and license page. Prices and photos can be changed from the admin menu editor; the site does not call a meal or image API.

## Project layout

```text
Test/
├── Caddyfile
├── Dockerfile
├── database.sql
├── vercel.json
└── public/
    ├── index.html             # Public HTML home page
    ├── api/menu.php           # Reads the curated menu from MySQL
    ├── admin/                 # Admin and kitchen-staff pages
    ├── assets/                # CSS and JavaScript
    ├── includes/menu_catalog.php
    ├── includes/menu_images.php
    └── *.php                  # Customer pages, reservations, checkout, tracking
```

## Run locally with XAMPP

1. Copy the contents of `Test/public` into `C:\xampp\htdocs\RestaurantTest`.
2. Start **Apache** and **MySQL** in XAMPP Control Panel.
3. In phpMyAdmin, create a database named `restaurant_db`, select it, choose **Import**, and import `Test/database.sql`.
4. Visit `http://localhost/RestaurantTest/setup.php` and run setup once. It creates staff accounts, starter tables and settings, and the complete offline menu.
5. Open `http://localhost/RestaurantTest/`.

Sample accounts: `admin@olive.local` and `staff@olive.local`; both start with password `Olive123!`. Change these after signing in, then delete or rename `setup.php`.

If the database already exists, sign in as admin and open `admin/import-menu.php` to import or refresh the offline catalog. The importer is safe to run more than once and preserves items marked unavailable.

## Publish to GitHub without terminal commands

1. Open GitHub Desktop and sign in.
2. Choose **File → Add Local Repository** and select this `Test` folder. If it is not a repository yet, choose the option to create one there.
3. Click **Publish repository**. Keep it private while configuring the database; `.gitignore` excludes `.env` files.
4. To publish future edits, commit them in GitHub Desktop and click **Push origin**.

## Deploy to Vercel

This copy uses Vercel's Container deployment with FrankenPHP so the existing PHP pages run together behind the `index.html` homepage. Vercel's current PHP guide documents this Docker path; it avoids relying on the archived `vercel-php` community runtime. [Vercel PHP container guide](https://vercel.com/kb/guide/deploy-php-on-vercel-with-docker)

1. Create a **remote MySQL database** with a provider that accepts connections from Vercel. Your computer's XAMPP database is only local and cannot be used by the live site.
2. Create/select the database and import `Test/database.sql` into it.
3. Publish `Test` to GitHub, or publish the restaurant parent folder containing `Test`.
4. In Vercel, import that GitHub repository. If you imported the parent folder, set **Root Directory** to `Test`; if `Test` is the repo itself, keep the repo root.
5. Keep `Dockerfile`, `Caddyfile`, and `vercel.json` at the selected root. Vercel builds the container.
6. In Vercel **Project Settings → Environment Variables**, add these variables for Production (and Preview if desired):

   | Variable | Value |
   | --- | --- |
   | `DB_HOST` | Hostname from your MySQL provider |
   | `DB_PORT` | MySQL port, usually `3306` |
   | `DB_NAME` | Database/schema name |
   | `DB_USER` | Database username |
   | `DB_PASS` | Database password |
   | `APP_TIMEZONE` | `Asia/Yangon` |

7. Deploy. Open `/setup.php` once to seed sample accounts and the offline menu. Then remove `public/setup.php` from the project and push that change so the installer is no longer publicly available.
8. Sign in at `/login.php` and change the sample passwords.

The `app_sessions` table stores PHP sessions in MySQL so customer and staff logins can continue across container instances. The external database must allow the app to connect and have suitable connection limits for your Vercel plan. The Vercel container runtime has its own current availability and pricing; review Vercel's deployment guide before choosing it.

## Traditional PHP/MySQL hosting

For the simplest PHP deployment, use hosting that supports PHP 8.1+ and MySQL/MariaDB. Upload the contents of `public` to the host's web root, import `database.sql`, and set `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, and `DB_PASS` in `public/config.php` or the host's environment settings. Run setup once, change the sample passwords, then remove `setup.php`.

## Security and data notes

- Never commit a real `.env` file or production database password.
- Change the sample staff passwords before sharing the live site.
- Remove `public/setup.php` after initial setup.
- Menu photos are remote Wikimedia Commons links; live pages need internet access to display them. The footer links to a photo credit page with each image's source and license details.
- MMK prices are starter examples. Adjust them to match your actual menu and costs.
