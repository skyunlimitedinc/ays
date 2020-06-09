<?php
/**
 * Created by PhpStorm.
 * User: apache
 * Date: 3/8/18
 * Time: 4:40 PM
 */

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['partials/navbar', 'clipart'],
            'App\Http\ViewComposers\NavigationComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
