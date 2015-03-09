@extends ('layouts.index') 

@section('title')
	Map demo page
@stop

@section('css')
	@parent
	{{ HTML::style('css/map.css') }}	
@stop

@section('js')
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
	@parent
	{{ HTML::script('js/location-picker.js') }}
	{{ HTML::script('js/map.js') }}
@stop

@section('content')
	<div class="map-container">	
		<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#location-picker">
			Launch location picker
		</button>
		<input id="location-selected" type="text" placeholder="Location selected">
		<!-- Location dialog -->
		<div id="location-picker" class="modal fade">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Select a location</h4>
		      </div>
		      <div class="modal-body">
				<input id="pac-input" autocomplete="on" class="controls" type="text" placeholder="Search Box">
				<div id="map-canvas"></div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        <button id="map-btn-ok" type="button" class="btn btn-primary">OK</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
@stop
