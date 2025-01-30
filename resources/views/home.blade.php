@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="mt-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @foreach (range(1, 10) as $i)
            <div class="col">
                <div class="card shadow-lg h-100">
                    <div class="card-body position-relative">
                        <span class="badge bg-danger position-absolute top-0 start-50 translate-middle">Featured</span>
                        <h5 class="card-title mt-3">Card Title {{ $i }}</h5>
                        <p class="card-text">This is a brief description of the card content. It provides information
                            about the card.</p>
                        <button class="btn btn-success w-100">Read More</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
