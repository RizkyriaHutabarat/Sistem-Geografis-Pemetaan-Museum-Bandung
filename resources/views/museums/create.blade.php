@extends ('adminlte::page')

@section('title', 'Data Museum')

@section('content_header')
<h1 class="m-0 text-dark">Tambah Museum</h1>
@stop

@section('content')
<form action="{{route('museums.store')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body" style="overflow: auto">

                    <table style="width: 100%">
                        <tr>
                            <td><label for="LabelNama">Nama Museum</label></td>
                            <td><input type="text" size="70" id="InputNama" placeholder="Nama Museum" name="namamuseum"></td>
                        </tr>
                        <tr>
                            <td><label for="LabelAlamat">Alamat Museum</label></td>
                            <td><input type="text" size="70" id="InputAlamat" placeholder="Alamat" name="alamat"></td>
                        </tr>
                        <tr>
                            <td><label for="LabelLatitude">Latitude</label></td>
                            <td><input type="text" size="70" id="InputLatitude" placeholder="Latitude" name="latitude"></td>
                        </tr>
                        <tr>
                            <td><label for="LabelLongitude">Longitude</label></td>
                            <td><input type="text" size="70" id="InputLongitude" placeholder="Longitude" name="longitude"></td>
                        </tr>
                        <tr>
                            <td><label for="LabelJamBuka">Jam Buka</label></td>
                            <td><input type="text" size="70" id="InputJamBuka" placeholder="Jam Buka" name="jambuka"></td>
                        </tr>
                        <tr>
                            <td><label for="LabelJamBuka">Jam Tutup</label></td>
                            <td><input type="text" size="70" id="InputJamTutup" placeholder="Jam Tutup" name="jamtutup"></td>
                        </tr>
                        <tr>
                            <td><label for="LabelBiayaMasuk">Biaya Masuk</label></td>
                            <td><input type="text" size="70" id="InputBiayaMasuk" placeholder="Biaya Masuk" name="biayamasuk"></td>
                        </tr>
                    </table>

                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

                    <!-- Make sure you put this AFTER Leaflet's CSS -->
                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="">
                    </script>

                    <style>
                        #map {
                            height: 350px;
                        }
                    </style>

                    <div id="map"></div>


                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('museums.index')}}" class="btn btn-danger">Batal</a>
                </div>

            </div>
        </div>
    </div>
</form>
@stop

@push('js')
<script>
    var map = L.map('map').setView([-6.896622307758006, 107.61637411076796], 19);

    // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     maxZoom: 19,
    //     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    // }).addTo(map);

    ////-- google tiles ----

    // Hybrid: s,h;
    // Satellite: s;
    // Streets: m;
    // Terrain: p;

    L.tileLayer('https://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', { // // L.TileLayer, yaitu lapisan Leaflet yang menampilkan ubin peta
        maxZoom: 50,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'] // //  Opsi ini menentukan URL subdomain yang digunakan untuk memuat ubin. Menggunakan lebih dari satu subdomain
    }).addTo(map);

    //Define a click event handler marker
    var marker; //variable to store the marker
    function onMapClick(e) {
        document.getElementById('InputLatitude').value = e.latlng.lat;
        document.getElementById('InputLongitude').value = e.latlng.lng;

        if (marker) {
            map.removeLayer(marker); // // menghapus penanda lama dari peta
        }

        marker = L.marker(e.latlng).addTo(map) // // membuat penanda baru dan menambahkannya ke peta
            .bindPopup("Koordinat: " + e.latlng.toString()) // //  Baris ini menambahkan pop-up ke penanda. Pop-up berisi informasi tentang koordinat penanda.
            .openPopup(); // // Baris ini membuka pop-up.

    }
    // Add a click event listener to the map
    map.on('click', onMapClick);

    //POLYLINE
    // var marker; 
    // var linearray = [];
    // var polyline;

    // map.on('click', function onMapClick(e) {
    //     latitude = e.latlng.lat; // //mengambil lintang dan bujur dari titik yang diklik dan menyimpannya ke dalam variabel latitude dan longitude
    //     longitude = e.latlng.lng;
    //     if (!marker) {
    //         document.getElementById('InputLatitude').value = latitude;
    //         document.getElementById('InputLongitude').value = longitude;
    //     }
    //     // document.getElementById('InputLatitude').value = latitude; // // memperbarui nilai fiels dengan id 
    //     // document.getElementById('InputLongitude').value = longitude;

    //     linearray.push([latitude, longitude]); // // koordinat yang diklik akan ditambahkan ke dalam linearray. linearray akan mengumpulkan koordinat yang diperoleh kemudian akan dihubungkan titiktitik tersebut

    //     marker = L.marker([latitude, longitude]).addTo(map); // // sebuah penanda dibuat dilokasi yang dilik dan ditambahkan ke peta
    //     polyline = L.polyline(linearray, {
    //         color: 'red'
    //     }).addTo(map); // // polyline akan diperbarui dengan titik baru dilokasi yang dilik dan ditambahkan ke dalam peta
    // });

    // polygon 
    //  var marker;
    // var linearray = [];
    // var polygon;

    // map.on('click', function onMapClick(e) {
    //     latitude = e.latlng.lat;
    //     longitude = e.latlng.lng;

    //     // if (marker != null) {
    //     //     document.getElementById('InputLatitude').value = latitude;
    //     //     document.getElementById('InputLongitude').value = longitude;
    //     // }

    //     document.getElementById('InputLatitude').value = latitude;
    //     document.getElementById('InputLongitude').value = longitude;

    //     linearray.push([latitude, longitude]);

    //     marker = L.marker([latitude, longitude]).addTo(map);
    //     polygon = L.polygon(linearray, {
    //         color: 'red'
    //     }).addTo(map);
    // });

    //circle
    // var marker;
    // var circle;
    
    // map.on('click', function onMapClick(e) {
    //     latitude = e.latlng.lat;
    //     longitude = e.latlng.lng;
    //     document.getElementById('InputLatitude').value = latitude;
    //     document.getElementById('InputLongitude').value = longitude;
    
    //         if (marker) {
    //         map.removeLayer(marker);
    //     }

    //     // Menghapus lingkaran jika sudah ada sebelumnya
    //     if (circle) {
    //         map.removeLayer(circle);
    //     }

    //     marker = L.marker([latitude, longitude]).addTo(map);
    //     circle = L.circle([latitude, longitude], {color: 'green', radius: 500}).addTo(map);
    // });

</script>
@endpush