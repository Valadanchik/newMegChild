@extends('admin.layout.layout')

@section('admin.content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xxl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="book"></i></div>
                                Accessors
                            </h1>
                            <div class="page-header-subtitle mt-4">
                                <a href="{{ url('fs-admin/accessors/create ') }}" class="btn btn-outline-light" type="button">+ Add new Accessor</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xxl px-4 mt-n10">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-header">Accessors list</div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>In Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($accessors as $index => $accessor)
                            <tr>
                                <td>{{ $accessor['title_' . app()->getLocale()]  }}</td>
                                <td>{{ $accessor['price'] }} ֏</td>
                                <td>{{ $accessor['in_stock'] }}</td>
                                <td>{{ $accessor['status'] ? 'Public' : 'Private'}}</td>
                                <td>
                                    <a href="{{ url('fs-admin/accessors/' . $accessor['id'] . '/edit' ) }}" class="bi-pencil btn btn-datatable btn-icon btn-transparent-dark me-2">
                                        <i class="fa-regular fa-edit"></i>
                                    </a>
                                    <form style="display: inline-block" action="{{ route('accessors.destroy', $accessor['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="btn btn-datatable btn-icon btn-transparent-dark me-2" type="submit" onclick="return confirm('Are you sure you want to delete this model?')"> <i class="bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
