@extends('homepage.layouts.main')

@section('container')
    <div class="min-h-screen bg-gray-50 flex items-center justify-center px-4">
        <div class="max-w-md w-full text-center">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check text-green-600 text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Booking Berhasil!</h1>
                <p class="text-gray-600 mb-6">Booking servis Anda telah berhasil dibuat dan sedang menunggu konfirmasi dari
                    bengkel.</p>

                <div class="bg-gray-50 rounded-xl p-4 mb-6 text-left">
                    <h3 class="font-semibold text-gray-800 mb-2">Detail Booking</h3>
                    <p class="text-sm text-gray-600"><strong>Kode Booking:</strong> #{{ $booking->id }}</p>
                    <p class="text-sm text-gray-600"><strong>Bengkel:</strong> {{ $booking->workshop->name }}</p>
                    <p class="text-sm text-gray-600"><strong>Kendaraan:</strong> {{ $booking->vehicle->brand }}
                        {{ $booking->vehicle->model }}</p>
                    <p class="text-sm text-gray-600"><strong>Tanggal:</strong>
                        {{ $booking->booking_date->format('d M Y H:i') }}</p>
                    <p class="text-sm text-gray-600"><strong>Status:</strong>
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Menunggu
                            Konfirmasi</span>
                    </p>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('homepage') }}"
                        class="block w-full bg-primary text-white py-3 rounded-lg font-medium hover:bg-secondary transition">
                        Kembali ke Beranda
                    </a>
                    <a href="{{ route('profile.bookings') }}"
                        class="block w-full border border-gray-300 text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-50 transition">
                        Lihat Booking Saya
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
