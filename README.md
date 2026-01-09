# URL Shortener – Laravel Assignment

This project is a role-based URL shortener built using **Laravel** as part of an interview assignment.

The system allows users to generate and manage short URLs based on their assigned roles and company access rules.

---

## 🚀 Tech Stack

- **Laravel** 10+
- **PHP** 8.1+
- **MySQL** (via MAMP)
- **Laravel Breeze** (Authentication)
- **Bootstrap 5 (CDN)** for UI
- **Vite / NPM** for assets

---

## 📋 Features

### Authentication & Authorization
- Login / Logout
- Role-based access control

### Roles
- **SuperAdmin**
- **Admin**
- **Member**

### Company Structure
- Single system (no multi-tenant switching)
- One company has multiple users
- User belongs to only one company

---

## ✉️ Invitation Rules

| Role | Can Invite | Company Scope |
|----|----|----|
| SuperAdmin | Admin | New Company |
| Admin | Admin, Member | Own Company |
| Member | ❌ | — |

---

## 🔗 URL Shortener Rules

| Role | Create Short URL | View Short URLs |
|----|----|----|
| SuperAdmin | ❌ | All companies |
| Admin | ✅ | Own company |
| Member | ✅ | Only their own |

- Short URLs are **publicly accessible**
- Public route redirects to original URL




Install Dependencies

composer install
npm install