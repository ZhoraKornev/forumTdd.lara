<div class="card">
    <div class="card-header"><a href="{{route('profile',$reply->owner)}}"> {{$reply->owner->name}}</a> said {{$reply->created_at->diffForHumans()}}</div>
    <div>
        {{$reply->favorites_count}}
        <form method="POST" action="{{'/replies/'.$reply->id.'/favorite'}}" >
            {{csrf_field()}}
            <button type="submit" class="btn btn-primary" {{ $reply->isFavorited() ? 'disabled' :''}} >
                Favorite
            </button>
        </form>
    </div>

    <div class="card-body">
        <div class="text-body">
            {{ $reply->body }}
        </div>
        <hr>
    </div>
</div>
