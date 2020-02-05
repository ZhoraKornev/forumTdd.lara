@php
    /** @var \Illuminate\Support\ViewErrorBag $errors */
    /** @var \App\Channel[] $channels */
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a new thread</div>
                    <div class="card-body">
                        <form action="/threads" method="POST">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="channel_id">Select a channel</label>
                                <select class="custom-select" name="channel_id" id="channel_id" required>
                                    <option disabled>Select one</option>
                                    @foreach ($channels as $channel)
                                        <option value="{{$channel->id}}" {{old('channel_id')==$channel->id ?'selected' : ''}}>{{ $channel->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title"></label>
                                <input type="text"
                                       class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="enter title here" value="{{old('title')}}" required>
                                <small id="helpId" class="form-text text-muted">max 255 symbols</small>
                            </div>
                            <div class="form-group">
                                <label for="body"></label>
                                <textarea  required class="form-control" name="body" id="body" rows="8">{{old('body')}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </form>
                    </div>

                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag $error */
                            @endphp
                            <ul class="alert-danger alert">
                                <li>
                                    {{$error}}
                                </li>
                            </ul>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
