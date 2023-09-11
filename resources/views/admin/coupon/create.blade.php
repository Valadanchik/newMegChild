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
                                Create Coupon
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary" href="{{ route('coupons.index') }}">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Back to All Coupons
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
            <form action="{{ route('coupons.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row gx-4">

                    <div class="col-lg-6">

                        <div class="card mb-4">
                            <div class="card-header">Code</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="code" name="code"
                                       value="{{ old('code') }}">
                            </div>
                            @error('code')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Price</div>
                            <div class="card-body">
                                <input type="number" class="form-control" id="price" name="price"
                                       value="{{ old('price') }}">
                            </div>
                            @error('price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Count</div>
                            <div class="card-body">
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                       value="{{ old('quantity') }}">
                            </div>
                            @error('quantity')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Type</div>
                            <div class="card-body">
                                <select class="form-select" name="type" id="type">
                                <option
                                    value="single"
                                    @if(old('single') == 'single') selected @endif>
                                    Single
                                </option>
                                <option
                                    value="each_books"
                                    @if(old('each_books') == 'each_books') selected @endif>
                                    Each Books
                                </option>
                            </select>
                            </div>
                            <small></small>
                            @error('type')
                            <div style="color: red" class="required--error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Books</div>
                            <div class="card-body">
                                <div class="dropdown w-100">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        All Products
                                    </button>
                                    <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                        <div class="card-body">
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="all_products" value="all_products" id="all_books" checked>
                                                <label class="form-check-label" for="Checkme4">All Products</label>
                                            </div>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <div><strong>Books</strong></div>
                                        @foreach($books as $book)
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input book_id" name="book_id[]" type="checkbox" value="{{$book->id}}" id="book_id">
                                                    <label class="form-check-label" for="book">{{ $book->{'title_' . app()->getLocale()} }}</label>
                                                </div>
                                            </li>
                                        @endforeach
                                        <div><strong>Accessors</strong></div>
                                        @foreach($accessors as $accessor)
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input book_id" name="accessor_id[]" type="checkbox" value="{{$accessor->id}}" id="book_id">
                                                    <label class="form-check-label" for="book">{{ $accessor->{'title_' . app()->getLocale()} }}</label>
                                                </div>
                                            </li>
                                        @endforeach
                                        </div>
                                    </ul>
                                </div>
                            </div>
                            @error('all_products')
                            <div style="color: red" class="required--error">{{ $message }}</div>
                            @enderror
                            @error('book_id')
                            <div style="color: red" class="required--error">{{ $message }}</div>
                            @enderror
                            @error('accessor_id')
                            <div style="color: red" class="required--error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mt-4">
                            <button class="fw-500 btn btn-primary">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
