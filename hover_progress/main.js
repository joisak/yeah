$(window).load(function(){

	setTimeout(function(){
		$('.wrap').fadeOut('active')
	},1500);
		setTimeout(function(){
		    $('.wrapper').fadeIn(2000);
	},1800);

	var progressbar = $('#progressbar'),
		max			= progressbar.attr('max');
		value		= progressbar.val();
		time 		= (1200/max) * 1;

	var loading = function(){
		value += 1;
		addValue = progressbar.val(value);

		$('.progress-value').html(value + '%');

		if(value == max){
			$(progressbar).fadeOut('fast');
		}
	};

	var animate = setInterval(function(){
		loading();
	}, time);


});

