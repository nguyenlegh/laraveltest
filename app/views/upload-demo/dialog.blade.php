 @extends ('layouts.index') 
 
 @section('title') 
 Upload demo page 
 @stop

@section('css') 
    @parent 
    {{ HTML::style('css/upload.css') }} 
    {{ HTML::style('vendor/jquery-file-upload/css/jquery.fileupload.css') }}
@stop 

@section('js') 
    @parent 
    {{ HTML::script('vendor/jquery-ui/jquery.ui.widget.js') }}
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
    {{ HTML::script('js/upload.js') }} 
@stop 

@section('content')

<div class="container">
    <h1>jQuery File Upload Demo</h1>
    <h2 class="lead">Basic Plus UI version</h2>
    <ul class="nav nav-tabs">
        <li><a href="basic.html">Basic</a></li>
        <li><a href="basic-plus.html">Basic Plus</a></li>
        <li class="active"><a href="index.html">Basic Plus UI</a></li>
    </ul>
    <br>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fileupload">
        Upload dialog
    </button>
    <!-- The file upload form used as target for the file upload widget -->
    <div class="modal" role="modal" id="fileupload" >
        <div class="modal-dialog">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <span class="fileupload-process"></span>
            </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
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
@stop
