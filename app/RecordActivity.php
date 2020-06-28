<?php


namespace App;


use Illuminate\Support\Arr;

trait RecordActivity
{
    public $oldAttributes = [];

//    public static function bootRecordActivity()
//    {
//        static::updating(function ($model){
//            $model->oldAttributes = $model->getOriginal();
//        });
//    }

    public function recordActivity($description)
    {
        $this->activity()->create([
            'user_id' => ($this->project ?? $this)->owner->id,
            'description' => $description,
            'changes' => $this->activityChanges(),
            'project_id' => ($this->project_id ?? $this->id)
        ]);
    }

    protected function activityChanges()
    {
        if ($this->wasChanged()) {
            return [
                'before' => Arr::except(array_diff($this->oldAttributes, $this->getAttributes()) , 'updated_at') ,
                'after' => Arr::except($this->getChanges() , 'updated_at')
            ];
        }
    }

    public function activity()
    {
        return $this->morphMany(Activity::class , 'subject')->latest();
    }
}
