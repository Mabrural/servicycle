<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\WorkshopImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomepageController extends Controller
{
    /**
     * Menampilkan halaman utama
     */
    public function index()
    {
        return view('homepage.index');
    }

    /**
     * API untuk mendapatkan data bengkel
     */
    public function getWorkshops()
    {
        try {
            $workshops = Workshop::with(['creator', 'images'])
                ->approved()
                ->get()
                ->map(function($workshop) {
                    return [
                        'id' => $workshop->id,
                        'name' => $workshop->name,
                        'types' => $workshop->types ?? [],
                        'address' => $this->formatAddress($workshop),
                        'province' => $workshop->province,
                        'city' => $workshop->city,
                        'district' => $workshop->district,
                        'village' => $workshop->village,
                        'postal_code' => $workshop->postal_code,
                        'latitude' => $workshop->latitude,
                        'longitude' => $workshop->longitude,
                        'phone' => $workshop->phone,
                        'email' => $workshop->email,
                        'services' => $workshop->services ?? [],
                        'specialization' => $workshop->specialization,
                        'operating_hours' => $workshop->operating_hours,
                        'description' => $workshop->description,
                        'status' => $workshop->status,
                        'created_by' => $workshop->created_by,
                        'rating' => $this->calculateRating($workshop),
                        'photo_url' => $workshop->primary_image ? $workshop->primary_image->image_url : null,
                        'image_urls' => $workshop->image_urls,
                        'created_at' => $workshop->created_at->format('d M Y'),
                        'updated_at' => $workshop->updated_at->format('d M Y'),
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $workshops,
                'count' => $workshops->count()
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting workshops: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data bengkel',
                'error' => config('app.debug') ? $e->getMessage() : 'Terjadi kesalahan server'
            ], 500);
        }
    }

    /**
     * Format alamat lengkap
     */
    private function formatAddress($workshop)
    {
        $addressParts = [];
        
        if ($workshop->address) {
            $addressParts[] = $workshop->address;
        }
        if ($workshop->village) {
            $addressParts[] = $workshop->village;
        }
        if ($workshop->district) {
            $addressParts[] = $workshop->district;
        }
        if ($workshop->city) {
            $addressParts[] = $workshop->city;
        }
        if ($workshop->province) {
            $addressParts[] = $workshop->province;
        }
        if ($workshop->postal_code) {
            $addressParts[] = $workshop->postal_code;
        }

        return implode(', ', $addressParts);
    }

    /**
     * Calculate workshop rating (placeholder - sesuaikan dengan logic rating Anda)
     */
    private function calculateRating($workshop)
    {
        // Jika Anda memiliki sistem rating, ganti dengan logic yang sesuai
        // Untuk sementara, return random rating antara 4.0 - 5.0
        return round(4.0 + (mt_rand(0, 10) / 10), 1);
    }

    /**
     * API untuk mencari bengkel berdasarkan keyword
     */
    public function searchWorkshops(Request $request)
    {
        try {
            $query = Workshop::with(['creator', 'images'])
                ->approved();

            // Filter berdasarkan keyword pencarian
            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('address', 'like', "%{$search}%")
                      ->orWhere('city', 'like', "%{$search}%")
                      ->orWhere('district', 'like', "%{$search}%")
                      ->orWhere('village', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('specialization', 'like', "%{$search}%");
                });
            }

            // Filter berdasarkan jenis kendaraan
            if ($request->has('type') && $request->type !== 'all') {
                $type = $request->type;
                $query->whereJsonContains('types', $type);
            }

            $workshops = $query->get()->map(function($workshop) {
                return [
                    'id' => $workshop->id,
                    'name' => $workshop->name,
                    'types' => $workshop->types ?? [],
                    'address' => $this->formatAddress($workshop),
                    'latitude' => $workshop->latitude,
                    'longitude' => $workshop->longitude,
                    'phone' => $workshop->phone,
                    'services' => $workshop->services ?? [],
                    'specialization' => $workshop->specialization,
                    'operating_hours' => $workshop->operating_hours,
                    'description' => $workshop->description,
                    'rating' => $this->calculateRating($workshop),
                    'photo_url' => $workshop->primary_image ? $workshop->primary_image->image_url : null,
                    'created_at' => $workshop->created_at->format('d M Y'),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $workshops,
                'count' => $workshops->count()
            ]);

        } catch (\Exception $e) {
            Log::error('Error searching workshops: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mencari bengkel',
                'error' => config('app.debug') ? $e->getMessage() : 'Terjadi kesalahan server'
            ], 500);
        }
    }

    /**
     * API untuk mendapatkan bengkel terdekat berdasarkan koordinat
     */
    public function getNearbyWorkshops(Request $request)
    {
        try {
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $radius = $request->radius ?? 10; // Default radius 10km

            if (!$latitude || !$longitude) {
                return response()->json([
                    'success' => false,
                    'message' => 'Koordinat lokasi diperlukan'
                ], 400);
            }

            $workshops = Workshop::with(['creator', 'images'])
                ->approved()
                ->select('*')
                ->selectRaw(
                    '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                    [$latitude, $longitude, $latitude]
                )
                ->having('distance', '<', $radius)
                ->orderBy('distance')
                ->get()
                ->map(function($workshop) {
                    return [
                        'id' => $workshop->id,
                        'name' => $workshop->name,
                        'types' => $workshop->types ?? [],
                        'address' => $this->formatAddress($workshop),
                        'latitude' => $workshop->latitude,
                        'longitude' => $workshop->longitude,
                        'phone' => $workshop->phone,
                        'services' => $workshop->services ?? [],
                        'specialization' => $workshop->specialization,
                        'operating_hours' => $workshop->operating_hours,
                        'description' => $workshop->description,
                        'rating' => $this->calculateRating($workshop),
                        'distance' => round($workshop->distance, 2),
                        'photo_url' => $workshop->primary_image ? $workshop->primary_image->image_url : null,
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $workshops,
                'count' => $workshops->count()
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting nearby workshops: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mencari bengkel terdekat',
                'error' => config('app.debug') ? $e->getMessage() : 'Terjadi kesalahan server'
            ], 500);
        }
    }

    /**
     * API untuk mendapatkan detail bengkel
     */
    public function getWorkshopDetail($id)
    {
        try {
            $workshop = Workshop::with(['creator', 'images'])
                ->approved()
                ->findOrFail($id);

            $workshopData = [
                'id' => $workshop->id,
                'name' => $workshop->name,
                'types' => $workshop->types ?? [],
                'address' => $this->formatAddress($workshop),
                'province' => $workshop->province,
                'city' => $workshop->city,
                'district' => $workshop->district,
                'village' => $workshop->village,
                'postal_code' => $workshop->postal_code,
                'latitude' => $workshop->latitude,
                'longitude' => $workshop->longitude,
                'phone' => $workshop->phone,
                'email' => $workshop->email,
                'services' => $workshop->services ?? [],
                'specialization' => $workshop->specialization,
                'operating_hours' => $workshop->operating_hours,
                'description' => $workshop->description,
                'rating' => $this->calculateRating($workshop),
                'photo_url' => $workshop->primary_image ? $workshop->primary_image->image_url : null,
                'image_urls' => $workshop->image_urls,
                'creator_name' => $workshop->creator->name ?? 'Tidak diketahui',
                'creator_email' => $workshop->creator->email ?? 'Tidak diketahui',
                'created_at' => $workshop->created_at->format('d M Y'),
                'updated_at' => $workshop->updated_at->format('d M Y'),
            ];

            return response()->json([
                'success' => true,
                'data' => $workshopData
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting workshop detail: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat detail bengkel',
                'error' => config('app.debug') ? $e->getMessage() : 'Terjadi kesalahan server'
            ], 500);
        }
    }

    /**
     * API untuk mendapatkan statistik homepage
     */
    public function getHomepageStats()
    {
        try {
            $totalWorkshops = Workshop::approved()->count();
            $totalMotorWorkshops = Workshop::approved()->whereJsonContains('types', 'motor')->count();
            $totalMobilWorkshops = Workshop::approved()->whereJsonContains('types', 'mobil')->count();
            $totalSepedaWorkshops = Workshop::approved()->whereJsonContains('types', 'sepeda')->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'total_workshops' => $totalWorkshops,
                    'total_motor' => $totalMotorWorkshops,
                    'total_mobil' => $totalMobilWorkshops,
                    'total_sepeda' => $totalSepedaWorkshops,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting homepage stats: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat statistik',
                'error' => config('app.debug') ? $e->getMessage() : 'Terjadi kesalahan server'
            ], 500);
        }
    }
}