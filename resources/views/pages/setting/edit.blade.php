@extends('layouts.app')

@section('title', 'Edit User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Shift</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Users</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Shift</h2>
                <div class="card">
                    <form action="{{ route('timeshifts.update', $timeshift) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Input Text</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label for="shift"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Shift</label>
                                <div class="col-sm-12 col-md-7">

                                    <input type="text"
                                        class="form-control @error('shift')
                                is-invalid
                            @enderror"
                                        name="shift" value="{{ $timeshift->shift }}" disabled>
                                    @error('shift')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="presensi_mulai"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Presensi
                                    Start</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="time"
                                        class="form-control @error('presensi_mulai') is-invalid
                                    @enderror"
                                        name="presensi_mulai" id="presensi_mulai" value="{{ $timeshift->presensi_mulai }}">
                                    @error('presensi_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="presensi_selesai"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Presensi
                                    End</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="time"
                                        class="form-control @error('presensi_selesai') is-invalid
                                    @enderror"
                                        name="presensi_selesai" id="presensi_selesai"
                                        value="{{ $timeshift->presensi_selesai }}">
                                    @error('presensi_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
