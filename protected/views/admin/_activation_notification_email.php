Hallo <?php echo $model->publisher_name ?>,

Ihr Angebot (ID im Jobportal: <?php echo $model->id ?>)

    <?php echo $model->title ?>


wurde freigeschaltet. Sie finden das Angebot unter der URL:

    <?php echo $serverPrefix . $this->createUrl('job/view', array('id' => $model->id)) ?>


Sie können Ihr Angebot ändern oder löschen unter der URL:

    <?php echo $serverPrefix . $this->createUrl('ukey/preview', array('id' => $model->ukey)) ?>



Vielen Dank für die Nutzung des Jobportal der Universität Leipzig,
Ihr Career Center Team




Career Center
Universität Leipzig
Burgstraße 21, 1. Etage
04109 Leipzig

Telefon: +49 341 97-30030
Telefax: +49 341 97-30069
