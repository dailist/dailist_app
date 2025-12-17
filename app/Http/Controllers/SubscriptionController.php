<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function pricing()
    {
        return view('subscription.pricing');
    }

    public function upgrade()
    {
        $user = auth()->user();

        // Cek apakah user sudah premium
        if ($user->isPremium()) {
            return redirect()->route('pricing')->with('info', 'Anda sudah berlangganan paket Premium!');
        }

        // Redirect ke halaman pembayaran
        return view('subscription.upgrade');
    }

    public function createPayment(Request $request)
    {
        $user = auth()->user();

        // Cek apakah user sudah premium
        if ($user->isPremium()) {
            return response()->json(['error' => 'Anda sudah berlangganan Premium'], 400);
        }

        // Create transaction record
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'amount' => 50000,
            'status' => 'pending',
            'payment_type' => 'subscription',
        ]);

        // Create order_id
        $orderId = 'TRX-' . $transaction->id . '-' . time();

        // Prepare transaction details for Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => 50000,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => [
                [
                    'id' => 'premium-monthly',
                    'price' => 50000,
                    'quantity' => 1,
                    'name' => 'DaiList Pro Premium - 1 Month',
                ]
            ],
            'callbacks' => [
                'finish' => route('subscription.finish', ['transaction_id' => $transaction->id]),
            ]
        ];

        try {
            // Get Snap token from Midtrans
            $snapToken = Snap::getSnapToken($params);

            // Update transaction with snap token and order_id
            $transaction->update([
                'snap_token' => $snapToken,
                'midtrans_order_id' => $orderId
            ]);

            return response()->json([
                'snap_token' => $snapToken,
                'transaction_id' => $transaction->id
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        // Verify signature key
        if ($hashed == $request->signature_key) {
            // Extract transaction ID from order_id
            $orderId = $request->order_id; // Format: TRX-{id}-{timestamp}
            preg_match('/TRX-(\d+)-/', $orderId, $matches);
            $transactionId = $matches[1] ?? null;

            if ($transactionId) {
                $transaction = Transaction::find($transactionId);

                if ($transaction) {
                    // Update transaction status based on Midtrans status
                    if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                        $transaction->update([
                            'status' => 'success',
                            'payment_type' => $request->payment_type ?? 'unknown',
                        ]);

                        // Activate or create premium subscription
                        $user = $transaction->user;
                        $subscription = $user->subscription;

                        if ($subscription) {
                            $subscription->update([
                                'plan_type' => 'premium',
                                'status' => 'active',
                                'started_at' => now(),
                                'expired_at' => now()->addMonth(),
                            ]);
                        } else {
                            $user->subscription()->create([
                                'plan_type' => 'premium',
                                'status' => 'active',
                                'started_at' => now(),
                                'expired_at' => now()->addMonth(),
                            ]);
                        }
                    } elseif ($request->transaction_status == 'pending') {
                        $transaction->update(['status' => 'pending']);
                    } elseif ($request->transaction_status == 'deny' || $request->transaction_status == 'expire' || $request->transaction_status == 'cancel') {
                        $transaction->update(['status' => 'failed']);
                    }
                }
            }
        }

        return response()->json(['status' => 'success']);
    }

    public function finish(Request $request, $transaction_id)
    {
        $transaction = Transaction::find($transaction_id);

        if (!$transaction) {
            return redirect()->route('pricing')->with('error', 'Transaksi tidak ditemukan.');
        }

        // Check transaction status from Midtrans using order_id
        try {
            $status = \Midtrans\Transaction::status($transaction->midtrans_order_id);

            // Convert to object if needed
            $transactionStatus = is_object($status) ? $status->transaction_status : ($status['transaction_status'] ?? null);
            $paymentType = is_object($status) ? ($status->payment_type ?? 'unknown') : ($status['payment_type'] ?? 'unknown');

            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                // Update transaction
                $transaction->update([
                    'status' => 'success',
                    'payment_type' => $paymentType,
                ]);

                // Activate premium subscription
                $user = $transaction->user;
                $subscription = $user->subscription;

                if ($subscription) {
                    $subscription->update([
                        'plan_type' => 'premium',
                        'status' => 'active',
                        'started_at' => now(),
                        'expired_at' => now()->addMonth(),
                    ]);
                } else {
                    $user->subscription()->create([
                        'plan_type' => 'premium',
                        'status' => 'active',
                        'started_at' => now(),
                        'expired_at' => now()->addMonth(),
                    ]);
                }

                return redirect()->route('dashboard')->with('success', '🎉 Selamat! Akun Anda telah di-upgrade ke Premium!');
            } elseif ($transactionStatus == 'pending') {
                return redirect()->route('pricing')->with('info', 'Pembayaran Anda masih pending. Silakan selesaikan pembayaran.');
            } else {
                return redirect()->route('pricing')->with('error', 'Pembayaran gagal atau dibatalkan.');
            }
        } catch (\Exception $e) {
            return redirect()->route('pricing')->with('error', 'Gagal memverifikasi status pembayaran: ' . $e->getMessage());
        }
    }

    public function cancel()
    {
        $user = auth()->user();
        $subscription = $user->subscription;

        if (!$subscription || $subscription->plan_type !== 'premium') {
            return redirect()->route('pricing')->with('error', 'Anda tidak memiliki langganan Premium aktif.');
        }

        $subscription->update([
            'status' => 'cancelled',
            'expired_at' => now(), // Langsung expired
        ]);

        return redirect()->route('pricing')->with('success', 'Langganan Premium Anda telah dibatalkan.');
    }

    public function continuePayment($transactionId)
    {
        $transaction = auth()->user()->transactions()->findOrFail($transactionId);

        if ($transaction->status !== 'pending') {
            return redirect()->route('dashboard')->with('error', 'Transaksi ini sudah tidak dalam status pending.');
        }

        // Return snap token untuk re-open popup
        return view('subscription.continue', [
            'snapToken' => $transaction->snap_token,
            'transaction' => $transaction
        ]);
    }

    public function cancelTransaction($transactionId)
    {
        $transaction = auth()->user()->transactions()->findOrFail($transactionId);

        if ($transaction->status !== 'pending') {
            return redirect()->route('dashboard')->with('error', 'Transaksi ini sudah tidak dalam status pending.');
        }

        $transaction->update(['status' => 'cancelled']);

        return redirect()->route('dashboard')->with('success', 'Transaksi pembayaran telah dibatalkan.');
    }}
