(function($){

	$(document).ready(function(e){

		var flashvars = {};
		flashvars.audioxml = audio.url+"/?audioxml=1";
		var params = {};
		var attributes = {};
		attributes.id = "grunge-mp3";
		swfobject.embedSWF(audio.template_url+"/library/flash/grunge-mp3.swf", "flashContent", "290", "166", "9.0.0", false, flashvars, params, attributes);
				
	});

})(jQuery);