@extends('layouts.master')

@section('javascript')
<script>
	function daysInMonth(month, year) {
		var monthStart = new Date(year, month, 1);
		var monthEnd = new Date(year, month + 1, 1);
		var monthLength = Math.round((monthEnd - monthStart) / (1000 * 60 * 60 * 24));
		return monthLength;
	}

	function dayStartInMonth(month, year) {
		return new Date(year, month, 1).getDay();
	}

	function dayEndInMonth(month, year, days) {
		return new Date(year, month, days).getDay();
	}

	var year 	= new Date().getFullYear();
	var month 	= new Date().getMonth();

	var realMonth 	= month;
	var realYear 	= year;
	var realDay 	= new Date().getDate();

	function renderCalendar(month, year) {
		var html 		= [],
			controls	= [];

		var startDay 	= dayStartInMonth(month, year); // 0 - 6 Monday - Sunday
		var endDay 		= dayEndInMonth(month, year, daysInMonth(month, year));
		var nextYear 	= (month == 11) ? year + 1 : year;
		var nextMonth 	= (month == 11) ? 0 : month + 1;
		var prevMonth 	= (month == 0) ? 11 : month - 1;
		var prevYear	= (month == 0) ? year - 1 : year;

		if(startDay === 0)
			startDay = 7;

		var months = ['Januari', 'Februari', 'Mars', 'April', 'Maj', 'Juni', 'Juli', 'Augusti', 'September', 'Oktober', 'November', 'December'];

		controls.push('<div class="left"><i class="ion-arrow-left-b"></i></div><div class="month">' + months[month] + ', ' + year + '</div><div class="right"><i class="ion-arrow-right-b"></i></div>')
		var days = ['M', 'T', 'O', 'T', 'F', 'L', 'S']; 
		for(var i = 0; i < 7; i++) {
			html.push('<div class="days">' + days[i] + '</div>');
		}
		for(var i = startDay, j = daysInMonth(prevMonth, prevYear) - startDay + 2; i > 1; i--, j++) {
			html.push('<div class="prevDay">' + j + '</div>');
		}
		for(var i = 1; i <= daysInMonth(month, year); i++) {
			if(year === realYear && month === realMonth && realDay === i) {	
				html.push('<a href="/activity/date/' + year + '-' + (month + 1) + '-' + i + '"><div class="current day">' + i + '</div></a>');
				continue;
			}
			html.push('<a href="/activity/date/' + year + '-' + (month + 1) + '-' + i + '"><div class="day">' + i + '</div></a>');
		}
		for(var i = 0, j = 1; i < 7 - endDay; i++, j++) {
			html.push('<div class="nextDay">' + j + '</div>');
		}

		$('.calendarize .controls').html(controls);
		$('.calendarize .dates').html(html);
	}

	$('.calendarize').on('click', '.controls .left', function() {
		year = (month == 0) ? year - 1 : year;
		month = (month == 0) ? 11 : month - 1;
		renderCalendar(month, year);
	});

	$('.calendarize').on('click', '.controls .right', function() {
		year = (month == 11) ? year + 1 : year; 
		month = (month == 11) ? 0 : month + 1;
		renderCalendar(month, year);
	});

	renderCalendar(realMonth, realYear);

	if($('.calendarize').data('date') !== '') {
		year 	= parseInt($('.calendarize').data('date')['year']);
		month 	= parseInt($('.calendarize').data('date')['month']) - 1;
		renderCalendar(month, year);
	}
</script>
@stop

@section('content')

<!-- Calender and category-list -->

	<!-- <div class="row">
		<div class="col-md-3">
			<div class="search-panel">
				<div class="calender">
					<h2>Kalender</h2>
					<div class="calendarize" data-date="{{{ $datejson or '' }}}">
						<div class="controls"></div>
						<div class="dates"></div>
					</div>
				</div>		
				<div>
					<h2>Kategorier</h2>
					@foreach($categories as $category)
						{{ HTML::linkAction('ActivityController@filterByCategory', $category->name, $category->slug, ['class' => 'btn btn-default category_button'])}}
					@endforeach
				</div>
			</div>
		</div> -->
		
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 top-header">
					<!-- <div class="welcome-text-first">
						<h1 class="text-center">Redo att hitta på något skoj idag?<h2 class="text-center"> Här hittar du massvis med trevliga aktiviteter!</h2>
					</div> -->
			    		<p class="text-center visible-xs"><a href="{{ URL::asset('/register') }}" class="text-right">Vill du bli medlem?</a></p>
			  		
					@include('menu.activity_func')
						<div class="filter-panel">
							<div class="col-md-6 col-md-offset-3">
								<div class="search-panel">
									<div class="calender" id="hunden">
										<div class="calendarize" data-date="{{{ $datejson or '' }}}">
										<div class="controls"></div>
										<div class="dates"></div>
									</div>
								</div>
						</div>					
					</div>
				</div>		
			</div>
		</div>
		<div class="category-list" id="categori">
						<!-- <h2>Kategorier</h2> -->
						@foreach($categories as $category)
							{{ HTML::linkAction('ActivityController@filterByCategory', $category->name, $category->slug, ['class' => 'btn btn-default category_button'])}}
						@endforeach
					</div>
		
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-10 col-lg-offset-1 flow">
				@if($activities->count() == 0)
					<h2 class="text-center">Finns inga aktiviteter registrerade på det här datumet.<h2><h2 class="text-center"> Har du tips på någon aktivitet som kan synas här? Tipsa oss på <a href="mailto:info@fridag.se">info@fridag.se</a></h2>
				@else
					@if(isset($header))
						<h2 class="text-center">{{ $header }}</h2>
					@endif

					@foreach($activities as $activity)
						@include('template.activity-teaser')
					@endforeach
				@endif


				</div>
			</div>
			<p class="text-center reservation-info">Med reservation för eventuella ändringar i arrangörens program</p>
			<div class="text-center pagination-box"> {{ $activities->links() }}</div>
		</div>
	</div>


@stop