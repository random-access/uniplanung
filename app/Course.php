<?php

namespace App;

use App\Traits\NullableFields;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    use NullableFields;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_no', 'course_name', 'status', 'exam_mode', 'exam_date', 'exam_grade',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'int',
        // 'exam_grade' => 'float',
        // 'exam_date' => 'date',
    ];

    /**
     * Get the user that owns the course.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
    * Transform status
    */
    public function getStatusAttribute($value) {
        switch ($value) {
          case 'planned':
              return "Geplant";
          case 'active':
              return "In Arbeit";
          case 'completed':
              return "Erledigt";
          default:
              return "";
        }
    }

    /**
    * Transform exam mode
    */
    public function getExammodeAttribute($value) {
        switch ($value) {
          case 'written':
              return "Schriftlich";
          case 'verbal':
              return "Mündlich";
          case 'none':
              return "Keine Prüfung";
          default:
              return "";
        }
    }

    public function setExamdateAttribute($value) {
        $this->attributes['exam_date'] = $this->nullIfEmpty($value);
    }

    public function getExamdateAttribute($value) {
      if ($value == null) {
        return "-";
      }
      $time = strtotime($value);
      return date('d.m.Y',$time);
    }

    public function setExamgradeAttribute($value) {
        $this->attributes['exam_grade'] = $this->nullIfEmpty($value);
    }

    /**
    * Add decimals to exam grades
    */
    public function getExamgradeAttribute($value) {
       return $value == null ? "-" : number_format((float)$value, 1, '.', '');
    }
}

