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
                    <div class="qi-attach">
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

    <!-- Map view -->
    <div class="modal map-view-container">
        <div id="map-view-canvassss"></div>
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
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>

<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
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
