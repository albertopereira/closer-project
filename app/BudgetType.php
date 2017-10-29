<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class BudgetType extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'budget_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['budget_name', 'entity_id', 'data'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Fields to treat as carbon instances (Carbon\Carbon)
     *
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * Mutator: changes the type of the attribute published_at.
     * $entity->published_at = [something] uses automatically this method
     *
     * @param $date
     */
    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::now();
    }

    /**
     * Mutator: changes the type of the attribute published_at.
     * $entity->published_at = [something] uses automatically this method
     *
     * @param $date
     */
    public function getPublishedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d-m-Y H:i:s');
    }

    /**
     * Mutator: changes the type of the attribute published_at.
     * $entity->published_at = [something] uses automatically this method
     *
     * @param $date
     */
    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d-m-Y H:i:s');
    }

    /**
     * Mutator: changes the type of the attribute published_at.
     * $entity->published_at = [something] uses automatically this method
     *
     * @param $date
     */
    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d-m-Y H:i:s');
    }    

   /**
     * Return entity owner of budget type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function entity()
    {
        return $this->belongsTo('App\Entity');
    }
}
