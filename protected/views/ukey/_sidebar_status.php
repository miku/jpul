<h1>Angebotsstatus</h1>
<p>
	<?php if ($model->status_id == 1): ?>
		<span style="background: #FFF380;">Dieses Angebot befindet sich im Review-Prozess.</span>
		Es wird öffentlich auf dem Jobportal sichtbar sein,
		nachdem das Career Center das Angebot freigeschaltet hat.
	<?php endif ?>
	
	<?php if ($model->status_id == 2): ?>
		<span style="color: green;">Dieses Angebot ist öffentlich sichtbar.</span>
		Falls Sie dieses Angebot bearbeiten, wird es wieder in den 
		Review-Prozess eingefügt und ist somit nicht mehr öffentlich sichtbar.
	<?php endif ?>
</p>

