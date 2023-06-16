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
                                Books
                            </h1>
                            <div class="page-header-subtitle mt-4">
                                <a href="{{ url('fs-admin/books/create ') }}" class="btn btn-outline-light" type="button">+ Add new book</a>
                            </div>
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
                <div class="card-header">Books list</div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Author</th>
                                <th>Price</th>
                                <th>In Stock</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($books as $index => $book)
                                <tr>
                                    <td>{{ $book['title_' . app()->getLocale()]  }}</td>
                                    <td>
                                        @foreach($book->authors as $key => $author)
                                            {{ $author['name_' . app()->getLocale()] }} {{ $key < count($book->authors) - 1 ? ',' : '' }}
                                        @endforeach
                                    </td>
                                    <td>{{ $book['price'] }} ֏</td>
                                    <td>{{ $book['in_stock'] }}</td>
                                    <td>{{ $book['status'] ? 'Public' : 'Private'}}</td>
                                    <td>
                                        <a href="{{ url('fs-admin/books/' . $book['id'] . '/edit' ) }}" class="btn btn-datatable btn-icon btn-transparent-dark me-2">
                                            <i class="fa-regular fa-edit"></i>
                                        </a>
                                        <form style="display: inline-block" action="{{ route('books.destroy', $book['id']) }}" method="POST">
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
