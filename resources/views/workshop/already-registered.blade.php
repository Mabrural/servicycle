@extends('layouts.main')

@section('container')
<div class="min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-green-600 text-white rounded-xl shadow-lg p-6 md:p-8 mb-6">
            <div class="flex items-start md:items-center flex-col md:flex-row">
                <div class="bg-white/20 w-12 h-12 rounded-full flex items-center justify-center mr-4 mb-4 md:mb-0">
                    <i class="fas fa-check text-xl"></i>
                </div>
                <div class="text-center md:text-left flex-1">
                    <h2 class="text-2xl font-bold mb-1">Bengkel Sudah Terdaftar</h2>
                    <p class="text-white/90">Anda sudah pernah mendaftarkan bengkel sebelumnya</p>
                </div>
            </div>
            
            <div class="bg-white/10 rounded-lg p-4 mt-4">
                <h3 class="font-semibold mb-2">Informasi Bengkel Anda:</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="bg-white/10 rounded p-2">
                        <p class="text-white/70 text-xs">Nama Bengkel</p>
                        <p class="font-semibold">{{ $workshop->name }}</p>
                    </div>
                    <div class="bg-white/10 rounded p-2">
                        <p class="text-white/70 text-xs">Jenis Bengkel</p>
                        <p class="font-semibold">{{ implode(', ', $workshop->types) }}</p>
                    </div>
                    <div class="bg-white/10 rounded p-2">
                        <p class="text-white/70 text-xs">Alamat</p>
                        <p class="font-semibold">{{ $workshop->address }}</p>
                    </div>
                    <div class="bg-white/10 rounded p-2">
                        <p class="text-white/70 text-xs">Telepon</p>
                        <p class="font-semibold">{{ $workshop->phone }}</p>
                    </div>
                    <div class="bg-white/10 rounded p-2">
                        <p class="text-white/70 text-xs">Status</p>
                        <p class="font-semibold capitalize">{{ $workshop->status }}</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-4">
                <a href="{{ route('workshop.show', $workshop->id) }}" 
                   class="bg-white text-green-600 px-6 py-3 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300 text-center">
                    <i class="fas fa-eye mr-2"></i>Lihat Detail Bengkel
                </a>
                <button onclick="requestEdit()" 
                        class="bg-white/20 text-white px-6 py-3 rounded-lg font-medium hover:bg-white/30 transition-all duration-300 text-center">
                    <i class="fas fa-edit mr-2"></i>Ajukan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function requestEdit() {
    const reason = prompt('Mohon jelaskan alasan perubahan data bengkel:');
    if (reason) {
        fetch('/api/request-edit', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ reason: reason })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim permohonan perubahan.');
        });
    }
}
</script>
@endsection