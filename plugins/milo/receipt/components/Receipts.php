<?php namespace Milo\Receipt\Components;

use Cms\Classes\ComponentBase;
use Milo\Receipt\Models\Receipt;

class Receipts extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Receipts Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

	public function index()
	{
		$receipt = Receipt::with('category')
		                  ->orderBy('created_at', 'desc')
		                  ->paginate(12);

		/*$receipt->chunk(5);*/
		/*$receipt->toArray();*/
		return $receipt;
    }

	public function show()
	{
		$slug = $this->param('slug');

		$receipt = new Receipt;

		$receipt = $receipt->where('slug', $slug);

		$receipt = $receipt->first();

		return $receipt;
    }
}
