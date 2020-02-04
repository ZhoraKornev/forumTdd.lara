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
                                <label for="title"></label>
                                <input type="text"
                                       class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="enter title here">
                                <small id="helpId" class="form-text text-muted">Help text</small>
                            </div>
                            <div class="form-group">
                                <label for="body"></label>
                                <textarea class="form-control" name="body" id="body" rows="8"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
