# 🛠️ Shop Backup Application

This Laravel application is designed to fetch product data from an external API and store it in a backup database. It uses Docker for containerized development and deployment.

---

## 📦 Application Setup Guide

Follow the steps below to set up and run the application using Docker.

---

### ✅ 1. Build Docker Containers

```bash
docker-compose build
```

This command will build all the necessary containers defined in the `docker-compose.yml` file.

---

### 🚀 2. Start the Application

```bash
docker-compose up
```

This starts all containers and runs the application locally.

---

### 🔧 3. Access the Container and Run Migrations

Enter the running application container:

```bash
docker exec -it shop_backup-app-1 bash
```

Then run the database migrations:

```bash
php artisan migrate:fresh
```

Once done, exit the container:

```bash
exit
```

---

### 📥 4. Fetch and Store API Product Data

To fetch product data from the external API and store it in the backup database, run the following Artisan command:

```bash
php artisan app:backup-products
```

---

### 🌐 5. View the Local Application

You can access the application in your browser via:

```
http://localhost:8083/
```

---

### 🧹 6. Clear Backup Data (Optional)

To remove all stored product data from the backup database, run:

```bash
php artisan app:clear-shop-data
```

This will delete all products, variants, and related images from the database.

---

## ✅ You're All Set!

Your backup application is now running and storing product data from the API. Use the optional command to reset your data when needed.