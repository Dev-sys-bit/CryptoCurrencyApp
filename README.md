# Laravel Cryptocurrency Newsletter Application


### **📌 Project Description**

This project is a Laravel-based web application designed to allow users to sign up for a **cryptocurrency price newsletter**, sent at customizable intervals (minute, hourly, or daily). The app utilizes Laravel’s robust **routing**, **validation**, **ORM (Eloquent)**, **task scheduling**, and **HTTP client** capabilities to create, send, and manage user-subscribed newsletters based on real-time crypto market data.

### **🛠 Key Features**

#### **1. User Signup Interface**

* Accessed via: `http://localhost:8000/signup`
* Professional-looking form styled using Bootstrap 5 (with credits).
* Inputs include:

  * Name (required)
  * Email address (required and validated)
  * Frequency (every minute, hourly, or daily at midnight)
  * Cryptocurrency ticker selection (at least 10 options like BTC, ETH, DOGE)
  * Percentage Change Alert (numeric value > 1, required)

#### **2. Form Validation**

* Implemented **entirely in Laravel** using the `validate()` method in the controller.
* No HTML input type restrictions—pure text fields with server-side validation.
* Form memory and error feedback on submission failure.

#### **3. Email Newsletter Delivery**

* Emails sent via **Mailgun API integration**.
* Users receive cryptocurrency updates based on selected tickers.
* Uses the **Coinlore API** to fetch current prices and 1-hour change data.
* Dynamic table formatting in the email:

  * **Green background** for positive changes above user’s alert threshold.
  * **Red background** for negative changes beyond alert threshold.

#### **4. Background Task Scheduling**

* Laravel's `schedule:work` is used to run newsletter jobs at set frequencies.
* Scheduler selects eligible users and generates live crypto data at send time.

#### **5. Unsubscribe Functionality**

* Users can unsubscribe via a unique link included in each email.
* Clicking the link removes their record from the database and confirms the action with a success message (`localhost:8000/unsubscribe`).

#### **6. Clean Code and Styling**

* Organized MVC architecture using Laravel conventions.
* Styling powered by Bootstrap (v5) for responsive and modern UI.
* Clean separation of logic, views, and email templates.

---

### **🎥 Demo Video Overview**

A 10-minute video demonstrates:

* Successful and failed signup with validation.
* Backend logic and database integration.
* Newsletter email example sent to user.
* Unsubscribe process and confirmation.
* Cron simulation with `php artisan schedule:work`.

---

### **🔧 Technologies Used**

* Laravel 10+
* PHP 8.x
* MySQL
* Bootstrap 5 ([https://getbootstrap.com/](https://getbootstrap.com/))
* Coinlore API ([https://www.coinlore.com/cryptocurrency-data-api](https://www.coinlore.com/cryptocurrency-data-api))
* Mailgun for transactional email
* Laravel Scheduler and HTTP Client

---

