@extends('base')

@section('title', 'Book Add')

@section('body')

    <h1>Book Add</h1>

    <form method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action={{route('book.add')}}>
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="Author">
                Author <span class="text-red-500">*</span>
            </label>

            <label for="author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
            <select id="author" name="author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            @foreach ($authors as $author)
                <option value="{{$author->id}}">{{$author->first_name}}</option>
            @endforeach
            </select>


            @error('author')
                <span class="text-red-500">{{$message}}</span>
            @enderror

        </div>


        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="Title">
                Title <span class="text-red-500">*</span>
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="Title">

            @error('title')
                <span class="text-red-500">{{$message}}</span>
            @enderror

        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Description<span class="text-red-500">*</span>
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="description" type="text" placeholder="Title">

            @error('title')
                <span class="text-red-500">{{$message}}</span>
            @enderror

        </div>

        <div class="relative max-w-sm">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
            </div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="release_date">
                Release Date
            </label>
            <input datepicker type="text" name="release_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">

            @error('release_date')
                <span class="text-red-500">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="isbn">
                Isbn <span class="text-red-500">*</span>
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="isbn" type="text" placeholder="isbn">

            @error('isbn')
                <span class="text-red-500">{{$message}}</span>
            @enderror

        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="format">
                Format<span class="text-red-500">*</span>
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="format" name="format" type="text" placeholder="format">

            @error('format')
                <span class="text-red-500">{{$message}}</span>
            @enderror

        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="Number of page">
                Number of pages<span class="text-red-500">*</span>
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="number_of_pages" name="number_of_pages" type="number" placeholder="Number of page">

            @error('number_of_pages')
                <span class="text-red-500">{{$message}}</span>
            @enderror

        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                Add Book
            </button>
        </div>
    </form>
@endsection
