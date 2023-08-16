@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2xl">
        Books
    </h1>

    <form method="GET" action="{{ route('books.index') }}" class="my-2">
        <input type="text" name="title" placeholder="Search by title" value="{{ request('title') }}"
               class="input"/>
        <input type="hidden" name="filter" value="{{ request('filter') }}"/>
        <button class="btn my-2 mr-4">Search</button>
        <a href="{{ route('books.index') }}" class="btn my-2">Clear</a>
    </form>

    <div class="filter-container">
        @php
            $filters = [
                '' => 'Latest',
                'popular_last_month' => 'popular last Month',
                'popular_last_6months' => 'popular last 6 Months',
                'highest_rated_month' => 'Highest Rated last Month',
                'highest_rated_6months' => 'Highest Rated last 6 Months',
            ];
        @endphp

        @foreach($filters as $key => $label)
            <a href="{{ route('books.index', [...request()->query(), 'filter' => $key]) }}"
               class="{{ request('filter') === $key || (request('filter') === null && $key === '') ? 'filter-item-active' : 'filter-item' }}">
                {{ $label }}
            </a>
        @endforeach

    </div>

    <ul>
        @forelse($books as $book)
            <li class="mb-4">
                <div class="book-item">
                    <div
                        class="flex flex-wrap items-center justify-between">
                        <div class="w-full flex-grow sm:w-auto">
                            <a href="{{ route('books.show', $book) }}" class="book-title">{{ $book->title }}</a>
                            <span class="book-author">by {{ $book->author }}</span>
                        </div>
                        <div>
                            <div class="book-rating">
                                {{ number_format($book->reviews_avg_rating, 1) }}
                            </div>
                            <div class="book-review-count">
                                out of {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
                            </div>
                        </div>
                    </div>
                </div>
            </li>

        @empty
            <li class="mb-4">
                <div class="empty-book-item">
                    <p class="empty-text">No books found</p>
                    <a href="{{ route('books.index') }}" class="reset-link">Reset criteria</a>
                </div>
            </li>
        @endforelse
    </ul>
@endsection
