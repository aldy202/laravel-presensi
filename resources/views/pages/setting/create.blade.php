@extends('layouts.app')

@section('title', 'Add User')

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
                <h1>Form Shift</h1>
            </div>

            <div class="section-body">



                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Shift Add</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('timeshifts.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group row mb-4">
                                        <label for="presensi_mulai"
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Presensi
                                            Start</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="time" class="form-control" name="presensi_mulai"
                                                id="presensi_mulai">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="presensi_selesai"
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Presensi
                                            End</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="time" class="form-control" name="presensi_selesai"
                                                id="presensi_selesai">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                            for="shift">Shift</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="shift" id="shift">
                                                <option selected>Options...</option>
                                                <option value="Pagi">Pagi</option>
                                                <option value="Siang">Siang</option>
                                                <option value="Malam">Malam</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
