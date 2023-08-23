@extends('admin.layout.layout')

@section('admin.content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xxl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="users"></i></div>
                                Settings
                            </h1>
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
                <form style="display: inline-block" action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-header">Settings list</div>
                    <div class="card-body">
                        <table id="datatablesSimpleSettings" style="width: 100%; max-width: 800px">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Value</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allSettings as $index => $item)

                                <tr>
                                    <td>{{ $item['key'] }}</td>
                                    <td>
                                        <div class="card-body">
                                            <input type="text" class="form-control" name="{{ $item['slug'] }}"
                                                   id="{{ $item['slug'] }}" value="{{ $item['value'] }}">
                                        </div>

                                        @error($item['slug'])
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-blue me-2" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
