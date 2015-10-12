// (function($){
//   var ListView = Backbone.View.extend({
//     el : $('body'),

//     events : {
//       "click button#add" : "addItem"
//     },
//     initialize : function(){
//       _.bindAll(this, 'render', 'addItem'); // every function that uses 'this' as the current object should be in here

//       this.counter = 0;
//       this.render();
//     },
//     render : function(){
//       $(this.el).append("<button id='add'>Lägg till</button>");
//       $(this.el).append("<ul></ul>");
//     },
//     addItem : function(){
//       this.counter++;
//       $('ul', this.el).append("<li>" + this.counter + "</li>");
//     }
//   });

//   var listView = new ListView();
// })(jQuery);