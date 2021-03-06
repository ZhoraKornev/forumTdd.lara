<?php


namespace App;


trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        if (auth()->guest()) return;
        foreach (self::getActivitiesToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }

        static::deleting(function ($model) {
            /** @var Thread $model */
            $model->activity()->delete();
        });

    }

    protected static function getActivitiesToRecord()
    {
        return ['created'];
    }

    /**
     * @param $event
     * @throws \ReflectionException
     */
    protected function recordActivity($event)
    {
        $this->activity()->create(
            ['user_id' => auth()->id(),
                'type' => $this->getActivityType('created')
            ]
        );
    }

    /**
     * @return mixed
     */
    protected function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    /**
     * @param $event
     * @return string
     * @throws \ReflectionException
     */
    protected function getActivityType($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";
    }
}
