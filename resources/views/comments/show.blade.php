<div class="media">
  <div class="media-left">
    <p class="img-circle" title="{{ $comment->author->name }}">
      <i class="fa fa-user fa-3x"></i>
    </p>
  </div>
  <div class="media-body">
    <h5>{{ $comment->author->name }}</h5>
    {!! $comment->comment !!}
    <h5>
      <small class="posted-msg">Posted on {{ $comment->created_at->diffForHumans() }}</small>
    </h5>
  </div>
</div>
