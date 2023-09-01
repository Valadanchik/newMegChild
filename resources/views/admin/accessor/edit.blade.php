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
                                edit Accessor
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary" href="{{ route('accessors.index') }}">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Back to All Accessors
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

            <form class="book-page-form" action="{{ route('accessors.update', $accessor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row gx-4">

                    <div class="col-lg-6">
                        <input type="hidden" name="id" value="{{ $accessor->id }}">

                        <div class="card mb-4">
                            <div class="card-header">Title (Hy)</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="title_hy" name="title_hy"
                                       value="{{ old('title_hy', $accessor->title_hy) }}">
                            </div>
                            @error('title_hy')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Description (Hy)</div>
                            <div class="card-body">
                                <textarea class="form-control" id="description_hy"
                                          name="description_hy">{{ old('description_hy', $accessor->description_hy) }}</textarea>
                            </div>
                            @error('description_hy')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Slug</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $accessor->slug) }}">
                            </div>
                            @error('slug')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Price</div>
                            <div class="card-body">
                                <input type="number" class="form-control" id="price" name="price"
                                       value="{{ old('price', $accessor->price) }}">
                            </div>
                            @error('price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Age</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="font_size" name="age"
                                       value="{{ old('age', $accessor->age) }}">
                            </div>
                            @error('age')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">ISBN</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn', $accessor->isbn) }}">
                            </div>
                            @error('isbn')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">In Stock</div>
                            <div class="card-body">
                                <input type="number" class="form-control" id="in_stock" name="in_stock"
                                       value="{{ old('in_stock', $accessor->in_stock) }}">
                            </div>
                            @error('in_stock')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-lg-6">

                        <div class="card mb-4">
                            <div class="card-header">Main Image</div>

                            <div class="card-body">
                                <img width="100px" src="{{ URL::to('storage/' . $accessor->main_image) }}" alt="">
                            </div>

                            <div class="card-body">
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            @error('file')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <input class="book-edit-images" type="hidden" value="{{ $imagesPathAndId }}">
                        <input class="book-ordering-route" type="hidden" value="{{ route('admin.update.imagesOrder') }}">
                        <input class="book-destroy-routing" type="hidden" value="{{ route('books.book-image-destroy') }}">

                        <div class="card mb-4">
                            <div class="card-header">Accessor Images</div>
                            <div class="form-group">
                                <div class="card-body">
                                    <input id="accessorsFiles" type="file" name="images[]" multiple class="images" data-overwrite-initial="false" >
                                </div>
                            </div>
                            @error('files')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Categories</div>
                            <div class="card-body">
                                <select class="form-select" name="category_id" aria-label="Default select example">
                                    @foreach($categories as $category)
                                        <option
                                            value="{{$category->id}}"
                                            @if(old('category_id') == $category->id) selected @endif>
                                            {{ $category->{'name_'.app()->getLocale()} }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div style="color: red" class="required--error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Active</div>
                            <div class="card-body">
                                <select class="form-select"  name="status">
                                    <option value="1" @if(old('status') == $accessor->status || $accessor->status) selected @endif>Active</option>
                                    <option value="0" @if(old('status') == $accessor->status || !$accessor->status) selected @endif>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button class="fw-500 btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
