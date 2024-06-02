@extends('layouts.app')

@section('title', 'All Attendance Records')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>All Attendance Records</h1>

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
                                <div class="float-left">
                                <a href="{{ route('presensi.export') }}" class="btn btn-primary"><i class="fas fa-download"></i> Download
                                    Excel</a>
                            </div>
                                <div class="float-right">
                                    <form method="GET" action="{{ route('presensi.historyAll') }}">
                                        <div class="input-group">
                                            <input type="date" class="form-control" placeholder="Search by Date"
                                                name="date" value="{{ request('date') }}">
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
                                            <th>Employee Name</th>
                                            <th>Shift</th>
                                            <th>Presensi Time</th>
                                            <th>Condition</th>
                                            <th>Description</th>
                                            <th>Job Description</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse($presensiHistory as $presensi)
                                            <tr>
                                                <td>{{ $presensi->tgl_absen }}</td>
                                                <td>{{ $presensi->user->name }}</td>
                                                <td>{{ $presensi->timeshift->shift }}</td>
                                                <td>{{ $presensi->masuk }}</td>
                                                <td>{{ $presensi->kondisi }}</td>
                                                <td>{{ $presensi->keterangan }}</td>
                                                <td>{{ $presensi->jobdesk }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-left">
                                                        <form id="deleteForm"
                                                            action="{{ route('presensi.destroy', $presensi->id_absen) }}"
                                                            method="POST" class="ml-2">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete" data-nama="{{ $presensi->user->name }}">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.confirm-delete').on('click', function(e) {
                e.preventDefault(); // Prevent the form from submitting normally
                var form = $(this).closest('form'); // Find the parent form
                var product_id = form.attr('action').split('/')
                var product_name = $(this).attr('data-nama');// Get the product ID from the form action
                swal({
                        title: "Apakah kamu yakin ?",
                        text: "Data Presensi yang di hapus adalah "+ product_name +"",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            // If user confirms, submit the form
                            form.submit();
                        } else {
                            swal("Your data is safe!");
                        }
                    });
            });
        });
    </script>
@endpush
