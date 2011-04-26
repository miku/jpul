/*
 * Jobboard Career Center University of Leipzig - Widget
 * Docs: http://wwwdup.uni-leipzig.de/jobportal/widget/
 *
 * Dev Resources:
 *
 * http://blog.theaccidentalgeek.com/post/2008/08/21/Passing-parameters-to-JavaScript-files.aspx
 * http://jquery-howto.blogspot.com/2009/03/check-if-jqueryjs-is-loaded.html
 * http://stackoverflow.com/questions/1455870/jquery-wait-for-function-to-complete-to-continue-processing
 * http://stackoverflow.com/questions/2190801/passing-parameters-to-javascript-files
 * http://stackoverflow.com/questions/268490/jquery-document-createelement-equivalent
 * http://unixpapa.com/js/dyna.html
 * http://www.countable.info/dynamic_jquery/dynamic_jQuery.html
 * http://www.w3.org/TR/html40/interact/scripts.html
 *
 */

ccul_jobportal_load = function() {
  ccul_jobportal_load.getJQueryOnDemand("http://wwwdup.uni-leipzig.de/jobportal/js/jquery-1.4.3.min.js");
}

ccul_jobportal_load.getJQueryOnDemand = function(src) {
	if (typeof $ == "undefined") {
		console.log("jQuery seems absent.");
		ccul_jobportal_load.getScript(src);
	} else {
		console.log("jQuery already loaded. Attempting to using it.");
	}
}

ccul_jobportal_load.getScript = function(src) {
	var head = document.getElementsByTagName('head')[0];
	var script = document.createElement('script');
	script.type = 'text/javascript';
	script.src = src;
	if (typeof script != "undefined") {
		head.appendChild(script);
	}
}

ccul_jobportal_load();

ccul_jobportal_load.widget = function(query) {
	if (typeof $ == "undefined") {
		console.log("jQuery hasn't arrived.");
		setTimeout("ccul_jobportal_load.widget(\"" + query + "\")", 100);
	} else {
		console.log("jQuery is up.");
		if (typeof query != "undefined") {
			$.get('http://wwwdup.uni-leipzig.de/jobportal/widget/get?q=' + query, function(data) { console.log("Got data."); $('#ccul_jobportal_widget').html(data); });	
		} else {
			$.get('http://wwwdup.uni-leipzig.de/jobportal/widget/get', function(data) { console.log("Got data."); $('#ccul_joportal_widget').html(data); });	
		}
	}
}
