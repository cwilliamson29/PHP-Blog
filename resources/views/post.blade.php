<x-layout>
    <h1>
        {{$post->title}}
    </h1>
    <div>
        {!! $post->body !!}
    </div>

    <a href="/posts">Go Back</a>
</x-layout>
