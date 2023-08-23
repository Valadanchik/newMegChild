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
                                edit user
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary" href="{{ route('users.index') }}">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Back to All users
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

            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row gx-4">
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">Email</div>
                            <div class="card-body">
                                <input class="form-control" name="email" id="inputLoginAddress" type="login" value="{{ old('email', $user->email) }}" placeholder="Enter user email" />
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Name</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ old('name', $user->name) }}">
                            </div>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Password</div>
                            <div class="card-body">
                                <input name="password" class="form-control" id="inputPassword" type="password" value="" placeholder="Enter password" />
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Roles</div>
                            <div class="card-body">
                                @foreach($roles as $role)
                                    <div class="ml-4">
                                        <input class="form-check-input" type="radio" name="role_id" value="{{ $role->id }}"
                                               @if((is_array(old('role_id')) && in_array($role->id, old('role_id'))) || ($role->id == ($user->role->id ?? false))) checked @endif>
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
                        <div class="d-grid"><button class="fw-500 btn btn-primary">Update</button></div>
                    </div>

                </div>
            </form>
        </div>
    </main>
@endsection
