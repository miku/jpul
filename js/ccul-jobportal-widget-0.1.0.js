/*
 * Jobboard Career Center University of Leipzig - Widget
 * Docs: http://www.uni-leipzig.de/~jobp/widget/
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
    ccul_jobportal_load.getJQueryOnDemand("http://www.uni-leipzig.de/~jobp/js/jquery-1.6.1.min.js");
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
        $("div#ccul_jobportal_widget_box").append('<p>Universität Leipzig | Jobportal<br><a target="_blank" href="http://www.uni-leipzig.de/~jobp/job/index?q=' + encodeURIComponent(query) + '">Aktuelle Jobangebote für <strong>' + query.substring(0, 25) + ' ...</strong></a></p>'); 
    } else {
        $("div#ccul_jobportal_widget_box").append('<p>Universität Leipzig | Jobportal<br><a target="_blank" href="http://www.uni-leipzig.de/~jobp/job/index">Aktuelle Jobangebote</a></p>'); 
    }
    
    $("div#ccul_jobportal_widget_box").append("<ul>");
    $("div#ccul_jobportal_widget_box > ul").css("margin", "0");
    $("div#ccul_jobportal_widget_box > ul").css("padding", "0");
    $("div#ccul_jobportal_widget_box > ul").css("list-style", "none");
    
    if (models.length < 1) {
        $("div#ccul_jobportal_widget_box > ul").append("<li style='padding: 2px; list-style:none;'>Wir haben keine aktuellen Angebote für die angegebenen Suchbegriffe im Jobportal gefunden.</li>");
    } else {
        $.each(models, function(index, job) {
            $("div#ccul_jobportal_widget_box > ul").append("<li style='padding: 2px; list-style:none;'><span style='background:#EFEFEF; color:#464646; padding: 2px 8px 2px 8px; font-size: 9px; -moz-border-radius: 5px; border-radius: 5px;'>" + job["date_added"] + "</span> <a target='_blank' title='" + job["title"] + "' href='http://www.uni-leipzig.de/~jobp/job/" + job["id"] + "?src=widget'>" + job["title"].substring(0, 62) + " ...</a></li>");
        }); 
    }
    
    $("div#ccul_jobportal_widget_box > ul > li > a").css("text-decoration", "none");
    $("div#ccul_jobportal_widget_box > ul > li:nth-child(odd)").css("background", "white");
    $("div#ccul_jobportal_widget_box").append('<br><div style="float:left"><a target="_blank" href="http://www.zv.uni-leipzig.de/studium/career-center.html"><img style="" src="http://www.uni-leipzig.de/~jobp/images/v2/cc_logo.gif" width="100px" alt="Career Center" /></a></div><div style="float:right; color: gray; font-size: 9px">Jobportal-Widget für <a target="_blank" href="http://www.uni-leipzig.de/~jobp/widget?src=wild">die eigene Seite erstellen ...</a></div><div style="clear:both;"></div>')
    $("div#ccul_jobportal_widget_box img").css("border", "none");
}

ccul_jobportal_load.widget = function(query) {
   if (typeof $ == "undefined") {
        // console.log("jQuery hasn't arrived.");
        setTimeout("ccul_jobportal_load.widget(\"" + query + "\")", 200);
    } else {
        // console.log("jQuery is up.");
        if (typeof query != "undefined") {
            $.getJSON('http://www.uni-leipzig.de/~jobp/widget/getJSONP?callback=?&q=' + encodeURIComponent(query), ccul_jobportal_load.render);
        } else {
            $.getJSON('http://www.uni-leipzig.de/~jobp/widget/getJSONP?callback=?', ccul_jobportal_load.render);
        }
    }
}
