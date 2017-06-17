<?php namespace Milo\Receipt\Models;

use Model;

/**
 * Category Model
 */
class Category extends Model
{
	use \October\Rain\Database\Traits\Sluggable;
    /**
     * @var string The database table used by the model.
     */
    public $table = 'milo_receipt_categories';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

	protected $slugs = ['slug' => 'name'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
	    'receipt' => ['Milo\Receipt\Models\Receipt', 'table' => 'milo_receipt_receipt__categories']
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];


}
