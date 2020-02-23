<div id="reply-{{$reply->id}}" class="card">
    <div class="card-header"><a href="{{route('profile',$reply->owner)}}"> {{$reply->owner->name}}</a> said {{$reply->created_at->diffForHumans()}}</div>
    <div>
        {{$reply->favorites_count}}
        <form method="POST" action="{{'/replies/'.$reply->id.'/favorite'}}">
            {{csrf_field()}}
            <button type="submit" class="btn btn-primary" {{ $reply->isFavorited() ? 'disabled' :''}} >
                Favorite
            </button>
        </form>
    </div>

    <div class="card-body">
        <div v-if="editing">
            <textarea></textarea>
        </div>
        <div v-else>
            <div class="text-body">
                {{ $reply->body }}
            </div>
        </div>

        <hr>
    </div>
    @can('update',$reply)
        <div class="card-footer align-content-center">
            <button type="submit" class="btn btn-warning btn-xs flex-xl-shrink-1">
                Edit reply
            </button>

            <form method="POST" action="{{'/replies/'.$reply->id}}">
                @method('DELETE')
                {{csrf_field()}}
                <button type="submit" class="btn btn-danger ">
                    Delete reply
                </button>
            </form>
        </div>
    @endcan
</div>
