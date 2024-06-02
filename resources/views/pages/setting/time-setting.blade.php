@extends('layouts.app')

@section('title', 'Users')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Time-Shift-Setting</h1><div class="section-header-button">
                    <a href="{{ route('timeshifts.create') }}" class="btn btn-primary">Add Shift</a>
                </div>
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
                            <div class="card-header">
                                <h4>Time-Shift-Setting</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-bordered table-md table">
                                        <tr>
                                            <th>No</th>
                                            <th>Shift</th>
                                            <th>Presensi Start</th>
                                            <th>Presensi End</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($timeshifts as $shift)
                                        <tr>

                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $shift->shift }}</td>
                                                <td>{{ $shift->presensi_mulai }}</td>
                                                <td>{{ $shift->presensi_selesai }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-left">
                                                        <a href='{{ route('timeshifts.edit', $shift->id) }}'
                                                            class="btn btn-sm btn-info btn-icon btn-none">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>
                                                        
                                                    </div>

                                                </td>

                                            </tr>
                                            @endforeach

                                    </table>
                                </div>
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
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.confirm-delete').on('click', function(e) {
                e.preventDefault(); // Prevent the form from submitting normally
                var form = $(this).closest('form'); // Find the parent form
                var product_id = form.attr('action').split('/')
                var product_name = $(this).attr('data-nama');// Get the product ID from the form action
                swal({
                        title: "Apakah kamu yakin ?",
                        text: "Shift yang di hapus adalah shift "+ product_name +"",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            // If user confirms, submit the form
                            form.submit();
                        } else {
                            swal("Your shift is safe!");
                        }
                    });
            });
        });
    </script>
@endpush
