# Dx_CosSine — Restaurant Reservations & Online Ordering

A small restaurant website built with HTML, CSS, JavaScript, PHP, and MySQL. It is designed to run locally with XAMPP on Windows. No terminal or PowerShell commands are needed to start Apache or MySQL.

## Run it with XAMPP

1. Install and open **XAMPP Control Panel**.
2. Put this project folder in XAMPP's web root, normally `C:\xampp\htdocs\Resturant`. If the folder is currently on your Desktop, copy the whole `Resturant` folder into `C:\xampp\htdocs\`.
3. In XAMPP Control Panel, click **Start** beside **Apache**, then click **Start** beside **MySQL**. Wait until both rows show that they are running.
4. Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin) in your browser. Choose **Import**, select the project's `database.sql` file, and click **Import** or **Go**. The script creates the `restaurant_db` database and its tables.
5. Visit [http://localhost/Resturant/setup.php](http://localhost/Resturant/setup.php) once and click **Run setup**. This creates sample staff accounts, settings, ten dining tables, and the complete offline European and Myanmar menu.
6. Sign in using one of the sample accounts below. Delete or rename `setup.php` after setup.

If you use a different folder name, use that name in the `localhost` URL. If your MySQL root account has a password, set it in the `DB_PASS` line near the top of `config.php` before opening the website.

## Sample staff access

| Role | Email | Password |
| --- | --- | --- |
| Admin | `admin@dxcossine.local` | `Dx_CosSine!2026` |
| Kitchen staff | `staff@dxcossine.local` | `Dx_CosSine!2026` |

Change both sample passwords after signing in. On an older database, setup renames the original sample accounts and changes their password if they still use the old default; otherwise, it creates the new Dx_CosSine accounts without overwriting your changed password. New customer accounts are created from **Join us**. Admins can create additional admin and kitchen staff accounts from **Staff desk → Team accounts**. Roles are stored on `users.role`: `admin`, `staff`, or `customer`. Staff accounts land on the order board and can only move orders forward.

## What is included

### Customers

- Register, sign in, and update a profile with a saved delivery address.
- Browse available items by category, search, and add items to a JavaScript cart.
- Change quantities or remove cart items; the browser keeps the cart in `localStorage` until PHP successfully saves the order.
- Place delivery orders. PHP reloads current menu prices and availability from MySQL, calculates the total on the server, and saves a price snapshot on every order line.
- Track the order in the customer view, which refreshes from a PHP JSON endpoint every 15 seconds.
- See order history and reorder items that are still available.
- Request a table for a date, time, and party size. PHP checks opening hours, closed weekdays, seat capacity, and table availability before saving a pending request.

### Admin and kitchen staff

- Admin dashboard: today's approved reservations, today's and month-to-date delivered revenue, order counts by status, and five popular dishes from the past 30 days.
- Menu categories and menu item creation, including photo, description, price, and availability. Unavailable dishes disappear from the customer menu.
- Dining tables with seat counts and active/inactive state.
- Pending reservation review with table assignment, approve, and reject actions.
- Kitchen order board: **New → Preparing → Ready → Delivered**. The customer's tracking view reads the same current status.
- Opening hours, closed weekdays, and delivery fee settings.
- Date range sales report with CSV export.
- Admin-only team account page for adding more admin and kitchen staff logins.

## Database tables

`users`, `categories`, `menu_items`, `restaurant_tables`, `reservations`, `orders`, `order_items`, `settings`, `app_sessions`, `notifications`, and `coupons`.

`order_items.price_at_order` and `line_total` are snapshots. Updating a menu item's price later does not change an existing order. Checkout never accepts the browser's item price or a browser-calculated total as authoritative.

## File map

- `index.php` — public landing page and live menu.
- `setup.php` — one-time sample data and staff account setup.
- `admin/index.php` — staff order board and admin workspace.
- `admin/index.php?tab=accounts` — admin-only staff/admin account creation and team list.
- `database.sql` — database and table definitions.
- `config.php` — XAMPP database connection settings.
- `assets/css/style.css`, `assets/js/app.js` — responsive styles and cart/menu interactions.
- `api/order-status.php` — authenticated order status response used by `fetch`.
- `api/reorder.php` — authenticated order history reorder data.

## Upload this Resturant folder to GitHub

The repository to upload is the main folder at `C:\Users\LENOVO\Desktop\Resturant`—the folder containing this README, `config.php`, `database.sql`, `setup.php`, and the root `Dockerfile`. The separate `Test` copy is excluded from the main repository.

1. Install and open [GitHub Desktop](https://desktop.github.com/) and sign in.
2. Choose **File → Add Local Repository** and select `C:\Users\LENOVO\Desktop\Resturant` (select the main folder, not `Test`).
3. If it is not a repository yet, choose GitHub Desktop's option to create one in this folder. Keep the existing `.gitignore` file.
4. Click **Publish repository**, use a name such as `dx-cossine-restaurant`, and choose public or private visibility.
5. To publish future edits, enter a summary, click **Commit to main**, then click **Push origin**.

To add these files to a GitHub repository that already exists, choose **File → Clone Repository**, clone it, copy the contents of this `Resturant` folder into the cloned repository's root, then commit and push in GitHub Desktop.

### Fix a GitHub 404

- If the repository page itself returns 404, check the owner and repository name in the address bar, or sign in with an account that can access the private repository. Opening the repository from your GitHub profile confirms its exact URL.
- GitHub Pages only serves static sites. This app uses PHP and MySQL, so Pages cannot run its login, ordering, reservation, or admin features. The real app entry is `index.php`; login is `login.php`. A static `index.html` would not make PHP work, so this folder does not need one. See [GitHub's Pages setup](https://docs.github.com/en/pages/getting-started-with-github-pages/creating-a-github-pages-site) and [404 guide](https://docs.github.com/en/pages/getting-started-with-github-pages/troubleshooting-404-errors-for-github-pages-sites).

## Deploy this folder to Vercel

The root `Dockerfile`, `Caddyfile`, and `vercel.json` run this PHP app in a container. Vercel needs an external MySQL database; the database running in XAMPP on your computer is local only. See Vercel's [PHP container deployment guide](https://vercel.com/kb/guide/deploy-php-on-vercel-with-docker).

1. Create a hosted MySQL database and import this folder's `database.sql` into it.
2. In Vercel, choose **Add New → Project** and import the GitHub repository you published above. Keep **Root Directory** at the repository root.
3. In **Project Settings → Environment Variables**, add `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS`, and `APP_TIMEZONE` (use `Asia/Yangon` for the last value).
4. Deploy. Open `/setup.php` once to create the Dx_CosSine sample accounts and menu. Then delete `setup.php` from the project and push that change to GitHub.
5. Sign in at `/login.php`, change the sample passwords, and use **Staff desk → Team accounts** to add any other staff/admin logins.

GitHub holds the source code; GitHub Pages is not a PHP host. Use the Vercel deployment above or a PHP/MySQL web host to run the site.

## Troubleshooting

- **Apache or MySQL does not start:** use the XAMPP Control Panel to inspect the module's error log. Another local service may already be using its port.
- **Database connection error:** confirm MySQL is running, that `database.sql` imported successfully, and that `config.php` has the right host, database name, username, and password.
- **Blank or raw PHP page:** open the site through `http://localhost/Resturant/`; do not open the `.php` file directly from File Explorer. Confirm Apache is running.
- **Refresh the corrected menu photos:** sign in as admin, open Menu, and choose **Import the 100+ offline dishes and drinks**. This updates seeded menu rows with distinct Commons images while keeping order history intact.
- **PHP extensions:** XAMPP's standard PHP build includes PDO MySQL. If it is disabled, enable `pdo_mysql` in XAMPP's `php.ini` and restart Apache.

## Menu photos and prices

The starter catalog is bundled locally and does not depend on the MealDB API. Each seeded dish or drink has its own Wikimedia Commons image. Use **Menu photo credits** in the site footer to open the source page, which shows the creator and license. Example prices are in MMK and can be edited in the admin menu screen.
