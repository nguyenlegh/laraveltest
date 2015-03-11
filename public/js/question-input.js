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
        name: ''
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
        _self.questionTemplate.id = $(this).find("option:selected").val();
        _self.questionTemplate.content = $(this).find("option:selected").text();
    });
    // show category here
    _self.qiView.find('.qi-select-category-btn').on('click', function(evt) {
        console.log('select category');
        _self.content = 'test here';
        _self.showSelectCategory();
    });
    // show location picker
    _self.qiView.find('.qi-location-picker-btn').on('click', function(evt) {
        console.log('Location picker');
        _self.showLocationPicker();
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
    if (_self.questionTemplate && _self.questionTemplate.content) {
        _self.qiConfirmView.find('.qi-confirm-qt').show();
        _self.qiConfirmView.find('.qi-confirm-qt').html(_self.questionTemplate.content);
    } else {
        _self.qiConfirmView.find('.qi-confirm-qt').hide();
    }
    if (_self.content) {
        _self.qiConfirmView.find('.qi-confirm-content').show();
        _self.qiConfirmView.find('.qi-confirm-content').val(_self.content);
    } else {
        _self.qiConfirmView.find('.qi-confirm-content').hide();
    }
};
QuestionInput.prototype.showConfirm = function() {
    if (this.qiConfirmView) {
        this.processConfirmData();
        this.qiConfirmView.modal('show');
    }
};
QuestionInput.prototype.showSelectCategory = function() {
    if (this.categoryModal) {
        this.categoryModal.getView().modal('show');
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
    this.locationPicker.getView().on('shown.bs.modal', function(e) {
        if (!_self.locationPicker.isInitialize) {
            _self.locationPicker.initialize();
        }
    });
    this.locationPicker.getView().on('hidden.bs.modal', function(e) {
        if (_self.locationPicker) {
            _self.locationPicker.reset();
        }
    });
}
QuestionInput.prototype.setLocation = function(location) {
    var _self = this;
    console.log('qi location');
    console.log(location);
    if (location) {
        _self.location.lat = location.geometry.location.D;
        _self.location.lng = location.geometry.location.k;
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