@php
    /** @var \App\User $profileUser */
    /** @var \App\Thread $threads */
@endphp
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="modal-header">
            <h1> {{ $profileUser->name }}
                <small>Since {{$profileUser->created_at->diffForHumans()}}</small>
            </h1>
        </div>
        @foreach ($threads as $thread)
            @php /** @var \App\Thread $thread */@endphp
            <article>
                <div class="flex-column align-content-center">
                    <h4 class="flex-grow-1">
                        <a href="{{route('profile',$thread->creator)}}">{{$thread->title}}</a>
                        <a href="{{$thread->path()}}">{{$thread->title}}</a>

                    </h4>
                    {{$thread->created_at->diffForHumans()}}
                    <a href="{{$thread->path()}}">{{$thread->replies_count}} {{\Illuminate\Support\Str::plural('reply',$thread->replies_count)}} </a>
                </div>
                <div class="text-body float-none">
                    {{ $thread->body }}
                </div>
            </article>
            <hr>
        @endforeach
{{$threads->links()}}

    </div>
@endsection
