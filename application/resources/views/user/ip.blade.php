@extends('layouts.app')

@section('page_title', __('Active Session'))

@section('page')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-auto">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Nhận vị trí người dùng hiện tại') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                @if ($currentUserInfo)
                                    <h4>IP: {{ $currentUserInfo->ip }}</h4>
                                    <h4>Tên Quốc Gia: {{ $currentUserInfo->countryName }}</h4>
                                    <h4>Mã Quốc Gia: {{ $currentUserInfo->countryCode }}</h4>
                                    <h4>Mã vùng: {{ $currentUserInfo->regionCode }}</h4>
                                    <h4>Tên khu vực: {{ $currentUserInfo->regionName }}</h4>
                                    <h4>Tên thành phố: {{ $currentUserInfo->cityName }}</h4>
                                    <h4>Mã Bưu Chính: {{ $currentUserInfo->zipCode }}</h4>
                                    <h4>Vĩ độ: {{ $currentUserInfo->latitude }}</h4>
                                    <h4>Kinh độ: {{ $currentUserInfo->longitude }}</h4>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
