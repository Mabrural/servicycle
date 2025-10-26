@extends('homepage.layouts.main')

@section('container')
<style>
    .success-hero {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }
    
    .checkmark {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    
    .checkmark i {
        font-size: 40px;
        color: #10b981;
    }
</style>

<section class="success-hero text-white py-12 md:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="checkmark">
            <i class="fas fa-check"></i>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Booking Berhasil!</h1>
        <p class="text-lg text-green-100 mb-8">
            Terima kasih telah melakukan booking servis di ServiCycle
        </p>
    </div>
</section>

<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Detail Booking</h2>
            
            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">Informasi Booking</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kode Booking</span>
                                <span class="font-medium">#{{ $booking->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status</span>
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal Booking</span>
                                <span class="font-medium">{{ $booking->created_at->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">Jadwal Servis</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal Servis</span>
                                <span class="font-medium">{{ $booking->booking_date->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Waktu</span>
                                <span class="font-medium">{{ $booking->booking_date->format('H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">Bengkel Tujuan</h3>
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-tools text-indigo-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">{{ $booking->workshop->name }}</h4>
                                <p class="text-sm text-gray-600 mt-1">{{ $booking->workshop->address }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">Kendaraan</h3>
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-car text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">
                                    {{ $booking->vehicle->brand }} {{ $booking->vehicle->model }}
                                </h4>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $booking->vehicle->license_plate }} • {{ $booking->vehicle->year }}
                                </p>
                            </div>
                        </div>
                    </div>

                    @if($booking->notes)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">Catatan Servis</h3>
                        <p class="text-gray-600 bg-yellow-50 p-3 rounded-lg">{{ $booking->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('workshops.show', $booking->workshop_id) }}" 
                       class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-indigo-700 transition-all duration-300 text-center">
                        <i class="fas fa-tools mr-2"></i>Lihat Bengkel
                    </a>
                    <a href="{{ url('/') }}" 
                       class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-300 transition-all duration-300 text-center">
                        <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection