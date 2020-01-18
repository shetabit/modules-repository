@extends('blog::layouts.master')

@section('content')
    <div class="container">
        <h1>Hello World</h1>

        <p>
            This view is loaded from module: {!! config('blog.name') !!}
        </p>

        <ul>
            @foreach($posts as $post)
                <li>{{ $post->title }}</li>
            @endforeach
        </ul>
        {{ $posts->links() }}
    </div>
@endsection
