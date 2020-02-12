@php
    /** @var \App\User $profileUser */
    /** @var \App\Activity $activity */
@endphp
@component('profiles.activity.activity')
    @slot('heading')
        {{ $profileUser->name }}favored a
        <a href="{{$activity->subject->favorited->path()}}">
            reply
        </a>
    @endslot
    @slot('body')
        {{ $activity->subject->favorited->body }}
    @endslot
@endcomponent
