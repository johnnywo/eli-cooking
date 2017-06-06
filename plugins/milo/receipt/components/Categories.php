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
		$category = new Category;
		$category = $category->where('slug', $slug)
		                   ->with('receipt')
		                  ->get();
		return $category;
	}
}
