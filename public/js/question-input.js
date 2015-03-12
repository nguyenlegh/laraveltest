/**
 * Question input object
 *
 */
jQuery(document).ready(function($) {
    var questionInput = new QuestionInput();
});
var QuestionInput = function(options) {
    this.options = $.extend({}, options);
    this.userId = '';
    this.category = {
        id: 0,
        title: ''
    };
    this.questionTemplate = {};
    this.content = '';
    this.contentTranslate = '';
    this.location = {
        lat: 0,
        lng: 0,
        address: ''
    };
    this.mediaList = [];
    this.imageCount = 0;
    this.videoCount = 0;
    this.isImageQuestion = false;
    this.qiView = $('#questionInputModal');
    this.qiConfirmView = $('#qi-confirm-modal');
    this.qiCategorySelectView = $('#qi-category-select-modal');
    this.qiTranslateView = $('#qi-translate-modal');
    this.init(this.options);
};
QuestionInput.prototype.init = function(options) {
    this.locationPicker = new LocationPicker(this);
    this.categoryModal = new Category(this);
    this.mapView = new MapView(this);
    this.uploadManager = new UploadManager(this);
    this.getAllQuestionTemplates();
    this.initEvents();
};
QuestionInput.prototype.initEvents = function() {
    var _self = this;
    _self.qiView.find('.qi-ok-btn').on('click', function(evt) {
        // save the current text
        _self.content = _self.qiView.find('.qi-content-input').val();
        _self.showConfirm();
    });
    // init event for select question template
    _self.qiView.find(".qi-question-templates select").change(function() {
        if ($(this).find("option:selected").val() > 0) {
            _self.questionTemplate.id = $(this).find("option:selected").val();
            _self.questionTemplate.content = $(this).find("option:selected").text();
        } else {
            _self.questionTemplate = {};
        }
    });
    // confirm add button
    _self.qiConfirmView.find('.qi-confirm-add-btn').on('click', function(evt) {
        //_self.qiConfirmView.modal('hide');
        _self.showSelectCategory();
    });
    // show location picker
    _self.qiView.find('.qi-location-picker-btn').on('click', function(evt) {
        console.log('Location picker');
        _self.showLocationPicker();
    });
    // show map view on confirm
    this.qiConfirmView.on('shown.bs.modal', function(e) {
        if (!_self.mapView.isInitialize) {
            _self.mapView.initMapView();
            // we will show data here because of map don't show complete
            if (_self.location && _self.location.lat && _self.location.lng) {
                _self.qiConfirmView.find('.qi-confirm-map-view').show();
                _self.mapView.panMapTo(_self.location);
            } else {
                _self.qiConfirmView.find('.qi-confirm-map-view').hide();
            }
        }
    });
    // preview
    this.qiConfirmView.on('hide.bs.modal', function(e) {
        _self.qiView.find('.qi-preview').append(_self.qiConfirmView.find('.qi-confirm-preview').children());
    });
};
QuestionInput.prototype.getAllQuestionTemplates = function() {
    var _self = this;
    var getQTurl = '/get-all-question-templates';
    $.post(getQTurl, {
        name: "Donald Duck",
        city: "Duckburg"
    }, function(data, status) {
        if (status == 'success' && data.data.length) {
            _self.renderQuestionTemplates(data.data);
        }
    });
};
QuestionInput.prototype.renderQuestionTemplates = function(dataRender) {
    var _self = this;
    //this.qiView.find('.qi-question-templates select').empty();    
    for (var i = 0; i < dataRender.length; i++) {
        $('#question-template').tmpl(dataRender[i]).appendTo(this.qiView.find('.qi-question-templates select'));
    }
};
QuestionInput.prototype.processConfirmData = function() {
    var _self = this;
    // question template
    if (_self.questionTemplate && _self.questionTemplate.content) {
        _self.qiConfirmView.find('.qi-confirm-qt').show();
        _self.qiConfirmView.find('.qi-confirm-qt').html(_self.questionTemplate.content);
    } else {
        _self.qiConfirmView.find('.qi-confirm-qt').hide();
    }
    // content
    if (_self.content) {
        _self.qiConfirmView.find('.qi-confirm-content').show();
        _self.qiConfirmView.find('.qi-confirm-content').val(_self.content);
    } else {
        _self.qiConfirmView.find('.qi-confirm-content').hide();
    }
    // attached view
    if (_self.imageCount || _self.videoCount) {
        _self.qiConfirmView.find('.qi-confirm-preview').empty().show();
        _self.qiConfirmView.find('.qi-confirm-preview').append(_self.qiView.find('.qi-attach-preview'));
    } else {
        _self.qiConfirmView.find('.qi-confirm-preview').hide();
    }
    // map view
    /*if (_self.location && _self.location.lat && _self.location.lng) {
        _self.qiConfirmView.find('.qi-confirm-map-view').show();
        console.log(_self.location);
        _self.mapView.panMapTo(_self.location);
    } else {
        _self.qiConfirmView.find('.qi-confirm-map-view').hide();
    }*/
};
QuestionInput.prototype.saveQuestion = function() {
    var _self = this;
    $('.question-post-progressbar').css('width', '0%');
    $('.question-post-progress').show();
    console.log('saveQuestion');
    var saveQuestionUrl = '/save-question';
    $.post(saveQuestionUrl, {
        data: _self.toJson()
    }, function(data, status) {
        console.log(data);
        var quesPercent = 100/(_self.imageCount + _self.videoCount);
        $('.question-post-progressbar').css('width', quesPercent + '%');
        console.log($(".qi-confirm-preview .start"));
        $(".qi-confirm-preview .start").click();
        //if (status == 'success' && data.data.length) {
            //done save question, start upload now

        //}
    });
};
QuestionInput.prototype.toJson = function() {
    var _self = this;
    return JSON.stringify({ 'content': _self.content, 
        'question-template': _self.questionTemplate,
        'category': _self.category,
        'location': _self.location,
        'translate': _self.contentTranslate }); 
};
QuestionInput.prototype.updateMedia = function(data) {
    console.log('updateMedia');
};
QuestionInput.prototype.reset = function() {
    console.log('reset');
};
QuestionInput.prototype.showConfirm = function() {
    if (this.qiConfirmView) {
        this.qiConfirmView.modal('show');
        this.processConfirmData();
    }
};
QuestionInput.prototype.showSelectCategory = function() {
    if (this.categoryModal) {
        this.categoryModal.getView().modal('show');
        this.categoryModal.setData(this.content);
    }
};
QuestionInput.prototype.showTranslateDialog = function() {
    if (this.qiTranslateView) {
        this.qiTranslateView.modal('show');
    }
};
QuestionInput.prototype.showLocationPicker = function() {
    var _self = this;
    this.locationPicker.getView().modal('show');
    this.locationPicker.getView().unbind('shown.bs.modal');
    this.locationPicker.getView().on('shown.bs.modal', function(e) {
        if (!_self.locationPicker.isInitialize) {
            _self.locationPicker.initialize();
        }
    });
    this.locationPicker.getView().unbind('hidden.bs.modal');
    this.locationPicker.getView().on('hidden.bs.modal', function(e) {
        if (_self.locationPicker) {
            _self.locationPicker.reset();
        }
    });
};
QuestionInput.prototype.setLocation = function(location) {
    var _self = this;
    console.log('qi location');
    console.log(location);
    if (location) {
        _self.location.lat = location.geometry.location.k;
        _self.location.lng = location.geometry.location.D;
        _self.location.address = location.formatted_address;
    }
    console.log(_self.location);
};
QuestionInput.prototype.setCategory = function(category) {
    if (category) {
        this.category.id = category.id;
        this.category.title = category.title;
    }
};
QuestionInput.prototype.getView = function() {
    return this.qiView;
};
QuestionInput.prototype.getConfirmView = function() {
    return this.qiConfirmView;
};
QuestionInput.prototype.getQuestionText = function() {
    return this.content;
};
QuestionInput.prototype.getLocationPicker = function() {
    return this.locationPicker;
};
QuestionInput.prototype.getCategory = function() {
    return this.categoryModal;
};
QuestionInput.prototype.incrImageCount = function() {
    this.imageCount++;
};