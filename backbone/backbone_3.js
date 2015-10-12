// (function($){
// 	var Item = Backbone.Model.extend({
// 		defaults: {
// 			part1: 'Du är',
// 			part2: ' nummer:'
// 		}
// 	});

// 	var List = Backbone.Collection.extend({
// 		model : Item
// 	});

// 	var ListView = Backbone.View.extend({
// 		el : $("body"),
// 		events: {
// 			'click button#add' : 'addItem'
// 		},

// 		initialize : function(){
// 			_.bindAll(this, 'render','addItem','appendItem');

// 			this.collection = new List();
// 			this.collection.bind('add', this.appendItem);

// 			this.counter = 0;
// 			this.render();
// 			console.log("kotte1");
// 		},
// 		render : function(){

// 			var self = this;
// 			$(this.el).append("<button id='add'>Lägg till</button>");
// 			$(this.el).append("<ul></ul>");
// 			_(this.collection.models).each(function(item){

// 			}, this);
// 			console.log("kotte2");
// 		},
// 		addItem: function(){
// 			this.counter++;
// 			var item = new Item();
// 			item.set({
// 				part2: item.get('part2') +" "+ this.counter 
// 			});
// 			this.collection.add(item);
// 			console.log("kotte3");
// 		},
// 		appendItem : function(item){
// 			$('ul', this.el).append("<li>"+ item.get('part1') +" "+ item.get('part2')+"</li>");
// 			console.log("kotte4");
// 		}
// 	});

// 	var listView = new ListView();
// })(jQuery);
