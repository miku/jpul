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

function sayhi(data) {
	console.log(data);
}

ccul_jobportal_load = function() {
  ccul_jobportal_load.getJQueryOnDemand("http://wwwdup.uni-leipzig.de/jobportal/js/jquery-1.6.1.min.js");
}

ccul_jobportal_load.getJQueryOnDemand = function(src) {
	if (typeof $ == "undefined") {
		// console.log("jQuery seems absent.");
		ccul_jobportal_load.getScript(src);
	} else {
		// console.log("jQuery already loaded. Attempting to using it.");
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

ccul_jobportal_load.render = function(data) {

	var models = data["models"];
	var query = data["query"];
	
	$("div#ccul_jobportal_widget").append("<div id='ccul_jobportal_widget_box'>");
	$("div#ccul_jobportal_widget_box").css("margin", "5px 0 5px 0");
	$("div#ccul_jobportal_widget_box").css("padding", "10px");	
	$("div#ccul_jobportal_widget_box").css("border", "dashed thin #ABABAB");
	$("div#ccul_jobportal_widget_box").css("font-size", "75%");
	$("div#ccul_jobportal_widget_box").css("font", "normal 10pt Verdana,'Helvetica Neue',Arial,Tahoma,sans-serif");
	
	if (query != null && query != '') {
		$("div#ccul_jobportal_widget_box").append('<p>Universität Leipzig | Jobportal<br><a target="_blank" href="http://wwwdup.uni-leipzig.de/jobportal/index?q=' + query + '">Aktuelle Jobangebote für <strong>' + query.substring(0, 25) + ' ...</strong></a></p>');	
	} else {
		$("div#ccul_jobportal_widget_box").append('<p>Universität Leipzig | Jobportal<br><a target="_blank" href="http://wwwdup.uni-leipzig.de/jobportal/index">Aktuelle Jobangebote</a></p>');	
	}
	
	
	$("div#ccul_jobportal_widget_box").append("<ul>");
	$("div#ccul_jobportal_widget_box > ul").css("margin", "0");
	$("div#ccul_jobportal_widget_box > ul").css("padding", "0");
	$("div#ccul_jobportal_widget_box > ul").css("list-style", "none");
	
	$.each(models, function(index, job) {
		$("div#ccul_jobportal_widget_box > ul").append("<li style='padding: 2px; list-style:none;'><span style='background:#EDEDED; color:#464646; padding: 2px; font-size: 9px; -moz-border-radius: 5px; border-radius: 5px;'>" + job["date_added"] + "</span> <a href='http://wwwdup.uni-leipzig.de/jobportal/job/" + job["id"] + "?src=widget'>" + job["title"] + "</a></li>");
	});	
	
	$("div#ccul_jobportal_widget_box > ul > li > a").css("text-decoration", "none");
	$('div#ccul_jobportal_widget_box > ul > li:nth-child(odd)').css("background", "white");
}

ccul_jobportal_load.widget = function(query) {
	if (typeof $ == "undefined") {
		// console.log("jQuery hasn't arrived.");
		setTimeout("ccul_jobportal_load.widget(\"" + query + "\")", 200);
	} else {		
		$('#ccul_jobportal_widget').html('<p style="background: aliceblue; padding: 3px; color: gray;">Loading...</p>');
		// console.log("jQuery is up.");
		if (typeof query != "undefined") {
			$.getJSON('http://wwwdup.uni-leipzig.de/jobportal/widget/getJSONP?callback=?&q=' + query, ccul_jobportal_load.render);
		} else {
			$.getJSON('http://wwwdup.uni-leipzig.de/jobportal/widget/getJSONP?callback=?', ccul_jobportal_load.render);
		}
	}
}
