@extends('layouts.app')

@section('content')
<div class="container box">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Willkommen</div>

                <div class="panel-body">
                  <img class="center-block img-responsive" src="pics/cat.jpg" alt="Katze">
                  <div class="textbox">
                      <p><strong>Was ist das? </strong>Hallo, du befindest dich auf der Einstiegsseite zu meiner
                        individuellen Studienplanung. Hier kannst du nach dem Einloggen
                        bereits absolvierte bzw. geplante Prüfungen mit Datum, Status,
                        Note, Kursname und Kursnummer eintragen. Geplant ist eine
                        Anzeige des derzeitigen Notendurchschnitts und eine
                        Bearbeitungsmöglichkeit für die bereits vorhandenen
                        Einträge.</p>
                      <p><strong>Feedback: </strong>Bei Fehlern oder Verbesserungsvorschlägen freue ich mich über
                        eine Rückmeldung unter software[at]random-access.org</p>
                      <p><strong>Achtung: </strong>Bitte noch keine Produktivdaten
                        eintragen, sollte sich die Datenbank im Hintergrund ändern,
                        kann ich nicht 100%-ig garantieren, dass keine Daten verloren
                        gehen.</p>
                      <p><strong>Verwendete Technologien / Frameworks: </strong>
                        PHP (Laravel mit Eloquent ORM), JavaScript, JQuery, HTML,
                        CSS, MySQL, Bootstrap</p>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
