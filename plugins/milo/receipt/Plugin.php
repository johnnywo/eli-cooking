<?php namespace Milo\Receipt;

use Backend;
use Milo\Receipt\Models\Receipt;
use System\Classes\PluginBase;

/**
 * Receipt Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Receipt',
            'description' => 'No description provided yet...',
            'author'      => 'Milo',
            'icon'        => 'icon-cutlery'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
	    \Event::listen('offline.sitesearch.query', function ($query) {

		    // Search your plugin's contents
		    $items = Receipt::where('name', 'like', "%${query}%")
                            ->orWhere('preparation', 'like', "%${query}%")
                            ->get();

		    // Now build a results array
		    $results = $items->map(function ($item) use ($query) {

			    // If the query is found in the title, set a relevance of 2
			    $relevance = mb_stripos($item->name, $query) !== false ? 2 : 1;

			    return [
				    'title'     => $item->name,
				    'text'      => $item->preparation,
				    'url'       => '/rezepte/' . $item->slug,
				    'thumb'     => $item->picture->first(), // Instance of System\Models\File
				    'relevance' => $relevance, // higher relevance results in a higher
				    // position in the results listing
				    // 'meta' => 'data',       // optional, any other information you want
				    // to associate with this result
			    ];
		    });

		    return [
			    'provider' => 'Rezepte', // The badge to display for this result
			    'results'  => $results,
		    ];
	    });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Milo\Receipt\Components\Receipts' => 'receipts',
            'Milo\Receipt\Components\Categories' => 'categories',
            'Milo\Receipt\Components\Comments' => 'comments',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'milo.receipt.some_permission' => [
                'tab' => 'Receipt',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {

        return [
            'receipt' => [
                'label'       => 'Receipt',
                'url'         => Backend::url('milo/receipt/receipts'),
                'icon'        => 'icon-cutlery',
                'permissions' => ['milo.receipt.*'],
                'order'       => 500,

                'sideMenu' => [
	                'categories' => [
		                'label'       => 'Categories',
		                'url'         => Backend::url('milo/receipt/categories'),
		                'icon'        => 'icon-tags',
		                'permissions' => ['milo.receipt.*'],
	                ]
                ]
            ],
        ];
    }
}
