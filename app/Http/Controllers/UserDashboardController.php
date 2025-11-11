<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\BookingService;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Data untuk ringkasan
        $totalVehicles = $this->getTotalVehicles($userId);
        $totalCompletedServices = $this->getTotalCompletedServices($userId);
        $activeServices = $this->getActiveServices($userId);
        $servicesThisMonth = $this->getServicesThisMonth($userId);

        // Data untuk grafik
        $serviceHistory = $this->getServiceHistory($userId);
        $vehicleTypes = $this->getVehicleTypesDistribution($userId);

        // Servis terbaru
        $recentServices = $this->getRecentServices($userId);

        return view('dashboard.user', compact(
            'totalVehicles',
            'totalCompletedServices',
            'activeServices',
            'servicesThisMonth',
            'serviceHistory',
            'vehicleTypes',
            'recentServices'
        ));
    }

    private function getTotalVehicles($userId)
    {
        return Vehicle::where('created_by', $userId)->count();
    }

    private function getTotalCompletedServices($userId)
    {
        return BookingService::where('created_by', $userId)
            ->whereIn('status', ['selesai', 'diambil'])
            ->count();
    }

    private function getActiveServices($userId)
    {
        return BookingService::where('created_by', $userId)
            ->whereIn('status', ['diterima', 'dikerjakan'])
            ->count();
    }

    private function getServicesThisMonth($userId)
    {
        return BookingService::where('created_by', $userId)
            ->whereMonth('booking_date', Carbon::now()->month)
            ->whereYear('booking_date', Carbon::now()->year)
            ->count();
    }

    private function getServiceHistory($userId)
    {
        $sixMonthsAgo = Carbon::now()->subMonths(5)->startOfMonth();

        $history = BookingService::where('created_by', $userId)
            ->where('booking_date', '>=', $sixMonthsAgo)
            ->select(
                DB::raw('MONTH(booking_date) as month'),
                DB::raw('YEAR(booking_date) as year'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Format data untuk chart
        $labels = [];
        $data = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthYear = $date->format('M Y');
            $labels[] = $monthYear;

            $found = $history->first(function ($item) use ($date) {
                return $item->month == $date->month && $item->year == $date->year;
            });

            $data[] = $found ? $found->count : 0;
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

    private function getVehicleTypesDistribution($userId)
    {
        $distribution = Vehicle::where('created_by', $userId)
            ->select('vehicle_type', DB::raw('COUNT(*) as count'))
            ->groupBy('vehicle_type')
            ->get();

        $labels = [];
        $data = [];
        $colors = ['#696cff', '#03c3ec', '#71dd37', '#ffab00', '#8592a3'];

        foreach ($distribution as $item) {
            $labels[] = $item->vehicle_type === 'motor' ? 'Motor' : 'Mobil';
            $data[] = $item->count;
        }

        // Jika tidak ada data, berikan data default
        if (empty($labels)) {
            $labels = ['Mobil', 'Motor'];
            $data = [0, 0];
        }

        return [
            'labels' => $labels,
            'data' => $data,
            'colors' => array_slice($colors, 0, count($labels))
        ];
    }

    private function getRecentServices($userId)
    {
        return BookingService::with(['vehicle', 'workshop'])
            ->where('created_by', $userId)
            ->orderBy('booking_date', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'booking_date' => $booking->booking_date->format('d M Y'),
                    'vehicle_name' => $booking->vehicle ?
                        "{$booking->vehicle->brand} {$booking->vehicle->model}" :
                        'Kendaraan tidak diketahui',
                    'workshop_name' => $booking->workshop->name ?? 'Bengkel tidak diketahui',
                    'status' => $booking->status,
                    'status_badge' => $this->getStatusBadge($booking->status)
                ];
            });
    }

    private function getStatusBadge($status)
    {
        $badges = [
            'menunggu_konfirmasi' => ['class' => 'bg-secondary', 'text' => 'Menunggu'],
            'diterima' => ['class' => 'bg-info text-dark', 'text' => 'Diterima'],
            'dikerjakan' => ['class' => 'bg-warning text-dark', 'text' => 'Proses'],
            'selesai' => ['class' => 'bg-success', 'text' => 'Selesai'],
            'diambil' => ['class' => 'bg-primary', 'text' => 'Diambil'],
            'ditolak' => ['class' => 'bg-danger', 'text' => 'Ditolak'],
            'dibatalkan' => ['class' => 'bg-dark', 'text' => 'Batal']
        ];

        return $badges[$status] ?? ['class' => 'bg-secondary', 'text' => $status];
    }
}
