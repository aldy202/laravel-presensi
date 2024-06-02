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
                <h1>Users</h1>
                <div class="section-header-button">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Add New</a>
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

                            <div class="card-body">

                                <div class="float-right">
                                    <form method="GET" action="{{ route('users.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
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

                                            <th>Name</th>
                                            <th>username</th>
                                            <th>Role</th>

                                            <th>Action</th>
                                        </tr>
                                        @foreach ($users as $user)
                                            <tr>

                                                <td>{{ $user->name }}
                                                </td>
                                                <td>
                                                    {{ $user->username }}
                                                </td>
                                                <td>
                                                    {{ $user->role }}
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-left">
                                                        <a href='{{ route('users.edit', $user->idpegawai) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>

                                                        <form id="deleteForm"
                                                            action="{{ route('users.destroy', $user->idpegawai) }}"
                                                            method="POST" class="ml-2">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete" data-nama="{{ $user->name }}">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $users->withQueryString()->links() }}
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
                        text: "User yang di hapus adalah "+ product_name +"",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            // If user confirms, submit the form
                            form.submit();
                        } else {
                            swal("Your user is safe!");
                        }
                    });
            });
        });
    </script>
@endpush
