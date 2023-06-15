@extends('admin.layout.layout')

@section('admin.content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="users"></i></div>
                                Media
                            </h1>
                            <div class="page-header-subtitle mt-4"><a href="{{ url('fs-admin/medias/create ') }}" class="btn btn-outline-light" type="button">+ Add new media</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
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
                <div class="card-header">Media list</div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th>Title hy</th>
                            <th>Title en</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Title hy</th>
                            <th>Title en</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($medias as $index => $media)
                            <tr>
                                <td>{{ $media['title_hy']  }}</td>
                                <td>{{ $media['title_en']  }}</td>
                                <td>
                                    <a href="{{ url('fs-admin/medias/' . $media['id'] . '/edit' ) }}" class="btn btn-datatable btn-icon btn-transparent-dark me-2">
                                        <i class="fa-regular fa-edit"></i>
                                    </a>
                                    <form style="display: inline-block" action="{{ route('medias.destroy', $media['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="btn btn-datatable btn-icon btn-transparent-dark me-2" type="submit" onclick="return confirm('Are you sure you want to delete this model?')"> <i class="fa-regular fa-trash-can"></i></button>
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
