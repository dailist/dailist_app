# ============================================
# MIDTRANS INTEGRATION SETUP GUIDE
# ============================================

## Cara Mendapatkan Midtrans Credentials:

1. **Daftar Akun Midtrans**
   - Buka: https://dashboard.midtrans.com/register
   - Pilih "Sign Up" dan isi data

2. **Aktifkan Sandbox Mode**
   - Login ke dashboard: https://dashboard.midtrans.com/
   - Pilih "Sandbox" mode (untuk testing)

3. **Dapatkan API Keys**
   - Di dashboard, pilih menu "Settings" > "Access Keys"
   - Copy:
     * Server Key (SB-Mid-server-xxxxx)
     * Client Key (SB-Mid-client-xxxxx)

4. **Update .env File**
   Ganti value di .env dengan credentials kamu:
   
   ```
   MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxxxxxx
   MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxxxxxx
   MIDTRANS_IS_PRODUCTION=false
   ```

5. **Testing Payment**
   - Login sebagai user Free: user@dailist.com / password
   - Klik "Upgrade to Premium" atau buka /pricing
   - Klik "Upgrade ke Premium"
   - Klik "Bayar Sekarang"
   - Gunakan nomor kartu test Midtrans:
     * Card Number: 4811 1111 1111 1114
     * CVV: 123
     * Exp Date: 01/25 (atau bulan/tahun yang akan datang)

6. **Webhook Configuration**
   Di Production nanti, tambahkan webhook URL di Midtrans dashboard:
   - URL: https://yourdomain.com/midtrans/callback
   - Method: POST

## Troubleshooting:

- **Error "Unauthorized"**: Cek apakah Server Key sudah benar
- **Popup tidak muncul**: Cek apakah Client Key sudah benar
- **Payment tidak ter-update**: Cek webhook callback URL

## Production Checklist:

- [ ] Ganti Server Key & Client Key dengan Production keys
- [ ] Set MIDTRANS_IS_PRODUCTION=true
- [ ] Setup webhook URL di Midtrans dashboard
- [ ] Test semua payment methods (Bank Transfer, E-wallet, Credit Card)
