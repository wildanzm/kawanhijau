# KawanHijau 🌱

**KawanHijau** is an integrated digital platform designed to empower Indonesian farmers. It combines an **AI-powered plant disease detection system** with a **direct-to-consumer marketplace**, bridging the gap between advanced agricultural technology and practical supply chain solutions.

## 📖 About the Project

Agriculture faces two major challenges: unpredictable crop diseases and inefficient supply chains. **KawanHijau** solves this by:
1.  Providing farmers with an instant "Digital Plant Doctor" using Computer Vision (YOLOv8) to detect diseases early.
2.  Cutting out middlemen by allowing farmers to sell produce directly to consumers via a dedicated marketplace.

## ✨ Key Features

### 🌾 For Farmers
-   **AI Disease Detection:** Upload leaf photos to get instant diagnosis and treatment recommendations.
-   **Farm Management Dashboard:** Track products, sales, and farming history.
-   **Product Listing:** Manage stock, prices, and product descriptions easily.

### 🛒 For Consumers
-   **Marketplace:** Browse fresh produce directly from local farmers.
-   **Shopping Cart & Checkout:** Seamless ordering experience.
-   **Order Tracking:** Monitor order status from processing to completion.

### 🛡️ Security & Core
-   **Multi-Role Authentication:** Secure login for Admins, Farmers, and Users.
-   **Two-Factor Authentication (2FA):** Enhanced account security via Fortify.
-   **Role-Based Access Control (RBAC):** Strict permission management.

## 🛠 Tech Stack

### Backend & Frontend (Monolith)
| Component | Technology | Description |
| :--- | :--- | :--- |
| **Framework** | **Laravel 12** | Core application logic and routing. |
| **Interactivity** | **Livewire 3** | Dynamic interfaces without complex JS builds. |
| **Styling** | **Tailwind CSS** | Utility-first CSS framework. |
| **Database** | **MySQL** | Relational database management. |

### Artificial Intelligence (Microservice)
| Component | Technology | Description |
| :--- | :--- | :--- |
| **Language** | **Python 3** | AI backend logic. |
| **Framework** | **Flask** | Lightweight WSGI web application framework. |
| **Model** | **YOLO (PyTorch)** | Object detection model (`best.pt`) for disease recognition. |
| **Libraries** | **OpenCV, Ultralytics** | Image processing and inference. |

## 🏗 System Architecture

The system operates as a **Hybrid Architecture**:
1.  **Main App:** The Laravel application handles 90% of the logic (Auth, DB, Views).
2.  **AI Service:** When a user uploads an image for detection, Laravel sends an HTTP request to the local Python Flask server running the AI model. The Flask server returns the prediction (JSON), and Laravel displays it.

## ⚙ Prerequisites

Before beginning, ensure you have met the following requirements:

* **PHP** >= 8.2
* **Composer** (PHP Dependency Manager)
* **Node.js** & **NPM** (for frontend assets)
* **Python** >= 3.9
* **MySQL** Server

## 🚀 Installation Guide

Clone the repository:

```bash
git clone [https://github.com/username/kawanhijau.git](https://github.com/username/kawanhijau.git)
cd kawanhijau

```

### 1. Web Application (Laravel)

Navigate to the application folder:

```bash
cd application

```

Install PHP and Node dependencies:

```bash
composer install
npm install

```

Configure Environment:

```bash
cp .env.example .env

```

*Open `.env` and update your database credentials (`DB_DATABASE`, `DB_USERNAME`, etc.).*

Generate Application Key:

```bash
php artisan key:generate

```

Run Migrations and Seeders:

```bash
php artisan migrate --seed

```

*(This will create the database structure and default users/roles).*

Build Frontend Assets:

```bash
npm run build

```

### 2. AI Service (Python)

Open a **new terminal** and navigate to the machine learning folder:

```bash
cd machine-learning

```

Create a Virtual Environment (Recommended):

```bash
# Windows
python -m venv venv
venv\Scripts\activate

# Mac/Linux
python3 -m venv venv
source venv/bin/activate

```

Install Python Dependencies:

```bash
pip install -r requirements.txt

```

---

## ▶ Running the Application

To run the full system, you need **two terminals** running simultaneously.

**Terminal 1: Laravel Server**

```bash
cd application
php artisan serve
# Accessible at [http://127.0.0.1:8000](http://127.0.0.1:8000)

```

**Terminal 2: Flask AI Server**

```bash
cd machine-learning
python app.py
# Accessible at [http://127.0.0.1:5000](http://127.0.0.1:5000) (Ensure this port matches your Laravel config)

```

Now, open your browser and go to `http://127.0.0.1:8000`.

---

## 📝 License

Distributed under the **MIT License**. See `LICENSE` for more information.


*Built with ❤️ for Indonesian Agriculture.*
