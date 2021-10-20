@auth
<x-panel>
    <form action="/posts/{{$post->slug}}/comments" method="POST">
        @csrf

        <header class="flex items-center">
            <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="" width="40" height="40" class="rounded-full">
            <h3 class="ml-5 text-center">Want to participate?</h3>
        </header>

        <div class="mt-6">
            <textarea name="body" class="w-full text-sm focus:outline-none focus:ring" id="body"
                placeholder="Quick, thing of something to say!" rows="5" required></textarea>

            @error('body')
            <span class="text-xs-text-red-500"> {{$message}}</span>

            @enderror
        </div>

        <div class="flex justify-end mt-6 pt-6 border-t border-gray-200 ">

            <x-form.button>Submit</x-form.button>
        </div>
    </form>
</x-panel>

{{-- @else

<p>
    <a href="/login'">Log in to leave a comment</a>
</p> --}}

@endauth