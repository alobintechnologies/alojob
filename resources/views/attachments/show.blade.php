<div class="media attachment">
  <input type="hidden" name="attachment-name" value="{{ $attachment->filename . '.' . $attachment->extension }}" />
  <input type="hidden" name="attachment-token" value="{{ $attachment->token }}" />
  <input type="hidden" name="attachment-content_type" value="{{ $attachment->content_type}}" />
  <input type="hidden" name="attachment-ext" value="{{ $attachment->extension }}" />
  <div class="media-left attachment-preview">
    <a href="#" class="remove"><i class="fa fa-trash-o"></i></a>
    <i class="fa fa-file-text-o fa-lg attachment-icon"></i>
  </div>
  <div class="media-body">
    <div class="attachment-details">
      <input type="text" class="attachment-name" value="{{ $attachment->filename }}" />
      <span class="attachment-ext">{{ $attachment->extension }}</span>
    </div>
  </div>
</div>
