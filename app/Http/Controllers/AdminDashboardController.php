<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Workshop;
use App\Models\BookingService;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Data Ringkasan
        $totalUsers = User::count();
        $totalWorkshops = Workshop::count();
        $totalVehicles = Vehicle::count();

        // Total transaksi (jumlah booking service)
        $totalTransactions = BookingService::count();

        // Data untuk grafik statistik pengguna (6 bulan terakhir)
        $userStats = $this->getUserStats();

        // Data untuk distribusi role
        $roleDistribution = $this->getRoleDistribution();

        // Aktivitas terbaru
        $recentActivities = $this->getRecentActivities();

        return view('dashboard.admin', compact(
            'totalUsers',
            'totalWorkshops',
            'totalVehicles',
            'totalTransactions',
            'userStats',
            'roleDistribution',
            'recentActivities'
        ));
    }

    private function getUserStats()
    {
        $months = [];
        $userCounts = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthYear = $date->format('M Y');

            $startOfMonth = $date->copy()->startOfMonth();
            $endOfMonth = $date->copy()->endOfMonth();

            $userCount = User::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

            $months[] = $monthYear;
            $userCounts[] = $userCount;
        }

        return [
            'months' => $months,
            'counts' => $userCounts
        ];
    }

    private function getRoleDistribution()
    {
        return [
            'admin' => User::where('role', 'admin')->count(),
            'workshop' => User::where('role', 'workshop')->count(),
            'vehicle_owner' => User::where('role', 'vehicle_owner')->count(),
        ];
    }

    private function getRecentActivities()
    {
        // Ambil aktivitas terbaru dari berbagai model
        $recentUsers = User::with([])
            ->select('name', 'role', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($user) {
                return [
                    'name' => $user->name,
                    'role' => $user->role,
                    'activity' => 'Bergabung sebagai pengguna baru',
                    'time' => $user->created_at,
                    'type' => 'user'
                ];
            });

        $recentBookings = BookingService::with(['creator', 'workshop'])
            ->select('created_by', 'workshop_id', 'booking_date', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($booking) {
                $activity = "Booking servis - Status: " . $this->getStatusText($booking->status);
                return [
                    'name' => $booking->creator->name ?? 'Unknown',
                    'role' => $booking->creator->role ?? 'vehicle_owner',
                    'activity' => $activity,
                    'time' => $booking->created_at,
                    'type' => 'booking'
                ];
            });

        $recentWorkshops = Workshop::with(['creator'])
            ->select('name', 'created_by', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($workshop) {
                $activity = $workshop->status === 'pending'
                    ? 'Mendaftarkan workshop baru (Pending)'
                    : 'Mendaftarkan workshop baru (Approved)';

                return [
                    'name' => $workshop->creator->name ?? 'Unknown',
                    'role' => 'workshop',
                    'activity' => $activity,
                    'time' => $workshop->created_at,
                    'type' => 'workshop'
                ];
            });

        // Gabungkan semua aktivitas dan urutkan berdasarkan waktu
        $allActivities = collect([])
            ->merge($recentUsers)
            ->merge($recentBookings)
            ->merge($recentWorkshops)
            ->sortByDesc('time')
            ->take(5)
            ->values();

        return $allActivities;
    }

    private function getStatusText($status)
    {
        $statusTexts = [
            'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
            'diterima' => 'Diterima',
            'dikerjakan' => 'Dikerjakan',
            'selesai' => 'Selesai',
            'diambil' => 'Diambil',
            'ditolak' => 'Ditolak',
            'dibatalkan' => 'Dibatalkan',
        ];

        return $statusTexts[$status] ?? $status;
    }
}
