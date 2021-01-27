<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Library') }}
        </h2>
    </x-slot>
    <div class="mt-4 mb-6 mx-4 lg:flex lg:flex-row">
        <div class="max-w-7xl w-full sm:px-6 mb-3">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full justify-end items-end">
                <div class="p-6 flex flex-col justify-between min-h-full">
                    <p class="font-bold text-xs text-green-600">{{session('message')}}</p>
                    <form action="{{route('library.update', ['library' => $library])}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="w-full mb-3">
                            <label for="" class="text-xs font-semibold px-2">Library Name</label>
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa fa-book-open text-gray-400 text-lg"></i></div>
                                <input value="{{$library->name}}" name="name" type="text"
                                       class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500">

                            </div>
                            @error('name')
                            <p class="font-bold text-xs text-red-600 pt-2">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="w-full mb-3">
                            <label for="" class="text-xs font-semibold px-2">Add More Books</label>
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa fa-book-open text-gray-400 text-lg"></i>
                                </div>
                                <select id="add-multiple-books" name="book_ids[]" id="" multiple style="width: 100%">
                                    @foreach($books as $book)
                                        <option value="{{$book->id}}">{{"$book->title - by $book->author"}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="w-full mb-3">
                            <label for="" class="text-xs font-semibold px-2">Latest Books</label>
                            <ol class="px-3 grid grid-cols-2 grid-rows-5 h-1/4 grid-flow-col list">
                                @foreach($booksInCurrentLibrary as $key => $book)
                                    <li class="py-2 border-b">
                                        {{++$key . ". $book->title - $book->author - $book->year_published"}}
                                        <span class="float-right mr-2"><i class="fa fa-window-close text-red-500 mr-2"></i></span>
                                    </li>
                                @endforeach
                            </ol>
                        </div>

                        <div class="py-2 text-center h-48 my-2 h-1/6 flex flex-col justify-between lg:w-full">
                            <button
                                type="submit"
                                class="mx-2 py-2 h-full w-full bg-green-400 justify-self-center self-center font-bold uppercase text-xl text-white tracking-widest">
                                Update Library
                            </button>
                        </div>

                        <div class="py-1">
                            {{$booksInCurrentLibrary->links()}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

