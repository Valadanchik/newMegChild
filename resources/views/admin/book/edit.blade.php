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
                                edit Book
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary" href="{{ route('books.index') }}">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Back to All Books
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

            <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row gx-4">

                    <div class="col-lg-6">

                        <input type="hidden" name="id" value="{{ $book->id }}">
                        <div class="card mb-4">
                            <div class="card-header">Title (Hy)</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="title_hy" name="title_hy"
                                       value="{{ old('title_hy', $book->title_en) }}">
                            </div>
                            @error('title_hy')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Title (En)</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="title_en" name="title_en"
                                       value="{{ old('title_en', $book->title_en) }}">
                            </div>
                            @error('title_en')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Text (Hy)</div>
                            <div class="card-body">
                                <textarea class="form-control" id="text_hy"
                                          name="text_hy">{{ old('text_hy', $book->text_hy) }}</textarea>
                            </div>
                            @error('text_hy')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Text (En)</div>
                            <div class="card-body">
                                <textarea class="form-control" id="text_en"
                                          name="text_en">{{ old('text_en', $book->text_en) }}</textarea>
                            </div>
                            @error('text_en')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Description (Hy)</div>
                            <div class="card-body">
                                <textarea class="form-control" id="description_hy"
                                          name="description_hy">{{ old('description_hy', $book->description_hy) }}</textarea>
                            </div>
                            @error('description_hy')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Description (En)</div>
                            <div class="card-body">
                                <textarea class="form-control" id="description_en"
                                          name="description_en">{{ old('description_en', $book->description_en) }}</textarea>
                            </div>
                            @error('description_en')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Book Size (Hy)</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="book_size_hy" name="book_size_hy"
                                       value="{{ old('book_size_hy', $book->book_size_hy) }}">
                            </div>
                            @error('book_size_hy')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Book Size (En)</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="book_size_en" name="book_size_en"
                                       value="{{ old('book_size_en', $book->book_size_en) }}">
                            </div>
                            @error('book_size_en')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="card mb-4">
                            <div class="card-header">Slug</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $book->slug) }}">
                            </div>
                            @error('slug')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Price</div>
                            <div class="card-body">
                                <input type="number" class="form-control" id="price" name="price"
                                       value="{{ old('price', $book->price) }}">
                            </div>
                            @error('price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Word Count</div>
                            <div class="card-body">
                                <input type="number" class="form-control" id="word_count" name="word_count"
                                       value="{{ old('word_count', $book->word_count) }}">
                            </div>
                            @error('word_count')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Page Count</div>
                            <div class="card-body">
                                <input type="number" class="form-control" id="page_count" name="page_count"
                                       value="{{ old('page_count', $book->page_count) }}">
                            </div>
                            @error('page_count')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Font Size</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="font_size" name="font_size"
                                       value="{{ old('font_size', $book->font_size) }}">
                            </div>
                            @error('font_size')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">ISBN</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}">
                            </div>
                            @error('isbn')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">In Stock</div>
                            <div class="card-body">
                                <input type="number" class="form-control" id="in_stock" name="in_stock"
                                       value="{{ old('in_stock', $book->in_stock) }}">
                            </div>
                            @error('in_stock')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-lg-6">

                        <div class="card mb-4">
                            <div class="card-header">Published date</div>
                            <div class="card-body">
                                <input type="number" class="form-control" id="published_date" name="published_date"
                                       value="{{ old('published_date', $book->published_date) }}">
                            </div>
                            @error('published_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Main Image</div>

                            <div class="card-body">
                                <img width="100px" src="{{ URL::to('storage/images/books/' . $book->main_image) }}" alt="">
                            </div>

                            <div class="card-body">
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            @error('file')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Video URL</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="video_url" name="video_url"
                                       value="{{ old('video_url', $book->video_url) }}">
                            </div>
                            @error('video_url')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Authors</div>
                            <div class="card-body">
                                @foreach($authors as $author)
                                    <div>
                                        <input class="form-check-input" type="checkbox" name="authors[]" value="{{$author->id}}"
                                               @if((is_array(old('authors')) && in_array($author->id, old('authors'))) || in_array($author->id, $authorsForSelected)) checked @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{$author->{'name_' . app()->getLocale()} }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('authors')
                                    <div style="color: red" class="required--error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Translators</div>
                            <div class="card-body">
                                @foreach($translators as $key => $translator)
                                    <div>
                                        <input class="form-check-input" type="checkbox" name="translators[]" value="{{$translator->id}}"
                                               @if((is_array(old('translators')) && in_array($translator->id, old('translators'))) || in_array($translator->id, $translatorsForSelected)) checked @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{$translator->{'name_' . app()->getLocale()} }}
                                        </label>
                                    </div>
                                @endforeach

                                @error('translators')
                                    <div style="color: red" class="required--error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Categories</div>
                            <div class="card-body">
                                <select class="form-select" name="category_id" aria-label="Default select example">
                                    @foreach($categories as $category)
                                        <option
                                            value="{{$category->id}}"
                                            @if(old('category_id') == $category->id || $book->category->id == $category->id) selected @endif>
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
                                <div class="form-check form-switch form-check-input-red">
                                    <input class="form-check-input" value="0" name="status" type="checkbox" id="flexSwitchCheckChecked"
                                           @if(is_array(old('status')) && in_array(1, old('status'))) checked @endif>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">disable?</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid"><button class="fw-500 btn btn-primary">Update</button></div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
