@extends('admin.layout.layout')

@section('admin.content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xxl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="shopping-cart"></i></div>
                                Book Comments
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
                <div class="card-header">Comment list</div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th>Book Name</th>
                            <th>User Full Name</th>
                            <th>Product Type</th>
                            <th>Email</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Book Name</th>
                            <th>User Full Name</th>
                            <th>Product Type</th>
                            <th>Email</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($comments as $index => $comment)
                            <tr>
                                <td>{{ $comment['commentable']['title_' . app()->getLocale() ] }}</td>
                                <td>{{ $comment['full_name'] }}</td>
                                <td>{{ $comment['commentable']['category']['type'] }}</td>
                                <td>{{ $comment['email'] }}</td>
                                <td>{{ $comment['comment'] }}</td>
                                <td>
                                    @switch($comment['is_active'])
                                        @case(\App\Models\ProductComments::NOT_PUBLISHED)
                                            <span>Չհրապարակված</span>
                                            @break
                                        @case(\App\Models\ProductComments::PUBLISHED)
                                            <span>Հրապարակված</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>{{ $comment['created_at'] }}</td>

                                <td>
                                    <a href="{{ url('fs-admin/comment/view/' . $comment['id'] ) }}"
                                       class="bi-pencil btn btn-datatable btn-icon btn-transparent-dark me-2">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    <form style="display: inline-block"
                                          action="{{ route('admin.bookComment.destroy', $comment['id']) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                                type="submit"
                                                onclick="return confirm('Are you sure you want to delete this model?')">
                                            <i class="bi-trash"></i></button>
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
