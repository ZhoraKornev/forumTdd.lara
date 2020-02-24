<reply :attributes="{{$reply}}" inline-template v-cloak>
    <div id="reply-{{$reply->id}}" class="card">
        <div class="card-header"><a href="{{route('profile',$reply->owner)}}"> {{$reply->owner->name}}</a> said {{$reply->created_at->diffForHumans()}}</div>
        <div>
            <favorite :reply="{{$reply}}"></favorite>

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
            <div class="card-footer align-content-center level">
                <button class="btn btn-warning btn-xs mr-1" @click="editing = true">Edit reply</button>
                <button class="btn btn-danger btn-xs mr-1" @click="destroy">Delete reply</button>
            </div>
        @endcan
    </div>
</reply>
