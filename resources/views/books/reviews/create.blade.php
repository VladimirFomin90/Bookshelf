@extends('layouts.app')

@section('content')
    <h1 class="mb-8 text-2xl">Add Review for {{ $book->title }}</h1>

    <form method="POST" action="{{ route('books.reviews.store', $book )}}">
        @csrf
        <label for="review"></label>
        <textarea name="review" id="review" required class="input mb-3"></textarea>

        <label for="rating"></label>
        <select name="rating" id="rating" class="input mb-3" required>
            <option value="">
                Select a rating
            </option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">
                    {{ $i }}
                </option>
            @endfor
        </select>

        <button class="btn">Add Review</button>

    </form>

@endsection
