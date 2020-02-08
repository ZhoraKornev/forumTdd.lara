@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="modal-header">Forum</div>
                    @forelse($threads as $thread)
                        <div class="card-body">
                                <div class="flex-column align-content-center">
                                    <h4 class="flex-grow-1">
                                        <a href="{{$thread->path()}}">
                                            {{$thread->title}}
                                        </a>
                                    </h4>

                                    <a href="{{$thread->path()}}">{{$thread->replies_count}} {{\Illuminate\Support\Str::plural('reply',$thread->replies_count)}} </a>
                                </div>
                                <div class="text-body float-none">
                                    {{ $thread->body }}
                                </div>
                            <hr>

                        </div>
                    @empty
                        <p>There are now relevant results</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
