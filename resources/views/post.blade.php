<x-layout>

        <article style="padding-top: 5px;">

        {!!$post->title!!}

        <p>
            <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a>
          </p>
         <div style="padding-top: 15px; ">
             {!! $post->body !!}
         </div>
        </article>
        <a href="/">Go Back..</a>

</x-layout>

