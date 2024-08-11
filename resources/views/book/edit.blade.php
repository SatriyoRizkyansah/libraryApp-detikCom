@extends('layouts.app')
@section('content')
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="admin-heading">Update Book</h2>
                </div>
            </div>
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <form class="yourform" action="{{ route('book.update', $book->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT') <!-- Change to PUT -->
                        <div class="form-group">
                            <label>Book Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Book Name" name="name" value="{{ old('name', $book->name) }}">
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == old('category_id', $book->category_id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Author</label>
                            <select class="form-control @error('auther_id') is-invalid @enderror" name="author_id">
                                <option value="">Select Author</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}" {{ $author->id == old('author_id', $book->author_id) ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Publisher</label>
                            <select class="form-control @error('publisher_id') is-invalid @enderror" name="publisher_id">
                                <option value="">Select Publisher</option>
                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->id }}" {{ $publisher->id == old('publisher_id', $book->publisher_id) ? 'selected' : '' }}>
                                        {{ $publisher->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('publisher_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Cover</label>
                            <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover">
                            @if ($book->cover)
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="Book Cover" style="width: 100px; height: auto;">
                            @endif
                            @error('cover')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <input type="submit" name="save" class="btn btn-primary" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @extends('layouts.app')

@section('content')
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="admin-heading">Update Book</h2>
                </div>
            </div>
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <form class="yourform" action="{{ route('book.update', $book->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT') <!-- Change to PUT -->
                        <div class="form-group">
                            <label>Book Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Book Name" name="name" value="{{ old('name', $book->name) }}">
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == old('category_id', $book->category_id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Author</label>
                            <select class="form-control @error('auther_id') is-invalid @enderror" name="auther_id">
                                <option value="">Select Author</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}" {{ $author->id == old('auther_id', $book->auther_id) ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('auther_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Publisher</label>
                            <select class="form-control @error('publisher_id') is-invalid @enderror" name="publisher_id">
                                <option value="">Select Publisher</option>
                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->id }}" {{ $publisher->id == old('publisher_id', $book->publisher_id) ? 'selected' : '' }}>
                                        {{ $publisher->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('publisher_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Cover</label>
                            <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover">
                            @if ($book->cover)
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="Book Cover" style="width: 100px; height: auto;">
                            @endif
                            @error('cover')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>PDF File</label>
                            <input type="file" class="form-control @error('pdf') is-invalid @enderror" name="pdf">
                            @if ($book->pdf)
                                <a href="{{ asset('storage/' . $book->pdf) }}" target="_blank">View Current PDF</a>
                            @endif
                            @error('pdf')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <input type="submit" name="save" class="btn btn-primary" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
