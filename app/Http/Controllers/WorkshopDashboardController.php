<?php

namespace App\Http\Controllers;

use App\Models\BookingService;
use App\Models\Workshop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class WorkshopDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $workshop = Workshop::where('created_by', $user->id)->first();

        if (!$workshop) {
            abort(403, 'Anda belum memiliki bengkel terdaftar.');
        }

        // Servis hari ini
        $today = Carbon::today();
        $todayServices = BookingService::where('workshop_id', $workshop->id)
            ->whereDate('booking_date', $today)
            ->count();

        // Antrian aktif (status diterima atau dikerjakan)
        $activeQueue = BookingService::where('workshop_id', $workshop->id)
            ->whereIn('status', ['diterima', 'dikerjakan'])
            ->count();

        // Tren servis bulanan (6 bulan terakhir)
        $serviceTrends = BookingService::selectRaw('MONTH(booking_date) as month, COUNT(*) as total')
            ->where('workshop_id', $workshop->id)
            ->where('booking_date', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // Data untuk grafik (label bulan & jumlah servis)
        $months = collect(range(1, 6))->map(fn($i) => now()->subMonths(6 - $i)->format('M'))->values();
        $values = $months->map(function ($m) use ($serviceTrends) {
            $monthNum = Carbon::parse("01 $m")->month;
            return $serviceTrends[$monthNum] ?? 0;
        });

        // Jenis layanan terpopuler (dari kolom notes / jika ada field khusus bisa diganti)
        $serviceTypes = BookingService::where('workshop_id', $workshop->id)
            ->selectRaw('notes as service_type, COUNT(*) as total')
            ->groupBy('service_type')
            ->orderByDesc('total')
            ->take(4)
            ->pluck('total', 'service_type');

        // Servis terbaru
        $latestServices = BookingService::with(['creator', 'vehicle'])
            ->where('workshop_id', $workshop->id)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.workshop', compact(
            'todayServices',
            'activeQueue',
            'months',
            'values',
            'serviceTypes',
            'latestServices'
        ));
    }
}
