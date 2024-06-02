@extends('layouts.app')

@section('title', 'presensi')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="section-header">
                    <h1>Presensi - {{ Auth::user()->role }}</h1>
                </div>
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($alreadyPresensi)
                    <div class="alert alert-info">
                        You have already submitted attendance today.
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Presensi</h4>
                        </div>
                        <form action="{{ route('presensi.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="kondisi">Kondisi</label>


                                    <select id="kondisi" class="form-control" name="kondisi">
                                        <option selected>Choose...</option>
                                        <option value="sehat">Sehat</option>
                                        <option value="tidak_sehat">tidak_sehat</option>
                                    </select>

                                    {{-- <select type="text" class="form-control" id="kondisi" name="kondisi"
                                        placeholder="Kondisi"> --}}
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="keterangan">Keterangan :</label>
                                        <select id="keterangan" class="form-control" name="keterangan">
                                            <option selected>Choose...</option>
                                            <option value="WFO">WFO</option>
                                            <option value="WFH">WFH</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="shift">Shift :</label>
                                        <select id="shift" class="form-control" name="shift">
                                            <option selected>Choose...</option>
                                            @foreach ($timeshifts as $timeshift)
                                                <option value="{{ $timeshift->id }}">{{ $timeshift->shift }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jobdesk">Job Description</label>
                                    <textarea class="form-control" style="resize: none" data-height="150" id="jobdesk" name="jobdesk"
                                        placeholder="Job Description/Plan"></textarea>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button class="btn btn-primary">Presensi</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->

    <!-- Page Specific JS File -->
@endpush
