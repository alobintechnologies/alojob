<div class="media comment">
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
    <div class="attachments list-group">
      @foreach($comment->attachments as $attachment)
        <div class="list-group-item">
          <a href="{{ route('attachments.show', $attachment->id) }}">
            <span>{{ $attachment->label }}</span><span>.{{ $attachment->extension }}</span>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</div>
