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
                                edit Post
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary" href="{{ route('posts.index') }}">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Back to All Posts
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
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row gx-4">
                    <div class="col-lg-6">
                        <input type="hidden" name="id" value="{{ $post->id }}">

                        <div class="card mb-4">
                            <div class="card-header">Title (Hy)</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="title_hy" name="title_hy"
                                       value="{{ old('title_hy', $post->title_hy) }}">
                            </div>
                            @error('title_hy')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Title (En)</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="title_en" name="title_en"
                                       value="{{ old('title_en', $post->title_en) }}">
                            </div>
                            @error('title_en')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Description (Hy)</div>
                            <div class="card-body">
                                <textarea class="form-control" id="description_hy"
                                          name="description_hy">{{ old('description_hy', $post->description_hy) }}</textarea>
                            </div>
                            @error('description_hy')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Description (En)</div>
                            <div class="card-body">
                                <textarea class="form-control" id="description_en"
                                          name="description_en">{{ old('description_en', $post->description_en) }}</textarea>
                            </div>
                            @error('description_en')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Text (Hy)</div>
                            <div class="card-body">
                                <textarea class="form-control" id="text_hy"
                                          name="text_hy">{{ old('text_hy', $post->text_hy) }}</textarea>
                            </div>
                            @error('text_hy')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Text (En)</div>
                            <div class="card-body">
                                <textarea class="form-control" id="text_en"
                                          name="text_en">{{ old('text_en', $post->text_en) }}</textarea>
                            </div>
                            @error('text_en')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">Medias</div>
                            <div class="card-body">
                                @foreach($postCategories as $category)
                                    <div>
                                        <input class="form-check-input" type="radio" name="post_category_id" value="{{$category->id}}"
                                               @if((is_array(old('post_category_id')) && in_array($category->id, old('post_category_id'))) || ($category->id == ($post->postCategory->id ?? false))) checked @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{$category->{'title_' . app()->getLocale()} }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('post_category_id')
                                <div style="color: red" class="required--error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Slug</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
                            </div>
                            @error('slug')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">Image</div>
                            <div class="card-body">
                                <img width="100px" src="{{ URL::to('storage/' . $post->image) }}" alt="">
                            </div>
                            <div class="card-body">
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            @error('file')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid"><button class="fw-500 btn btn-primary">Create</button></div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
