@extends('admin.layouts.master')

@section('title', 'Tổng quan hệ thống')
@section('page-title', 'Bảng Điều Khiển')

@section('content')
@extends('admin.layouts.master')

@section('title', 'Tổng quan hệ thống')
@section('page-title', 'Bảng Điều Khiển')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-info">
            <div class="inner">
                <h3>{{ $totalPosts }}</h3>
                <p>Tổng số Bài viết</p>
            </div>
            <i class="small-box-icon fas fa-newspaper"></i>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-success">
            <div class="inner">
                <h3>{{ $totalCategories }}</h3>
                <p>Tổng số Danh mục</p>
            </div>
            <i class="small-box-icon fas fa-list"></i>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-warning">
            <div class="inner">
                <h3>{{ $draftPosts }}</h3>
                <p>Bài viết Lưu nháp</p>
            </div>
            <i class="small-box-icon fas fa-edit"></i>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-danger">
            <div class="inner">
                <h3>{{ $totalViews }}</h3>
                <p>Tổng lượt xem</p>
            </div>
            <i class="small-box-icon fas fa-chart-line"></i>
        </div>
    </div>
</div>
@endsection
@endsection