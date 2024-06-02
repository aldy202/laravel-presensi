@extends('layouts.app')

@section('title', 'Attendance History')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Attendance History</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="{{ route('presensi.history') }}">
                                        <div class="input-group">
                                            <input type="date" class="form-control" placeholder="Search by Date" name="date" value="{{ request('date') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <tr>
                                            <th>Date</th>
                                            <th>Shift</th>
                                            <th>Presensi Time</th>
                                            <th>Condition</th>
                                            <th>Description</th>
                                            <th>Job Description</th>
                                        </tr>
                                        @forelse($presensiHistory as $presensi)
                                            <tr>
                                                <td>{{ $presensi->tgl_absen }}</td>
                                                <td>{{ $presensi->timeshift->shift }}</td>
                                                <td>{{ $presensi->masuk }}</td>
                                                <td>{{ $presensi->kondisi }}</td>
                                                <td>{{ $presensi->keterangan }}</td>
                                                <td>{{ $presensi->jobdesk }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">No attendance records found.</td>
                                            </tr>
                                        @endforelse
                                    </table>
                                </div>
                                {{-- <div class="float-right">
                                    {{ $presensiHistory->links() }}
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
@endpush
