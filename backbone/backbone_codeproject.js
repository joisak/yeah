(function($){

var Book = Backbone.Model.extend({
    defaults: {
        ID: "",
        BookName: ""
    },
    initialize: function () {
        console.log('Book has been intialized');       
    }
})



})(jQuery)