/**
 * This is upload.js
 */
var UploadManager = function(delegate, options) {
    this.delegate = delegate;
    this.options = $.extend({}, options);
    this.uploadFileURL = '/upload';
    this.uploadButton = $(".qi-confirm-preview .start");
    this.init(this.options);
};
UploadManager.prototype.init = function() {
    var _self = this;
    _self.initImagesUpload();
    _self.initEvents();
};
UploadManager.prototype.initEvents = function() {
    var _self = this;
    
};
UploadManager.prototype.initVideoUpload = function() {
    var _self = this;
};
UploadManager.prototype.initImagesUpload = function() {
    var _self = this;
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '/upload',
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 100000000, // 100 MB
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function(e, data) {
        _self.uploadButton.unbind('click');
        _self.uploadButton.on("click", function() {
            // increase the image count
            data.submit();
        });
        // cancel event
        //data.context.find(".cancel").on('click', function() {
        //    console.log('cancel');
        //});
    ///data.context = $(tmpl("template-upload", file)).attr('data-data', { jqXHR: data.submit() } );
      //$('#fileupload').append(data.context);
      //data.context.find('.cancel').click( abortUpload );

console.log($(".qi-confirm-preview .start"));
        _self.delegate.incrImageCount();
        

    }).on('fileuploaddone', function(e, data) {
        console.log('upload done');
        console.log(data);
        console.log(data.context);
        // we will update database after upload here
        _self.delegate.updateMedia(data);
    });
};
UploadManager.prototype.getUploadButton = function() {
    return this.uploadButton;
};