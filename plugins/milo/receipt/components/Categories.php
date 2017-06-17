<?php namespace Milo\Receipt\Components;

use Cms\Classes\ComponentBase;
use Milo\Receipt\Models\Category;

class Categories extends ComponentBase
{

	public function componentDetails()
	{
		return [
			'name'        => 'Categories Component',
			'description' => 'No description provided yet...'
		];
	}

	public function defineProperties()
	{
		return [];
	}

	public function index()
	{
		$slug = $this->param('slug');

		/*$category = DB::select('SELECT R.*
								FROM `milo_receipt_receipts`R, `milo_receipt_receipt__categories`RC, `milo_receipt_categories`C
								WHERE C.`slug` = :slug
								AND R.id = RC.`receipt_id`
								AND C.id = RC.`category_id`
								ORDER BY R.`created_at` DESC', ['slug' => $slug]);*/

		/* ->get() gibt eine Collection zurück und somit ist die Relationship Methode ->receipt() nicht aufrufbar
			->first() gibt ein Model zurück und somit ist ->receipt() aufrufbar */

		$category = Category::where('slug', $slug)->first();

		$receipts = $category->receipt()
		                     ->orderBy('created_at', 'desc')
		                     ->paginate(12);

		return $receipts;
	}
}
