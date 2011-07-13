Hallo <?php echo $model->publisher_name ?>,

Ihr am <?php echo strftime('%d.%m.%Y', $model->date_added) ?> um <?php echo strftime('%H:%M', $model->date_added) ?> eingestelltes Angebot (ID <?php echo $model->id ?>) mit dem Titel

    <?php echo $model->title ?>


wurde soeben freigeschaltet. Sie finden das Angebot unter der URL:

    <?php echo $serverPrefix . $this->createUrl('job/view', array('id' => $model->id)) ?>


Sie können Ihr Angebot ändern, verlängern oder löschen unter der URL:

    <?php echo $serverPrefix . $this->createUrl('ukey/preview', array('id' => $model->ukey)) ?>



Vielen Dank für die Nutzung des Jobportals der Universität Leipzig,
Ihr Career Center Team



P.S. Können wir die Angebotserstellung besser gestalten? Wir freuen uns
über Ihr Feedback - <?php echo $serverPrefix . $this->createUrl('feedback/index', array('context' => 'notification-email')); ?>


----

Career Center
Universität Leipzig
Burgstraße 21, 1. Etage
04109 Leipzig

Telefon: +49 341 97-30030
Telefax: +49 341 97-30069

Homepage -- http://www.zv.uni-leipzig.de/studium/career-center.html
Facebook -- http://www.facebook.com/universitaet.leipzig.career.center
Jobportal -- http://www.uni-leipzig.de/jobportal
