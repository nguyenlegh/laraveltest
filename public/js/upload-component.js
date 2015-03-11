/**
 * This is upload.js
 */
var UploadManager = function(options) {
    this.options = $.extend({}, options);
    this.uploadFileURL = '/upload';
    this.init(this.options);
};
UploadManager.prototype.init = function() {
    var _self = this;
    _self.initEvents();
};
UploadManager.prototype.initEvents = function() {
    var _self = this;
    _self.initVideoUpload();
};
UploadManager.prototype.initVideoUpload = function() {
    var _self = this;
    $('#video-fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: _self.uploadFileURL,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(avi|mp4|mkv|mov)$/i,
        maxFileSize: 100000000, // 100 MB
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function(e, data) {
        $('#files').empty();
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function(index, file) {
            var node = $('<p/>').append($('<span/>').text(file.name));
            if (!index) {
                node.append('<br>').append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function(e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node.prepend('<br>').prepend(file.preview);
        }
        if (file.error) {
            node.append('<br>').append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button').text('Upload').prop('disabled', !! data.files.error);
        }
    }).on('fileuploadprogressall', function(e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css('width', progress + '%');
    }).on('fileuploaddone', function(e, data) {
        if (data.result.status == 'success') {
            $('#files').empty();
            $('#product-thumb').val(data.result.path);
            $('.current-product-image').find('img').attr('src', data.result.url);
        } else {
            alert(data.result.messages);
        }
        /*
         * $.each(data.result.files, function (index, file) {
         * if (file.url) { var link = $('<a>')
         * .attr('target', '_blank') .prop('href',
         * file.url); $(data.context.children()[index])
         * .wrap(link); } else if (file.error) { var error =
         * $('<span
         * class="text-danger"/>').text(file.error);
         * $(data.context.children()[index]) .append('<br>')
         * .append(error); } });
         */
    }).on('fileuploadfail', function(e, data) {
        $.each(data.files, function(index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index]).append('<br>').append(error);
        });
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
};
UploadManager.prototype.initImagesUpload = function() {
    var _self = this;
    var url = _self.uploadProductURL;
    var uploadButton = $('<button/>').addClass('btn btn-primary').prop('disabled', true).text('Processing...').on('click', function() {
        var $this = $(this),
            data = $this.data();
        $this.off('click').text('Abort').on('click', function() {
            $this.remove();
            data.abort();
        });
        data.submit().always(function() {
            $this.remove();
        });
    });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        // Enable image resizing, except for Android and
        // Opera,
        // which actually support image resizing, but fail
        // to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function(e, data) {
        $('#files').empty();
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function(index, file) {
            var node = $('<p/>').append($('<span/>').text(file.name));
            if (!index) {
                node.append('<br>').append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function(e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node.prepend('<br>').prepend(file.preview);
        }
        if (file.error) {
            node.append('<br>').append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button').text('Upload').prop('disabled', !! data.files.error);
        }
    }).on('fileuploadprogressall', function(e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css('width', progress + '%');
    }).on('fileuploaddone', function(e, data) {
        if (data.result.status == 'success') {
            $('#files').empty();
            $('#product-thumb').val(data.result.path);
            $('.current-product-image').find('img').attr('src', data.result.url);
        } else {
            alert(data.result.messages);
        }
        /*
         * $.each(data.result.files, function (index, file) {
         * if (file.url) { var link = $('<a>')
         * .attr('target', '_blank') .prop('href',
         * file.url); $(data.context.children()[index])
         * .wrap(link); } else if (file.error) { var error =
         * $('<span
         * class="text-danger"/>').text(file.error);
         * $(data.context.children()[index]) .append('<br>')
         * .append(error); } });
         */
    }).on('fileuploadfail', function(e, data) {
        $.each(data.files, function(index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index]).append('<br>').append(error);
        });
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
};
UploadManager.prototype.uploadImages = function() {};
UploadManager.prototype.uploadVideo = function() {};
UploadManager.prototype.addProduct = function() {
    var _self = this;
    if (_self.validateBeforeSave(form)) {
        var formData = form.serialize();
        $.post(_self.addProductURL, formData, function(result) {
            if (result.status == 'success') {
                alert(result.messages);
            }
        });
    }
};
UploadManager.prototype.validateBeforeSave = function() {
    // validate name
    var $productName = form.find('#inputName');
    if ($productName.val() == '') {
        alert('Nhap tên danh muc.');
        $productName.focus();
        return false;
    }
    return true;
};