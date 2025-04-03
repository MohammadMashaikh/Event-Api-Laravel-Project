# 🎟️ Event Management RESTful API

## 📌 Overview
This project is a **RESTful API** built with Laravel for managing events and attendees. It features **authentication using Laravel Sanctum**, **authorization via Gates and Policies**, and **scheduled notifications** for event attendees. The API is fully tested with **Postman**.

---

## 🚀 Features
✅ **Event Management**: Create, update, show, delete, and list all events.  
✅ **Attendee Management**: Register, update, show, delete, and list attendees.  
✅ **Secure Authentication**: Token-based authentication using **Laravel Sanctum**.  
✅ **Role-Based Access**: Authorization with **Gates and Policies**.  
✅ **Event Scheduling**: Automatic notifications for upcoming events.  
✅ **Postman Testing**: Fully tested with Postman for API requests.  

---

## 🔧 Installation & Setup

1️⃣ **Clone the repository** 📂:
   ```sh
   git clone https://github.com/MohammadMashaikh/Event-Api-Laravel-Project.git
   cd your-repository
   ```

2️⃣ **Install dependencies** 📦:
   ```sh
   composer install
   ```

3️⃣ **Set up environment file** 🛠️:
   ```sh
   cp .env.example .env
   ```
   - Update `.env` with your database credentials.

4️⃣ **Generate application key** 🔑:
   ```sh
   php artisan key:generate
   ```

5️⃣ **Run migrations & seed database** 🏗️:
   ```sh
   php artisan migrate --seed
   ```

6️⃣ **Configure Laravel Sanctum** 🔒:
   ```sh
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   php artisan migrate
   ```

7️⃣ **Run the application** 🚀:
   ```sh
   php artisan serve
   ```

---

## 🔑 Authentication & Token Management
- **Register a new user**:
  ```http
  POST /api/register
  ```
- **Login & get token**:
  ```http
  POST /api/login
  ```
- **Use the token for requests**:
  ```http
  Authorization: Bearer {TOKEN}
  ```

---

## 📡 API Endpoints

### 🎫 Events
📌 **Get all events** → `GET /api/events`  
📌 **Create a new event** → `POST /api/events`  
📌 **Update an event** → `PUT /api/events/{id}`  
📌 **Show event details** → `GET /api/events/{id}`  
📌 **Delete an event** → `DELETE /api/events/{id}`  

### 🏷️ Attendees
🎟️ **Get all attendees** → `GET /api/events/{event}/attendees`  
🎟️ **Register an attendee** → `POST /api/events/{event}/attendees`  
🎟️ **Update attendee details** → `PUT /api/events/{event}/attendees/{attendee}`  
🎟️ **Show attendee details** → `GET /api/events/{event}/attendees/{attendee}`  
🎟️ **Delete an attendee** → `DELETE /api/events/{event}/attendees/{attendee}`  

---

## 🗓️ Event Scheduling & Notifications
- **Schedule an event** to notify attendees automatically.  
- Implemented using **Laravel's Task Scheduling (`schedule:run`)**.  

---

## 🔐 Authorization & Access Control
- **Role-based access** using **Gates & Policies**.  
- Example of checking permissions:
  ```php
  if (Gate::allows('update-event', $event)) {
      // Allow update
  }
  ```

---

## 🛠️ Testing with Postman
1️⃣ Import the API collection into **Postman**.  
2️⃣ Use **Bearer Token Authentication** for secured requests.  
3️⃣ Test **CRUD operations** for **events** & **attendees**.  

---

## 🤝 Contributing
Pull requests are welcome! For major changes, please open an issue first to discuss the proposed changes.  
