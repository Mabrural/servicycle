<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bengkel Terdekat</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        #status {
            text-align: center;
            color: #666;
            margin-bottom: 20px;
        }
        .workshop-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        .card {
            background: white;
            padding: 15px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s ease;
        }
        .card:hover {
            transform: translateY(-4px);
        }
        .name {
            font-size: 18px;
            font-weight: bold;
            color: #222;
        }
        .address {
            color: #555;
            font-size: 14px;
            margin: 5px 0;
        }
        .distance {
            font-weight: bold;
            color: #0066cc;
        }
    </style>
</head>
<body>
    <h2>Daftar Bengkel</h2>
    <p id="status">Mengambil lokasi Anda...</p>

    <div class="workshop-list" id="workshopList">
        @foreach ($workshops as $workshop)
            <div class="card" 
                data-lat="{{ $workshop->latitude }}" 
                data-lng="{{ $workshop->longitude }}">
                <div class="name">{{ $workshop->name }}</div>
                <div class="address">{{ $workshop->address ?? '-' }}</div>
                <div class="distance">Jarak: menghitung...</div>
            </div>
        @endforeach
    </div>

    <script>
        // Hitung jarak menggunakan formula haversine
        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Radius bumi dalam KM
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                      Math.cos(lat1 * Math.PI / 180) *
                      Math.cos(lat2 * Math.PI / 180) *
                      Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c; // hasil km
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;

                document.getElementById('status').textContent = 'Lokasi berhasil didapatkan ✅';

                const cards = Array.from(document.querySelectorAll('.card'));

                // Hitung jarak setiap bengkel
                cards.forEach(card => {
                    const lat = parseFloat(card.dataset.lat);
                    const lng = parseFloat(card.dataset.lng);
                    const distance = calculateDistance(userLat, userLng, lat, lng);
                    card.querySelector('.distance').textContent = `Jarak: ${distance.toFixed(2)} km`;
                    card.dataset.distance = distance;
                });

                // Urutkan berdasarkan jarak terdekat
                const sorted = cards.sort((a, b) => a.dataset.distance - b.dataset.distance);

                const container = document.getElementById('workshopList');
                container.innerHTML = '';
                sorted.forEach(c => container.appendChild(c));

            }, () => {
                document.getElementById('status').textContent = 'Gagal mendapatkan lokasi 😢';
            });
        } else {
            document.getElementById('status').textContent = 'Browser Anda tidak mendukung geolocation.';
        }
    </script>
</body>
</html>
