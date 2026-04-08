@extends('frontend.layouts.master')

@section('title', 'Profile - F1 News')

@section('content')
    <div class="bg-dark text-white p-4 p-md-5 rounded-3 border border-secondary">
        <div class="mb-4">
            <h1 class="h3 mb-2">{{ __('Trang Cá Nhân') }}</h1>
            <p class="text-secondary mb-0">{{ __('Quản lý tài khoản') }}</p>
        </div>

        <div class="d-flex flex-column gap-4">
            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.update-password-form')
            @include('profile.partials.delete-user-form')
        </div>
    </div>
@endsection
