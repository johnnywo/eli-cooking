<?php namespace Milo\Receipt\Models;

use Model;

/**
 * Receipt Model
 */
class Receipt extends Model
{
	use \October\Rain\Database\Traits\Sluggable;
    /**
     * @var string The database table used by the model.
     */
    public $table = 'milo_receipt_receipts';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    protected $slugs = ['slug' => 'name'];

	public function beforeSave()
	{
		// Autogenerate name
		if (empty($this->name)) {
			$this->name = $this->make . ' ' . $this->model . ' ' . $this->variant;
		}

		// Force creation of slug
		if (empty($this->slug)) {
			unset($this->slug);
			$this->setSluggedValue('slug', 'name');
		}
	}

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

	protected $jsonable = ['incredients'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
    	'comment' => ['Milo\Receipt\Models\Comment', 'table' => 'milo_receipt_comments']
    ];
    public $belongsTo = [];
    public $belongsToMany = [
	    'category' => ['Milo\Receipt\Models\Category', 'table' => 'milo_receipt_receipt__categories']
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
    	'picture' => 'System\Models\File'
    ];
    public $attachMany = [];
}
