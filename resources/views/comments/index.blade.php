<div class="comments-block">
  <div class="comments" id="comments-holder">
  </div>
  <div class="create-comment comment-editor">
    <div class="media comment">
      <div class="media-left">
        <p class="img-circle" title="{{ Auth::user()->name }}">
          <i class="fa fa-user fa-3x profile-pic"></i>
        </p>
      </div>
      <div class="media-body comment-editor-block">
        <div class="comment-editor-holder">
          <input type="hidden" name="commentable-type" id="commentable-type" value="{{ $resourceType ?: '' }}" />
          <input type="hidden" name="commentable-type-id" id="commentable-type-id" value="{{ $resourceId ?: '' }}" />
          <textarea name="comment" rows="1" class="form-control" id="comment-editor"></textarea>
          <div class="clearfix"></div>
          {{--<p class="well well-sm well-light">
            <i class="fa fa-paperclip"></i> To attach files <input type="file" multiple="multiple" class="file-chooser"><button type="button" class="btn-link file-chooser-text">select from your computer</button>
          </p>--}}
          <form action="{{ route('attachments.store') }}?resourceType=Ticket&amp;resourceId={{ $resourceId }}" class="dropzone" id="commentFormDropzone">
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          </form>
          <div class="clearfix"></div>
        </div>
        <div>
          <button type="button" name="save-comment" id="save-comment" class="btn btn-success">Reply</button>
          <span>or</span>
          <button type="button" name="cancel-comment" id="cancel-comment" class="btn btn-default">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>
