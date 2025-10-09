@extends('layouts.app')

@section('title', 'Contact - Components Demo')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="theme-demo {{ $theme === 'dark' ? 'bg-dark border-light' : 'bg-white border' }} mb-4">
                <h1 class="mb-4">Contact- Blade Components</h1>
                <p class="lead">Halaman ini mendemonstrasikan penggunaan <strong>Blade Components</strong> dengan props dan slots.</p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card {{ $theme === 'dark' ? 'bg-dark border-light' : '' }} h-100">
                        <div class="card-header">
                            <h5>Informasi Kontak</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Email:</strong> JelitaAnggraini562@gmail.com</p>
                            <p><strong>Telepon:</strong> +62 831 1311 8514</p>
                            <p><strong>Alamat:</strong> Tebing Tinggi, Indonesia</p>

                            <h6 class="mt-4">Department Tersedia:</h6>
                            <ul>
                                @foreach($departments as $dept)
                                    <li>{{ $dept }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
