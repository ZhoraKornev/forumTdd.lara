@php
    /** @var \App\User $profileUser */
    /** @var \App\Activity $activity */
@endphp
@component('profiles.activity.activity')
    @slot('heading')
        {{ $profileUser->name }} published a <a href="{{ $activity->subject->path() }}">{{$activity->subject->title }}</a>
    @endslot
    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent
