@extends('layouts.app')
@section('content')

    <div id="admin-content">
        <div class="container">
            <div class="row align-items-center mb-3">
                <div class="col-md-3">
                    <h2 class="admin-heading">All Books</h2>
                </div>
                <div class="col-md-5">
                    <form method="GET" action="{{ route('book.index') }}">
                        <div class="input-group">
                            <select name="category_id" class="form-control" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 text-right">
                    <a class="btn btn-primary add-new" href="{{ route('book.create') }}">Add Book</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="message"></div>
                    <table class="content-table">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Book Name</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Publisher</th>
                                <th>Status</th>
                                <th>Cover</th>
                                <th>PDF</th> <!-- Added PDF column -->
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $book)
                                <tr>
                                    <td class="id">{{ $book->id }}</td>
                                    <td>{{ $book->name }}</td>
                                    <td>{{ $book->category->name }}</td>
                                    <td>{{ $book->auther->name }}</td>
                                    <td>{{ $book->publisher->name }}</td>
                                    <td>
                                        @if ($book->status == 'Y')
                                            <span class='badge badge-success'>Available</span>
                                        @else
                                            <span class='badge badge-danger'>Issued</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($book->cover)
                                            <img src="{{ asset('storage/' . $book->cover) }}" style="width: 50px; height: auto">
                                        @else
                                            No Cover
                                        @endif
                                    </td>
                                    <td>
                                        @if($book->pdf)
                                            <a href="{{ asset('storage/' . $book->pdf) }}" class="btn btn-info" target="_blank">View PDF</a>
                                        @else
                                            No PDF
                                        @endif
                                    </td>
                                    <td class="edit">
                                        <a href="{{ route('book.edit', $book) }}" class="btn btn-success">Edit</a>
                                    </td>
                                    <td class="delete">
                                        <form action="{{ route('book.destroy', $book) }}" method="post" class="form-hidden">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger delete-book">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No Books Found</td> <!-- Updated colspan -->
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $books->links('vendor/pagination/bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
