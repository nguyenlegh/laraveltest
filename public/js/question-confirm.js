/**
 * Question input object
 *
 */
var QuestionConfirm = function(delegate, options) {
    this.delegate = delegate;
    this.options = $.extend({}, options);
    this.init(this.options);
};
QuestionConfirm.prototype.init = function(options) {
    console.log('question confirm');
    console.log(this.delagate.locationPicker);
    this.initEvents();
};
QuestionConfirm.prototype.initEvents = function() {
    var _self = this;
    _self.qiView.find('.qi-ok-btn').on('click', function(evt) {
        // save the current text
        _self.content = _self.qiView.find('.qi-content-input').val();
        _self.showSelectCategory();
    });
};
QuestionConfirm.prototype.showSelectCategory = function() {
    if (this.categoryModal) {
        this.categoryModal.getView().modal('show');
    }
};
QuestionConfirm.prototype.getView = function() {
    return this.delegate.getConfirmView();
};