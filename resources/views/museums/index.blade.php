@extends('adminlte::page')

@section('title', 'Data Museum')

@section('content_header')
<div class="card bg-warning text-white">
    <div class="card-body text-center">
        <h1>DATA LOKASI MUSEUM DI BANDUNG</h1>
        <br>
        <h3>{{ \App\Models\MUSEUM::count() }} Lokasi</h3>
    </div>
    
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session('success_message'))
                        <div class="alert alert-success">
                            {{session('success_message')}}
                        </div>
                    @endif

                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
                            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
                            crossorigin=""/>

                        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
                            crossorigin=""></script>
                    <!-- Elemen untuk peta -->
                    <div id="map" style="width:100%; height:500px;"></div>

                    <style>
                        #map { width: 100%;
                        height: 500px;
                        top: 0; /* Adjust this value based on your layout and preferences */ }
                    </style>
                    <!-- Akhir Elemen untuk peta -->
                    <br>

                    <table class="table table-hover table-bordered table-striped" id="example2"">
                        <thead>
                        <tr>
                                <th>Nama Museum</th>
                                <th>Alamat</th>
                                <th>Longitude</th>
                                <th>Latitude</th>
                                <th>Jam Buka</th>
                                <th>Jam Tutup</th>
                                <th>Biaya Masuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($museums as $key => $museum)
                                <tr>
                                    <td>{{ $museum->namamuseum }}</td>
                                    <td>{{ $museum->alamat }}</td>
                                    <td>{{ $museum->longitude }}</td>
                                    <td>{{ $museum->latitude }}</td>
                                    <td>{{ $museum->jambuka }}</td>
                                    <td>{{ $museum->jamtutup }}</td>
                                    <td>{{ $museum->biayamasuk }}</td>
                                    <td>
                                <a href="{{ route('museums.show', $museum->id) }}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>

                                <a href="{{ route('museums.edit', $museum->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                
                                <form action="{{ route('museums.destroy', $museum->id) }}" id="delete-form-{{ $museum->id }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $museum->id }}')">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <p class="mb-0"></p>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Inisialisasi peta menggunakan Leaflet
        var map = L.map('map').setView([-6.900707, 107.615868], 13); // Set initial view to a default location (e.g., Jakarta)

        // Menambahkan layer peta dari Google Maps menggunakan Leaflet
        L.tileLayer('https://{s}.google.com/vt?/lyrs=p&x={x}&y={y}&z={z}', {
            maxZoom: 19,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        // Menambahkan marker untuk setiap Museum di dalam database
        @foreach ($museums as $museum)
            var marker = L.marker([{{ $museum->latitude }}, {{ $museum->longitude }}]).addTo(map);
            marker.bindPopup("<b>{{ $museum->namamuseum }}</b><br>Alamat : {{ $museum->alamat }}<br>Jam Buka : {{ $museum->jambuka }}<br>Jenis Tutup : {{ $museum->jamtutup }}<br>Biaya Masuk : {{ $museum->biayamasuk }}<br>latitude : {{ $museum->latitude }}<br>Longitude : {{ $museum->longitude }}").openPopup();
        @endforeach

        // Menangkap event klik pada peta
        map.on('click', function onMapClick(e) {
            // Mendapatkan koordinat dari event klik
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            // Mengisi nilai input latitude dan longitude
            document.getElementById('InputLatitude').value = lat;
            document.getElementById('InputLongitude').value = lng;
        });
    </script>


    <script>
        function confirmDelete(museumId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Anda tidak dapat mengembalikan data yang sudah dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Trigger the form submission for delete
                    document.getElementById('delete-form-' + museumId).submit();
                }
            });
        }
    </script>
@endpush