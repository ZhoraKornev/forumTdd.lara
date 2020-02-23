<reply :attributes="{{$reply}}" inline-template v-cloak>
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
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                <button class="btn btn-xs btn-primary" @click="update">Update</button>
                <button class="btn btn-xs btn-link" @click="editing = false">Cancel</button>
            </div>
            <div v-else v-text="body">
                <div class="text-body">
                </div>
            </div>

            <hr>
        </div>
        @can('update',$reply)
            <div class="card-footer align-content-center">
                <button type="submit" class="btn btn-warning btn-xs flex-xl-shrink-1" @click="editing = true">
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
</reply>
