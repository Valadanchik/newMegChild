@extends('admin.layout.layout')

@section('admin.content')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="file-plus"></i></div>
                                Create Category
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary" href="{{ route('categories.index') }}">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Back to All Categories
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-fluid px-4">
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
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row gx-4">
                    <div class="col-lg-6">

                        <div class="card mb-4">
                            <div class="card-header">Type</div>
                            <div class="card-body">
                                <div class="ml-4">
                                    <input class="form-check-input" type="radio" name="type" value="book" checked
                                           @if((!old('type') === 'book') ) checked @endif >
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Book
                                    </label>
                                </div>
                                <div class="ml-4">
                                    <input class="form-check-input" type="radio" name="type" value="accessor"
                                           @if((old('type') === 'accessor')) checked @endif>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Accessor
                                    </label>
                                </div>
                                @error('type')
                                <div style="color: red" class="required--error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="card mb-4">
                            <div class="card-header">Name (Hy)</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="name_hy" name="name_hy"
                                       value="{{ old('name_hy') }}">
                            </div>
                            @error('name_hy')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">Name (En)</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en') }}">
                            </div>
                            @error('name_en')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">Age</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="age" name="age" value="{{ old('age') }}">
                            </div>
                            @error('age')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button class="fw-500 btn btn-primary">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
