@extends('adminlte::page')

@section('title', 'Data Museum')

@section('content_header')
    <h1 class="m-0 text-dark">Data Museum</h1>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3>{{ $museum->namamuseum }}</h3>
                    <p>Alamat: {{ $museum->alamat }}</p>
                    <p dataLongitude="{{ $museum->longitude }}">Longitude: {{ $museum->longitude }}</p>
                    <p dataLatitude="{{ $museum->latitude }}">Latitude: {{ $museum->latitude }}</p>
                    <p>Jam Buka: {{$museum->jambuka}}</p>
                    <p>Jam Tutup: {{$museum->jamtutup}}</p>
                    <p>Biaya Masuk: {{$museum->biayamasuk}}</p>
                    <a href="{{ route('museums.index') }}" class="btn btn-primary" style="margin-bottom: 20px;">Kembali</a>

                    <div style="height: 400px;" id="map"></div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        var latitude = document.querySelector('p[dataLatitude]').getAttribute('dataLatitude');
        var longitude = document.querySelector('p[dataLongitude]').getAttribute('dataLongitude');

        var map = L.map('map').setView([latitude,longitude], 17);

        var marker = L.marker([latitude,longitude]).addTo(map);
        L.tileLayer('https://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 19,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);
    </script>
@endpush