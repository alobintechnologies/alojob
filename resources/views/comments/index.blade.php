<div class="comments-block">
  <div class="comments">
    <div class="media">
      <div class="media-left">
        <p class="img-circle" title="">
          <i class="fa fa-user fa-3x"></i>
        </p>
      </div>
      <div class="media-body">
        <p>
          reply will be displayed here..,
        </p>
      </div>
    </div>
  </div>
  <div class="create-comment comment-editor">
    <div class="media">
      <div class="media-left">
        <p class="img-circle" title="{{ Auth::user()->name }}">
          <i class="fa fa-user fa-3x"></i>
        </p>
      </div>
      <div class="media-body">
        <textarea name="comment" rows="2" class="form-control" id="comment-editor"></textarea>
      </div>
    </div>
  </div>
</div>
