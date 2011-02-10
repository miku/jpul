<h1 class="spacetop">Für Arbeitgeber</h1>
<p>Als Arbeitgeber haben Sie die Möglichkeit,
	Ausschreibungen auf unserer Jobportal-Plattform
	zu veröffentlichen. Lesen Sie unsere
	<a href="/docs/2011_02_07_Einstellung_eines_Angebotes_im_Jobportal.pdf">Anleitung als PDF</a>.
</p>

<script>
// http://james.padolsey.com/javascript/detect-ie-in-js-using-conditional-comments/
var ie = (function(){
 
    var undef,
        v = 3,
        div = document.createElement('div'),
        all = div.getElementsByTagName('i');
 
    while (
        div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
        all[0]
    );
 
    return v > 4 ? v : undef;
 
}());
</script>


<p>

	<script type="text/javascript" charset="utf-8">
		if (ie === undefined) {
			document.write("<a href=\"<?php echo $this->createUrl('job/draft') ?>\">Jetzt ein Angebot einstellen</a>");
		} else {
			document.write("<a href=\"<?php echo $this->createUrl('job/draft', array('version' => '1')) ?>\">Jetzt ein Angebot einstellen</a>");
		}
	</script>

</p>
