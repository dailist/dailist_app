# Requirements & Fitur Minimal Aplikasi Tubes

## 📋 Overview Proyek

**Jenis Aplikasi:** Web Application berbasis SaaS dengan Subscription System  
**Framework:** Laravel (sudah ada di workspace)  
**Target:** Minimum Viable Product (MVP) dengan CI/CD Pipeline  

---

## 🎯 Konsep Bisnis yang Disarankan

Mengingat stack Laravel yang sudah ada, berikut konsep sederhana:

**Nama Bisnis (Contoh):** **DaiList Pro** - Daily Task Management SaaS  
**Value Proposition:** Platform manajemen tugas harian dengan fitur subscription untuk tim/individu  
**Target Market:** Mahasiswa, freelancer, dan tim kecil yang butuh task management sederhana

---

## ✅ Fitur Minimal MVP (Fase 1)

### 1. **Autentikasi & User Management**
- [x] Register (Email, Password, Name)
- [x] Login / Logout
- [x] Profile Management (Update info dasar)
- [x] Role-based access: Admin & User

### 2. **Subscription System (WAJIB)**
```
Free Tier:
- Maksimal 10 tasks
- Akses fitur dasar

Premium Tier (Rp 50.000/bulan):
- Unlimited tasks
- Priority support
- Akses fitur tambahan
```

**Fitur Subscription:**
- [ ] Halaman Pricing/Plans
- [ ] Pilih paket subscription
- [ ] Integrasi pembayaran Midtrans (Sandbox)
- [ ] Status subscription (Active/Inactive/Expired)
- [ ] Auto-downgrade ke Free jika subscription habis

### 3. **Core Features (Task Management)**
- [ ] Create Task (Title, Description, Due Date)
- [ ] View Task List (dengan filter by status)
- [ ] Update Task (Edit & Mark as Complete)
- [ ] Delete Task
- [ ] Task counter (untuk limit Free tier)

### 4. **Admin Dashboard (WAJIB)**
- [ ] View semua subscribers
- [ ] Filter by subscription status
- [ ] View total revenue (dari Midtrans)
- [ ] View user statistics (Total users, Active subscribers)
- [ ] Basic analytics dashboard

### 5. **Landing Page**
- [ ] Homepage dengan deskripsi produk
- [ ] Pricing section
- [ ] CTA (Call-to-Action) untuk Register

---

## 🗄️ Database Schema Minimal

### Tables yang Dibutuhkan:

1. **users** (sudah ada di Laravel default)
   - id, name, email, password, role (user/admin)
   - created_at, updated_at

2. **subscriptions**
   - id, user_id (FK)
   - plan_type (free/premium)
   - status (active/inactive/expired)
   - started_at, expired_at
   - midtrans_order_id
   - created_at, updated_at

3. **tasks**
   - id, user_id (FK)
   - title, description
   - status (pending/completed)
   - due_date
   - created_at, updated_at

4. **transactions** (untuk logging pembayaran)
   - id, user_id (FK), subscription_id (FK)
   - amount, status
   - midtrans_transaction_id
   - payment_type
   - created_at, updated_at

---

## 🔧 Technical Requirements

### A. Systems Developer

**Backend (Laravel):**
- [ ] RESTful API atau Blade templates
- [ ] Authentication (Laravel Breeze/Jetstream)
- [ ] Middleware untuk cek subscription status
- [ ] Integrasi Midtrans SDK
- [ ] CRUD tasks
- [ ] Admin panel untuk monitoring

**Frontend:**
- [ ] Responsive design (Bootstrap/Tailwind - vite sudah ada)
- [ ] Form validation
- [ ] Dashboard user & admin
- [ ] Payment flow UI

**Database:**
- [ ] Migration files untuk semua tables
- [ ] Seeder untuk dummy data
- [ ] Relasi antar tables (hasMany, belongsTo)

### B. DevOps Engineer

**CI/CD Pipeline (Jenkins):**
```yaml
Pipeline Stages:
1. Pull dari GitHub (SCM)
2. Run tests (PHPUnit/Pest)
3. Build Docker image
4. Push ke Azure Container Registry
5. Deploy ke Azure WebApp
```

**Docker Setup:**
- [ ] Dockerfile untuk Laravel app
- [ ] docker-compose.yml (app + MySQL)
- [ ] Environment configuration

**GitHub Integration:**
- [ ] Webhook ke Jenkins
- [ ] Branch protection rules
- [ ] Automated testing on PR

### C. Server Administrator

**Azure WebApp:**
- [ ] Setup subdomain custom (contoh: dailist.azurewebsites.net)
- [ ] Environment variables configuration
- [ ] Database connection (Azure Database for MySQL)
- [ ] SSL/HTTPS enabled

**Deployment:**
- [ ] Auto-deploy dari Jenkins pipeline
- [ ] Manual deploy option (VSCode Azure extension)
- [ ] Database migration automation
- [ ] Health check endpoint

