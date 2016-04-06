@extends('layouts.app')

@section('content')
<div class="container box">
        <div class="col-sm-12">

            <!-- Panel for current Courses -->
            @if (count($courses) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Kursübersicht
                    </div>

                    <div class="panel-body table-responsive">
                        <table class="table table-striped course-table">
                            <thead>
                                <th>&nbsp;</th>
                                <th>Kursnummer</th>
                                <th>Kursbezeichnung</th>
                                <th>Status</th>
                                <th>Prüfungsart</th>
                                <th>Prüfungsdatum</th>
                                <th>Note</th>
                                <th>Löschen</th>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td class="table-text course-icn"><div><i class="fa fa-check-circle-o"></i></div></td>
                                        <td class="table-text"><div>{{ $course->course_no }}</div></td>
                                        <td class="table-text"><div>{{ $course->course_name }}</div></td>
                                        <td class="table-text status"><div>{{ $course->status }}</div></td>
                                        <td class="table-text"><div>{{ $course->exam_mode }}</div></td>
                                        <td class="table-text"><div>{{ $course->exam_date }}</div></td>
                                        <td class="table-text"><div>{{ $course->exam_grade }}</div></td>

                                        <!-- Course Delete Button -->
                                        <td>
                                            <form action="/course/{{ $course->id }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-course-{{ $course->id }}" class="btn btn-danger btn-circle">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            <!-- End panel for current courses-->

            <!-- Panel for adding courses-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Kurs hinzufügen
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Course Form -->
                    <form action="/course" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Course Number -->
                        <div class="form-group">
                            <label for="cnumber" class="col-sm-3 control-label">Kursnummer</label>

                            <div class="col-sm-6">
                                <input type="text" name="cnumber" id="cnumber" class="form-control" value="{{ old('cnumber') }}">
                            </div>
                        </div>

                        <!-- Course Name -->
                        <div class="form-group">
                            <label for="cname" class="col-sm-3 control-label">Kursname</label>

                            <div class="col-sm-6">
                                <input type="text" name="cname" id="cname" class="form-control" value="{{ old('cname') }}">
                            </div>
                        </div>

                        <!-- Course Status -->
                        <div class="form-group">
                            <label for="cstatus" class="col-sm-3 control-label">Status</label>

                            <!-- Form Select for status -->
                            <div class="col-sm-3">
                              {{ Form::select('cstatus', [
                                  'planned' => "Geplant",
                                  'active' => "In Arbeit",
                                  'completed' => "Erledigt"],
                                  'active', ['class' => 'form-control']) }}
                            </div>

                        </div>

                        <!-- Course exam mode TODO dropdown button-->
                        <div class="form-group">
                            <label for="emode" class="col-sm-3 control-label">Prüfungsart</label>

                            <div class="col-sm-3">
                              {{ Form::select('emode', [
                                  'written' => "Schriftlich",
                                  'verbal' => "Mündlich",
                                  'none' => "Keine Prüfung"],
                                  'written', ['class' => 'form-control',
                                  'id' => 'emode',
                                  'onChange' => 'adjustDateFieldVisibility()']) }}
                            </div>
                        </div>

                        <!-- Course exam mode TODO dropdown button-->
                        <div class="form-group" id="date-group">
                            <label for="edate" class="col-sm-3 control-label">Prüfungsdatum</label>

                            <div class="col-sm-3">
                               <input type="date" name="edate" id="edate" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <label class="checkbox-inline"><input type="checkbox" id="no-date" value="" onclick="adjustDateFieldValue()">Datum unbekannt</label>
                        </div>

                        <!-- Course exam grade TODO validation-->
                        <div class="form-group">
                            <label for="egrade" class="col-sm-3 control-label">Note</label>

                            <div class="col-sm-3">
                              <select class="form-control" name="egrade" id="egrade">
                                <option value="">-</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i < 4)
                                        <option value="{{$i}}.0">{{$i}},0</option>
                                        <option value="{{$i}}.3">{{$i}},3</option>
                                        <option value="{{$i}}.7">{{$i}},7</option>
                                    @else
                                        <option value="{{$i}}.0">{{$i}},0</option>
                                    @endif
                                @endfor
                              </select>
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Kurs hinzufügen
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End panel for adding courses-->
        </div><!-- End main column -->
    </div><!-- End container -->

    <!-- JavaScript code for index section-->
    <script>
      $( document ).ready(function(){
        $('.course-icn').each(function(index, obj) {
            var currentStatus = $('.status > div').get(index).innerHTML;
            var color;
            if (currentStatus === "Erledigt") {
                color = "#5cb85c";
            } else if (currentStatus === "In Arbeit") {
                color = "#d9534f";
            } else {
                color = "black";
            }
            console.log(obj);
            $( this ).css("color", color);
        });
      });

      function adjustDateFieldVisibility() {
        if ($('#emode option:selected').val() === "none") {
            $('#date-group').hide();
            $('#edate').val("");
            $('#egrade').prop( "disabled", true);
            $('#egrade').val("");
        } else {
            $('#date-group').show();
            $('#edate').val("<?php echo date('Y-m-d'); ?>");
            $('#egrade').prop( "disabled", false);
        }
      }

      function adjustDateFieldValue() {
        if ($('#no-date').is(':checked')) {
            $('#egrade').prop( "disabled", true);
            $('#egrade').val("");
            $('#edate').prop( "disabled", true);
            $('#edate').val("");
        } else {
            $('#egrade').prop( "disabled", false);
            $('#edate').prop( "disabled", false);
            $('#edate').val("<?php echo date('Y-m-d'); ?>");
        }
      }
    </script>
@endsection
