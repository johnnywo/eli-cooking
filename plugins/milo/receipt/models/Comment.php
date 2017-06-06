<?php namespace Milo\Receipt\Models;

use Model;

/**
 * Comment Model
 */
class Comment extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'milo_receipt_comments';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['receipt_id', 'comment', 'your_name', 'email'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
    	'receipt' => ['Milo\Receipt\Models\Receipt', 'table' => 'milo_receipt_receipts']
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
