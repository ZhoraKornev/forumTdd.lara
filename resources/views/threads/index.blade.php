@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Forum</div>
                    <div class="card-body">
                        @foreach($threads as $thread)
                            <article>
                                <div class="flex-column align-content-center">
                                    <h4 class="flex-grow-1">
                                        <a href="{{$thread->path()}}">
                                            {{$thread->title}}
                                        </a>
                                    </h4>

                                    <a href="{{$thread->path()}}" >{{$thread->replies_count}} {{\Illuminate\Support\Str::plural('reply',$thread->replies_count)}} </a>
                                </div>
                                <div class="text-body float-none">
                                    {{ $thread->body }}
                                </div>
                            </article>
                            <hr>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
