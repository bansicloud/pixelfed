<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $dates = ['admin_seen'];

    public function url()
    {
        return url('/i/admin/reports/show/'.$this->id);
    }

    public function reporter()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function reported()
    {
        $class = $this->object_type;
        switch ($class) {
        case 'App\Status':
         $column = 'id';
          break;

        default:
         $column = 'id';
          break;
      }

        return (new $class())->where($column, $this->object_id)->firstOrFail();
    }

    public function reportedUser()
    {
        return $this->belongsTo(Profile::class, 'reported_profile_id', 'id');
    }
}
