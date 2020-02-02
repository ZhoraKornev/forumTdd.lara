<div class="card">
    <div class="card-header"><a href="#"> {{$reply->owner->name}}</a> said {{$reply->created_at->diffForHumans()}}</div>

    <div class="card-body">
        <div class="text-body">
            {{ $reply->body }}
        </div>
        <hr>
    </div>
</div>
