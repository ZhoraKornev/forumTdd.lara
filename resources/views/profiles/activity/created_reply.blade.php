@php
    /** @var \App\User $profileUser */
    /** @var \App\Activity $activity */
@endphp
@component('profiles.activity.activity')
    @slot('heading')
        {{ $profileUser->name }} replied to <a href="{{ $activity->subject->thread->path() }}"> {{ $activity->subject->thread->title }}</a>
    @endslot
    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent
