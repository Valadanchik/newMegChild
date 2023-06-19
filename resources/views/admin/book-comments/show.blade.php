@extends('admin.layout.layout')

@section('admin.content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="book"></i></div>
                                <strong>Book Name: </strong> {{ $comment['book']['title_' . app()->getLocale() ] }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-body">
                    @if($gerActivateMessage)
                        <div class="alert alert-success">
                            {{ $gerActivateMessage }}
                        </div>
                    @endif
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
                    <div>
                        <p><strong>User Full Name:</strong> <span>{{ $comment->full_name }}</span></p>
                        <p><strong>Email:</strong> <span>{{ $comment->email }}</span></p>
                        <p><strong>Comment:</strong> {{ $comment->comment }}</p>
                        <p><strong>Date:</strong> {{ $comment->created_at }}</p>
                        <p>
                            <strong>STATUS:</strong>
                            @switch($comment['is_active'])
                                @case(\App\Models\BookComments::NOT_PUBLISHED)
                                    <span>Չհրապարակված</span>
                                    @break
                                @case(\App\Models\BookComments::PUBLISHED)
                                    <span>Հրապարակված</span>
                                    @break
                            @endswitch
                        </p>

                        <form action="{{ route('admin.bookComment.update',  $comment['id']) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="is_active" value="{{ $comment['is_active'] ? 0 : 1 }}">
                            <button class="btn {{ $comment['is_active'] ? 'btn-danger' : 'btn-success ' }}"
                                    type="submit"
                                    onclick="return confirm('Are you sure you want to change this model?')">{{ $comment['is_active'] ? 'Ապաակտիվացնել' : 'Հրապարակել' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
