@extends('custom.post.app')

@section('content')

<div class="container pb-32">

<div class="w-4/5 m-auto text-left">
@if (session()->has('message'))
    <div class="w-full mt-10 pl-2">
        <p class="w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4 px-4">
            {{ session()->get('message') }}
        </p>
    </div>
@endif
    <div class="py-15">
    <img class="h-64 w-2/5 mb-10" src="{{ $post->getFileLink('image') }}" alt="">
        <h1 class="text-4xl">
            {{ $post->title }}
        </h1>
    </div>
</div>

<div class="w-4/5 m-auto ">
    <span class="text-gray-500">
        By <span class="font-bold italic text-gray-800">{{ $post->user->fullname }}</span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
    </span>
    <br>
    <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
        {{ $post->body }}
    </p>
</div>

<!-- Comment list -->
<div class="w-4/5 m-auto ">
<h1 class="text-3xl mb-5">Comment </h1>

@if (count($comments) > 0)

@foreach ($comments as $comment)

<div class="flex gap-6 mb-2">
<div class="flex-initial ">
<img class="rounded-full h-24 w-24 " src="{{ asset('custom/images/guest.png') }}" alt="">
</div>

<div class="flex-initial">
<h2 class="text-gray-600 text-bold text-2xl pb-3">{{ $comment->user->fullname }}</h2>

<span class="text-gray-500">
    Posted on {{ date('jS M Y', strtotime($comment->created_at)) }}
</span>

<p class="text-xl text-gray-700 pt-2 pb-10 font-light">
    {{ $comment->comment }}
</p>
</div>

</div>

@endforeach
@else 
<div class="py-10  border-b border-gray-200">
        <div class="content-center">
No commands found

</div>
</div>
@endif



</div>

<!--- Comment list end--->


<!-- Comments -->

<div class="w-4/5 m-auto mt-10 ">
@if ($errors->any())
    <div class="w-4/5 ">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="w-2/6 mb-4 text-gray-50 bg-red-700 rounded-2xl py-4 px-4">
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif




  <div class="md:grid md:grid-cols-3 md:gap-6">
    

    <div class="mt-5 md:mt-0 md:col-span-2">

    <form 
        action="/post/comment/{{ $post->id }}"
        method="POST"
        >
        @csrf
		@method('PUT')
     

        <div class="shadow sm:rounded-md sm:overflow-hidden">
          <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
          <h1 class="text-3xl">
          Share you thought about this post
        </h1>
         
    
            <div class="col-span-3 sm:col-span-2">
              <label for="about" class="block text-sm font-medium text-gray-700 mb-2">
                Comment
              </label>
         
                <textarea  name="comment" rows="3" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4  leading-tight focus:outline-none focus:bg-white focus:border-blue-300" placeholder="Share you thought about this post"></textarea>
        
            </div>
          </div>
          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Post Comment
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
<!-- commnet end -->

</div>

@endsection 
@extends('custom.post.footer')