**Database:**
- [ ] Azure Database for MySQL setup
- [ ] Connection string configuration
- [ ] Backup strategy
- [ ] Remote access for development

---

## 🔌 Integrasi yang Diperlukan

### 1. **Midtrans Payment Gateway**

**Akun:**
- Daftar di https://midtrans.com (gunakan mode Sandbox)
- Dapatkan Server Key & Client Key

**Implementasi:**
```php
// Minimal Flow:
1. User pilih Premium plan
2. Generate Midtrans Snap Token
3. Redirect ke payment page
4. Handle callback/notification dari Midtrans
5. Update subscription status
```

**Endpoints:**
- POST `/subscription/upgrade` - Buat transaksi
- POST `/midtrans/notification` - Webhook dari Midtrans

### 2. **GitHub Project Management**

**Kanban Board:**
- [ ] Create GitHub Project (Kanban view)
- [ ] Columns: Backlog, To Do, In Progress, Review, Done
- [ ] Link issues ke project
- [ ] Assign tasks ke anggota sesuai role

---

## 📦 Deliverables Minimum

### Yang Harus Jalan di Demo:

1. **User Flow:**
   - Register → Login → Lihat Dashboard
   - Create beberapa tasks (sampai limit Free tier)
   - Upgrade ke Premium via Midtrans (Sandbox)
   - Unlock fitur Premium (unlimited tasks)

2. **Admin Flow:**
   - Login sebagai Admin
   - Lihat dashboard subscribers
   - Lihat statistics (users, revenue)

3. **DevOps Flow:**
   - Push code ke GitHub
   - Jenkins auto-trigger build
   - Docker image ter-build
   - Auto-deploy ke Azure

4. **Live Application:**
   - Bisa diakses via subdomain Azure
   - Database connected dan berfungsi
   - Payment gateway berfungsi (sandbox)

---

## 🚀 Tahapan Pengerjaan (Recommended)

### Week 1-2: Setup & Foundation
- Setup GitHub repository & project board
- Setup Laravel authentication
- Buat database schema & migrations
- Setup Docker & docker-compose local

### Week 3-4: Core Development
- Implement task CRUD
- Implement subscription logic
- Integrate Midtrans (sandbox)
- Buat admin dashboard

### Week 5: DevOps & Deployment
- Setup Jenkins pipeline
- Setup Azure WebApp
- Configure CI/CD automation
- Testing end-to-end

### Week 6: Polish & Presentation
- Bug fixing
- UI/UX improvements
- Prepare presentation
- Create demo video

---

## 📊 Kriteria Kesuksesan MVP

**Checklist Minimal Agar Lolos:**
- ✅ Aplikasi bisa diakses via Azure WebApp
- ✅ User bisa register, login, dan manage tasks
- ✅ Subscription system berfungsi (Free & Premium)
- ✅ Midtrans payment berhasil di sandbox
- ✅ Admin bisa monitoring subscribers
- ✅ CI/CD pipeline berjalan (GitHub → Jenkins → Docker → Azure)
- ✅ Database Azure connected
- ✅ GitHub Project board terisi dengan progress

---

## 🔒 Notes Penting

1. **Jangan Over-Engineering:**
   - Fokus ke fitur minimal yang diminta
   - UI sederhana tapi fungsional OK
   - Gunakan template Bootstrap/Tailwind yang sudah jadi

2. **Testing Midtrans:**
   - Gunakan credit card dummy dari Midtrans
   - Dokumentasikan flow pembayaran

3. **Database:**
   - Development: Local MySQL (Docker)
   - Production: Azure Database for MySQL

4. **Environment Variables:**
   ```env
   MIDTRANS_SERVER_KEY=xxx
   MIDTRANS_CLIENT_KEY=xxx
   MIDTRANS_IS_PRODUCTION=false
   
   AZURE_DB_HOST=xxx
   AZURE_DB_DATABASE=xxx
   AZURE_DB_USERNAME=xxx
   AZURE_DB_PASSWORD=xxx
   ```

5. **Documentation:**
   - README.md dengan cara setup project
   - API documentation (jika pakai API)
   - Deployment guide
   - User guide sederhana

---

## 🎓 Pembagian Tugas Antar Role

### Systems Developer:
- User authentication & authorization
- Task CRUD operations
- Midtrans integration
- Admin dashboard
- Frontend development

### DevOps Engineer:
- Dockerfile & docker-compose
- Jenkins pipeline configuration
- GitHub webhook setup
- Azure Container Registry
- Automated testing setup

### Server Administrator:
- Azure WebApp configuration
- Custom subdomain setup
- Database provisioning & connection
- SSL/HTTPS setup
- Monitoring & logging

---

**Target Akhir:** Aplikasi SaaS sederhana yang fully functional dengan subscription system, terintegrasi Midtrans, dan ter-deploy otomatis via CI/CD ke Azure.
