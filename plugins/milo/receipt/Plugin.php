<?php namespace Milo\Receipt;

use Backend;
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
