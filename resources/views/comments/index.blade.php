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
        <input type="hidden" name="commentable-type" id="commentable-type" value="{{ $resourceType ?: '' }}" />
        <input type="hidden" name="commentable-type-id" id="commentable-type-id" value="{{ $resourceId ?: '' }}" />
        <textarea name="comment" rows="2" class="form-control" id="comment-editor"></textarea>
        <div class="clearfix"></div>
        <div class="pull-right">
          <button type="button" name="save-comment" id="save-comment" class="btn btn-success">Reply</button>
          <span>or</span>
          <button type="button" name="cancel-comment" id="cancel-comment" class="btn btn-default">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>
