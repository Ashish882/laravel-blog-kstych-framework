@extends('custom.post.app')

@section('content')
<div class="container mx-auto mb-10">
<div class="w-4/5 text-left">
    <div class="py-15">
        <h1 class="text-4xl">
            Update post
        </h1>
    </div>
</div>
@if ($errors->any())
    <div class="w-4/5 ">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="w-1/5 mb-4 text-gray-50 bg-red-700 rounded-2xl py-4">
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif

<div class="w-1/2 pb-15">
    <form 
        action="/post/{{ $post->id }}"
        method="POST"
        >
        @csrf
        @method('PUT')

        <label class="block text-xl font-medium text-gray-700 mb-4">
                  Title
                </label>

        <input 
            type="text"
            name="title"
            value="{{ $post->title }}"
            class="bg-transparent block border-b-2 w-full h-8 text-xl outline-none">

            <label class="block text-xl font-medium text-gray-700 mb-4 mt-6">
            Descripion
            </label>

        <textarea 
            name="body"
            placeholder="Description..."
            class="bg-transparent block border-b-2 w-full h-48 text-xl outline-none">{{ $post->body }}</textarea> 

        <button    
            type="submit"
            class="uppercase mt-8 bg-blue-500 text-gray-100 text-lg font-bold py-4 px-4 rounded-3xl">
            Update Post
        </button>
    </form>
</div>

@endsection
@extends('custom.post.footer')