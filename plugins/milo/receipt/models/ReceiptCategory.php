<?php namespace Milo\Receipt\Models;

use Model;

/**
 * Receipt_Category Model
 */
class ReceiptCategory extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'milo_receipt_receipt__categories';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

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
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
