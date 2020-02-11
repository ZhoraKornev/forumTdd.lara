@php
    /** @var \App\User $profileUser */
    /** @var \App\Activity[] $activities */
@endphp
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="modal-header">
            <h1> {{ $profileUser->name }}
                <small>Since {{$profileUser->created_at->diffForHumans()}}</small>
            </h1>
        </div>
        @foreach ($activities as $date => $activity)
            <div class="h3">{{$date}}</div>
            @php /** @var \App\Activity $activity */@endphp
            @foreach ($activity as $record)
                @include("profiles.activity.{$record->type}",['activity'=>$record])
            @endforeach
            <hr>
        @endforeach
    </div>
@endsection
