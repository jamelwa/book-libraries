<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book') }}
        </h2>
    </x-slot>
    <div class="mt-4 mb-6 mx-4 lg:flex lg:flex-row">
        <div class="max-w-7xl w-full sm:px-6 mb-3">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full justify-end items-end">
                <div class="p-6 flex flex-col justify-between min-h-full">
                    <p class="font-bold text-xs text-green-600">{{session('message')}}</p>
                    <form action="{{route('book.update', ['book' => $book])}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="w-full mb-3">
                            <label for="" class="text-xs font-semibold px-2">Book Title</label>
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa fa-book-open text-gray-400 text-lg"></i></div>
                                <input value="{{$book->title}}" name="title" type="text"
                                       class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500">
                            </div>
                            @error('title')
                            <p class="font-bold text-xs text-red-600 pt-2">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="w-full mb-3">
                            <label for="" class="text-xs font-semibold px-2">Book Author</label>
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa fa-book-open text-gray-400 text-lg"></i></div>
                                <input value="{{$book->author}}" name="author" type="text"
                                       class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500">
                            </div>

                            @error('author')
                            <p class="font-bold text-xs text-red-600 pt-2">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="w-full mb-3">
                            <label for="" class="text-xs font-semibold px-2">Year Published</label>
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa fa-book-open text-gray-400 text-lg"></i></div>
                                <input value="{{$book->year_published_for_input}}" name="year_published" type="date"
                                       class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500">
                            </div>

                            @error('year_published')
                            <p class="font-bold text-xs text-red-600 pt-2">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="w-full mb-3">
                            <button
                                class="add-book-button mx-2 py-2 h-full w-full bg-green-400 justify-self-center self-center font-bold uppercase text-xl text-white tracking-widest">
                                Update Book
                            </button>
                        </div>
                        <div class="w-full mb-3">
                            <button
                                data-url="{{route('book.destroy', ['book' => $book])}}"
                                data-book-id="{{$book->id}}"
                                class="remove-book-button mx-2 py-2 h-full w-full bg-red-400 justify-self-center self-center font-bold uppercase text-xl text-white tracking-widest">
                                Remove Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.confirmation-modal')
</x-app-layout>

