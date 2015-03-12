 @extends ('layouts.index') 
 
 @section('title') 
 Upload demo page 
 @stop

@section('css') 
    @parent 
    {{ HTML::style('css/upload.css') }}
    {{ HTML::style('css/map.css') }}     
    {{ HTML::style('vendor/jquery-file-upload/css/jquery.fileupload.css') }}
@stop 

@section('js') 
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    @parent 
    {{ HTML::script('vendor/jquery-ui/jquery.ui.widget.js') }}
    {{ HTML::script('vendor/jquery.tmpl.js') }} 
    {{ HTML::script('vendor/jquery-file-upload/tmpl.min.js') }}     
    {{ HTML::script('vendor/jquery-iframe-transport/jquery.iframe-transport.js') }} 
    {{ HTML::script('vendor/jquery-file-upload/js/load-image.all.min.js') }} 
    {{ HTML::script('vendor/jquery-file-upload/js/canvas-to-blob.min.js') }} 
    {{ HTML::script('vendor/jquery-file-upload/js/jquery.fileupload.js') }}
    {{ HTML::script('vendor/jquery-file-upload/js/jquery.fileupload-process.js') }} 
    {{ HTML::script('vendor/jquery-file-upload/js/jquery.fileupload-image.js') }} 
    {{ HTML::script('vendor/jquery-file-upload/js/jquery.fileupload-audio.js') }} 
    {{ HTML::script('vendor/jquery-file-upload/js/jquery.fileupload-video.js') }} 
    {{ HTML::script('vendor/jquery-file-upload/js/jquery.fileupload-validate.js') }}
    {{ HTML::script('vendor/jquery-file-upload/js/jquery.fileupload-ui.js') }} 
    {{ HTML::script('js/upload-component.js') }}
    {{ HTML::script('js/location-picker.js') }}
    {{ HTML::script('js/category-select.js') }}
    {{ HTML::script('js/map-view.js') }}
    {{ HTML::script('js/question-input.js') }}
@stop 

@section('content')

<div class="container">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#questionInputModal">
        Question Input
    </button>

    <!-- Question Input Modal-->
    <div class="modal fade" id="questionInputModal" tabindex="-1" role="dialog" aria-labelledby="questionInputModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="questionInputModalLabel">Question input</h4>
                </div>
                <div class="modal-body">
                    <div class="qi-question-templates">
                        <select class="form-control">
                            <option value="0">Select question template</option>
                        </select>
                    </div>
                    <div class="qi-content">
                        <textarea class="qi-content-input form-control" rows="3" placeholder="Enter your question here"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="qi-preview">
                        <table role="presentation" class="qi-attach-preview table table-striped">
                            <tbody class="files"></tbody>
                        </table>
                    </div>
                    <div class="qi-attach">
                        <div id="fileupload" >
                            <!-- The fileinput-button span is used to style the file input field as button -->
                            <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-picture"></i>
                                <input type="file" name="files[]" multiple>
                            </span>
                            <!-- The table listing the files available for upload/download -->
                            
                        </div>
                        <button class="qi-attach-image-btn btn btn-default">
                            <span class="glyphicon glyphicon-picture">
                                <input type="file" name="files[]" multiple>
                            </span>
                        </button>
                        <button class="qi-attach-video-btn btn btn-default">
                            <span class="glyphicon glyphicon-facetime-video">
                                <input type="file" name="files[]">
                            </span>
                        </button>
                        <button class="btn btn-default qi-location-picker-btn"><span class="glyphicon glyphicon-map-marker"></span></button>
                        <button class="btn btn-default qi-select-category-btn">Category</button>    
                    </div>
                    <button type="button" class="btn btn-primary qi-ok-btn">OK</button>
                    <button type="button" class="btn btn-primary">Input guideline</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Question input confirm -->
    <div class="modal fade" id="qi-confirm-modal" tabindex="-1" role="dialog" aria-labelledby="qi-confirm-modal-label">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="qi-confirm-modal-label">Question input confirm</h4>
                </div>
                <div class="modal-body">
                    <p class="qi-confirm-qt"></p>
                    <textarea class="qi-confirm-content form-control" rows="3" disabled></textarea>
                    <div class="qi-confirm-map-view" >
                        <div id="map-view-canvas" style="width: 390px; height:250px;"></div>
                    </div>
                    <div class="qi-confirm-preview">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Edit</button>
                    <button type="button" class="btn btn-primary qi-confirm-add-btn">Add</button>
                    <button type="button" class="btn btn-default">Translate</button>
                    <button type="button" class="btn btn-default">Input guideline</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Question input translate -->
    <div class="modal fade" id="qi-translate-modal" tabindex="-1" role="dialog" aria-labelledby="qi-translate-modal-label">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="qi-translate-modal-label">Question input confirm</h4>
                </div>
                <div class="modal-body">
                    <p>Question Input Confirm</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Edit</button>
                    <button type="button" class="btn btn-primary">Share</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Category select -->
    <div class="modal fade" id="category-modal" tabindex="-1" role="dialog" aria-labelledby="category-modal-label">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="category-modal-label">Category select</h4>
                </div>
                <div class="modal-body">
                    <div class="category-select">
                        <select class="form-control">
                            <option value="0">Select Category</option>
                        </select>
                    </div>
                    <div class="category-content">
                        <textarea class="category-content-input form-control" rows="3" disabled></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                    <button type="button" class="btn btn-primary category-ok-btn">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Location picker dialog -->
    <div id="location-picker-modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Select a location</h4>
          </div>
          <div class="modal-body">
            <input id="pac-input" autocomplete="on" class="controls" type="text" placeholder="Search Box">
            <div id="map-canvas"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="location-picker-ok-btn btn btn-primary">OK</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- question post waiting -->
    <div class="question-post-progress">
        <div class="progress">
            <div class="question-post-progressbar progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 0;">
            </div>
        </div>
    </div>
</div>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <span class="start">
                    <i class="glyphicon glyphicon-upload"></i>
                </span>
            {% } %}
            {% if (!i) { %}
                <span class="cancel">
                    <i class="glyphicon glyphicon-remove-sign"></i>
                </span>
            {% } %}
        </td>
    </tr>
{% } %}
</script>

<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
    </tr>
{% } %}
</script>

<!-- Question templates-->
<script id='question-template' type='text/x-jquery-tmpl'>
  <option value="${id}">${content}</option>
</script>

<!-- Category template-->
<script id='category-template' type='text/x-jquery-tmpl'>
  <option value="${id}">${title}</option>
</script>
@stop
