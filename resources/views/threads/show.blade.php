@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @php /** @var \App\Thread $thread */@endphp
                    <div class="card-header"><a href="#" >{{$thread->creator->name}}</a>  posted: {{$thread->title}}</div>
                    <div class="card-body">
                        <article>
                            <div class="text-body">
                                {{ $thread->body }}
                            </div>
                        </article>
                        <hr>

                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @foreach($thread->replies as $reply)
                        @include('threads.reply')
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection
