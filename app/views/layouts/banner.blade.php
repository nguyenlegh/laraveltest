<div id="carousel-example-generic" class="carousel slide"
	data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#carousel-example-generic" data-slide-to="0"
			class="active"></li>
		<li data-target="#carousel-example-generic" data-slide-to="1"></li>
		<li data-target="#carousel-example-generic" data-slide-to="2"></li>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
		<div class="item active">
			{{ HTML::image('images/banner01.jpg', $alt="Banner 01", $attributes = array()) }}
			<div class="carousel-caption">Banner 01</div>
		</div>
		<div class="item">
			{{ HTML::image('images/banner02.jpg', $alt="Banner 02", $attributes = array()) }}
			<div class="carousel-caption">Banner 02</div>
		</div>
		<div class="item">
			{{ HTML::image('images/banner03.jpg', $alt="Banner 03", $attributes = array()) }}
			<div class="carousel-caption">Banner 03</div>
		</div>
		<div class="item">
			{{ HTML::image('images/banner04.jpg', $alt="Banner 04", $attributes = array()) }}
			<div class="carousel-caption">Banner 04</div>
		</div>
	</div>

	<!-- Controls -->
	<a class="left carousel-control" href="#carousel-example-generic"
		role="button" data-slide="prev"> <span
		class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span
		class="sr-only">Previous</span>
	</a> <a class="right carousel-control" href="#carousel-example-generic"
		role="button" data-slide="next"> <span
		class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span
		class="sr-only">Next</span>
	</a>
</div>