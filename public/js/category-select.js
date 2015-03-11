/**
 * Question input object
 *
 */
var Category = function(delegate, options) {
    this.delegate = delegate;
    this.options = $.extend({}, options);
    this.categoryView = $('#category-modal');
    this.category = {};
    this.init(this.options);
};
Category.prototype.init = function(options) {
    this.initEvents();
    this.getAllCategory();
};
Category.prototype.initEvents = function() {
    var _self = this;
    _self.categoryView.find('.category-ok-btn').on('click', function(evt) {
        // validate here before close this dialog
        if (_self.isValid()) {
            _self.delegate.getView().modal('show');
            _self.categoryView.modal('hide');
            // save the current selected category
            _self.delegate.setCategory(_self.category);
        }
    });
    // init event for select category
    _self.categoryView.find(".category-select select").change(function() {
        _self.category.id = $(this).find("option:selected").val();
        _self.category.title = $(this).find("option:selected").text();
    });
    // set data for input
    _self.categoryView.find(".category-content-input").val(_self.delegate.getQuestionText());
};
Category.prototype.getAllCategory = function() {
    var _self = this;
    var getAllCategoryUrl = '/get-all-category';
    $.post(getAllCategoryUrl, {}, function(data, status) {
        if (status == 'success' && data.data.length) {
            _self.renderCategoryList(data.data);
        }
    });
};
Category.prototype.renderCategoryList = function(data) {
    var _self = this;
    this.categoryView.find('.category-select select').empty();
    for (var i = 0; i < data.length; i++) {
        $('#category-template').tmpl(data[i]).appendTo(_self.categoryView.find('.category-select select'));
    }
    _self.setDefaultCategory();
};
Category.prototype.setDefaultCategory = function() {
    // set default the first selected
    this.categoryView.find('.category-select select > option:first').attr('selected', true);
    this.category.id = this.categoryView.find('.category-select select > option:first').val();
    this.category.title = this.categoryView.find('.category-select select > option:first').text();
};
Category.prototype.isValid = function() {
    if (!this.category) {
        return false;
    }
    return true;
};
Category.prototype.reset = function() {
    // reset data here
};
Category.prototype.getView = function() {
    return this.categoryView;
};