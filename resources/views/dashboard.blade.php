<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Library') }}
        </h2>
    </x-slot>
    <div class="mt-4 mb-6 mx-4 lg:mx-10 lg:flex lg:flex-row">
        <button id="add-library-button" class="sm:px-6 w-39 h-12 bg-green-500 p-3 text-white font-bold">CREATE NEW
        </button>
    </div>
    <div class="mt-4 mb-6 mx-4 lg:flex lg:flex-row">
        @foreach($libraries as $library)
            <div class="max-w-7xl lg:w-1/3 sm:px-6 mb-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full justify-end items-end">
                    <div class="p-6 flex flex-col justify-between min-h-full">
                        <div
                            class="w-full h-20 bg-green-400 border-2 border-blue-400 border-solid flex items-center justify-center sm:rounded-lg">
                            <h1 class="font-extrabold tracking-widest text-3xl uppercase text-white">{{$library->name}}</h1>
                            <a href="{{route('library.edit', ['library' => $library])}}">
                                <span class="ml-2">
                                    <i class="fa fa-pen text-white"></i>
                                </span>
                            </a>
                        </div>
                        <div class="grid grid-cols-3 mt-4 h-full">
                            @if($library->books()->exists())
                                @foreach($library->books->sortByDesc('created_at')->take(3) as $book)
                                    <div
                                        class="p-2 bg-green-100 flex flex-col flex-wrap mx-1 text-center break-all lg:h-72">
                                        <h5 class="mb-auto font-bold break-words overflow-ellipsis">{{$book->title}} </h5>
                                        <img src="https://placekitten.com/g/50/60" alt=""
                                             class="object-scale-down justify-self-center align-self-center self-stretch my-auto">
                                        <p>{{$book->author}}</p>
                                        <p class="justify-self-end">{{$book->year_published_only_year}}</p>
                                        <div class="flex">
                                            <a href="{{route('book.edit', ['book' => $book])}}"
                                               class="mx-1 w-1/2 bg-yellow-500 font-extrabold text-white">
                                                <span class="">
                                                    <i class="fa fa-pen text-sm text-red-300"></i>
                                                </span>
                                            </a>
                                            <button
                                                data-url="{{route('book.destroy', ['book' => $book])}}"
                                                data-book-id="{{$book->id}}"
                                                class="remove-book-button mx-1 w-1/2 bg-yellow-500 font-extrabold text-white">
                                                <span class="">
                                                    <i class="fa fa-pen text-sm text-red-300"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center col-span-3 self-center">No books added yet</div>
                            @endif
                        </div>
                        <div class="py-2 text-center h-48 my-2 h-1/6 flex flex-col justify-between">
                            <button
                                class="add-book-button mx-2 py-2 h-full w-full bg-green-400 justify-self-center self-center font-bold uppercase text-xl text-white tracking-widest"
                                data-library="{{$library->id}}">
                                Add Book
                            </button>
                            <button
                                class="remove-library-button mx-2 py-2 mt-2 h-full w-full bg-red-400 justify-self-center self-center font-bold uppercase text-xl text-white tracking-widest"
                                data-library="{{$library->id}}"
                            >
                                Remove Library
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mx-12 flex flex-col justify-center">
        {{$libraries->links()}}
    </div>

    @include('partials.create-library-modal')
    @include('partials.create-book-modal')
    @include('partials.confirmation-modal')
</x-app-layout>

