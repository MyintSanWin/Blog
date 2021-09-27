<x-layout>

        <article style="padding-top: 5px;">

        {!!$post->title!!}

        <p>
          By <a href="/authors/{{$post->author->username}}">{{$post->author->username}}</a> in  <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a>
        </p>
         <div style="padding-top: 15px; ">
             {!! $post->body !!}
         </div>
        </article>
        <a href="/">Go Back..</a>

</x-layout>

