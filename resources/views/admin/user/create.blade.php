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
                                Create User
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary" href="{{ route('users.index') }}">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Back to All Users
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

            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row gx-4">
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">Email</div>
                            <div class="card-body">
                                <input class="form-control" name="email" id="inputLoginAddress" type="email" value="{{ old('email') }}" />
                                @error('email')
                                <span class="text-danger text-left">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Name</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Password</div>
                            <div class="card-body">
                                <input name="password" class="form-control" id="inputPassword" type="password" value="{{ old('password') }}" />
                                @error('password')
                                <span class="text-danger text-left">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Roles</div>
                            <div class="card-body">
                                @foreach($roles as $role)
                                    <div class="ml-4">
                                        <input class="form-check-input" type="radio" name="role_id" value="{{$role->id}}"
                                               @if(is_array(old('role_id')) && in_array($role->id, old('role_id'))) checked @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{$role->{'name'} }}
                                        </label>
                                    </div>
                                @endforeach

                                @error('role_id')
                                <div style="color: red" class="required--error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-grid"><button class="fw-500 btn btn-primary">Create</button></div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
