@extends('homepage.layouts.main')

@section('container')
    @include('homepage.layouts.location-permission')
    
    @include('homepage.layouts.navbar')

    @include('homepage.layouts.bottom-nav')

    @include('homepage.layouts.hero')

    @include('homepage.layouts.workshop-nearby')

    @include('homepage.layouts.main-feature')

    @include('homepage.layouts.promo')

    @include('homepage.layouts.join-mitra')

    @include('homepage.layouts.how-it-work')

    @include('homepage.layouts.testimoni')

    @include('homepage.layouts.faq')

    @include('homepage.layouts.stats')

    @include('homepage.layouts.cta')
@endsection
