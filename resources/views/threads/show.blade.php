@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-start">
            <div class="col-md-8">
                <div class="card">
                    @php /** @var \App\Thread $thread */@endphp
                    <div class="card-header"><a href="#">{{$thread->creator->name}}</a> posted: {{$thread->title}}</div>
                    <div class="card-body">
                        <article>
                            <div class="text-body">
                                {{ $thread->body }}
                            </div>
                        </article>
                        <hr>

                    </div>
                </div>
                @foreach($replies as $reply)
                    @include('threads.reply')
                @endforeach

                {{ $replies->links() }}
                @if (auth()->check())
                    <form method="POST" action="{{$thread->path().'/replies'}}">
                        {{csrf_field()}}
                        <div class="form-group">
                                    <textarea name="body" class="form-control" placeholder="Have something to say" rows="5">

                                    </textarea>
                        </div>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>

                @else
                    <p>Please <a href="{{route('login')}}">sign in</a> to participate in discussion </p>
                @endif
            </div>
            <div class="col-md-4">
                <div class="card-header"></div>
                <div class="card-body">
                    <p>
                        This thread was created {{$thread->created_at->diffForHumans()}} by
                        <a href="#">{{$thread->creator->name}}</a> and currently has  {{$thread->replies_count}} {{\Illuminate\Support\Str::plural('comment',$thread->replies_count)}}
                    </p>

                    <hr>

                </div>
            </div>

        </div>


    </div>
@endsection
