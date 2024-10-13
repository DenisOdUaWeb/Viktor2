<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    //protected $fillable = [
    //    'name',
    //    'email',
    //    'active',
    //    'company_id',
    //    'image',
    //];
    //or nothing is guarded  beter cause you can forget and 
    //long time seqrch why its not recording to the DB
    protected $guarded = [];



    use HasFactory;


        // THIS IS FOR FRENDLY URLs TESTING 
    public function path()
    {
        return url("/customers/{$this->id}-" . Str::slug($this->name));
    }

    protected $attributes = [  // default value for empty Model instance which we made in controller: $customer = new Customer();
        'active' => 1,
    ];

    public function getActiveAttribute($attribute)
    {
        //return [
        //    0 => 'Inactive',
        //    1 => 'Active',
        //][$attribute];
        //refactoring
        return $this->activeOptions()[$attribute];
    }


    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * Summary of company
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function activeOptions()
    {
        return [
            1 => 'Active',
            0 => 'Inactive',
            2 => 'In Progress',
        ];
    }

}