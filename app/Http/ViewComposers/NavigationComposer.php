<?php
/**
 * Created by PhpStorm.
 * User: apache
 * Date: 3/8/18
 * Time: 4:55 PM
 */

namespace App\Http\ViewComposers;

use App\ProductLine;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class NavigationComposer
{
    /**
     * Boolean for whether or not to include inactive items.
     *
     * @var bool
     */
    protected $includeInactive;

    /**
     * Array used for getting active & inactive items from db.
     *
     * @var array
     */
    protected $activeArray;

    /**
     * The menu items from the database.
     *
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    protected $menuItems;

    /**
     * NavigationComposer constructor.
     * Create a new navigation composer.
     *
     * @return void
     */
    public function __construct()
    {
        // Set whether or not to include inactive items in the navbar.
        $this->includeInactive =
            request()
                ->route()
                ->parameter('includeInactive') === 'include_inactive';
        $this->activeArray = [$this->includeInactive ? 0 : 1, 1];

        // Get the menu items from the database.
        $this->menuItems = ProductLine::with([
            'productSubcategory.productCategory.menuCategory',
            'printMethod'
        ])->get();

        // Get clipart path.
        $this->clipartPath = config('global.clipartPath');
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $filteredMenuItems = $this->filterResults($this->activeArray);
        $groupedMenu = $this->sortAndGroup($filteredMenuItems);
        $productsHtml = $this->prepareProductMenu($groupedMenu);
        $clipartHtml = $this->prepareClipartMenu();

        $view->with(compact('productsHtml', 'clipartHtml'));
    }

    /**
     * Take the ProductLine model and its related models,
     * filtering them to only keep the subcategory/method combo
     * that has the highest PrintMethod priority.
     *
     * @param $activeArray
     * @return \Illuminate\Support\Collection|static
     */
    private function filterResults($activeArray)
    {
        // Only keep "active" items if variable is set to do so (by default, it is).
        // Also only keep items with the
        // Filter to only the highest-priority Print Method per item.
        /*                $min = $subcatActive->min('printMethod.priority');
                $prioritized = $subcatActive->filter(function ($productLine) use ($min) {
                    return $productLine->printMethod->priority === $min;
                });
                return $prioritized;*/

        return $this->menuItems->groupBy('product_subcategory_id')
            ->map(function (Collection $productLineGroup) use ($activeArray) {
                // Filter to only the Product Lines that are active.
                $productLineActive = $productLineGroup->filter(function (
                    $productLine
                ) use ($activeArray) {
                    return in_array($productLine->active, $activeArray);
                });

                // Filter to only the Print Methods that are active.
                $printMethodActive = $productLineActive->filter(function (
                    $productLine
                ) use ($activeArray) {
                    return in_array(
                        $productLine->printMethod->active,
                        $activeArray
                    );
                });

                // Filter to only the Menu Categories that are active.
                $menuActive = $printMethodActive->filter(function (
                    $productLine
                ) use ($activeArray) {
                    return in_array(
                        $productLine->productSubcategory->productCategory
                            ->menuCategory->active,
                        $activeArray
                    );
                });

                // Filter to only the Categories that are active.
                $catActive = $menuActive->filter(function ($productLine) use (
                    $activeArray
                ) {
                    return in_array(
                        $productLine->productSubcategory->productCategory
                            ->active,
                        $activeArray
                    );
                });

                // Filter to only the Subcategories that are active.
                $subcatActive = $catActive->filter(function ($productLine) use (
                    $activeArray
                ) {
                    return in_array(
                        $productLine->productSubcategory->active,
                        $activeArray
                    );
                });

                return $subcatActive;
            })
            ->flatten(1);
    }

    /**
     * Sort the remaining items by their various priorities (MenuCategory,
     * ProductCategory, and ProductSubcategory), then group them by MenuCategory.
     *
     * @param $menuItems Collection
     * @return mixed
     */
    private function sortAndGroup($menuItems)
    {
        // Sort and group the items, ready for building the HTML navbar.
        return // Sort the items by all three criteria.
        $menuItems
            ->sortBy(function ($item) {
                $sortNum =
                    $item->productSubcategory->productCategory->menuCategory
                        ->priority * 1000;
                $sortNum +=
                    $item->productSubcategory->productCategory->priority * 100;
                $sortNum += $item->productSubcategory->priority * 10;
                $sortNum += $item->printMethod->priority;
                return $sortNum;
            })
            ->groupBy([
                'productSubcategory.productCategory.menu_category_id',
                'product_subcategory_id'
            ]);
    }

    /**
     * Take a grouped list of MenuCategories and all of the ProductCategories
     * and ProductSubcategories they contain and build up navbar entries from them.
     *
     * @param $menuItems
     * @return string
     */
    private function prepareProductMenu($menuItems)
    {
        // Prepare the HTML navbar.
        $html = '';
        $previousCategory = null;
        /** @var Collection $mainMenuGroup */
        foreach ($menuItems as $mainMenuGroup) {
            $html .= "<li><span>";
            // Two "first()"s here: The first one is for Subcategory, the second is for Print Method.
            // It's okay because we're just trying to get the Menu Category anyway.
            $html .= $mainMenuGroup->first()->first()->productSubcategory
                ->productCategory->menuCategory->long_name;
            $html .= "</span>" . PHP_EOL;
            $html .=
                "<div class='flexinav_ddown flexinav_ddown_fly_out flexinav_ddown_240'>" .
                PHP_EOL;
            $html .= "<ul class='dropdown_flyout'>" . PHP_EOL;
            foreach ($mainMenuGroup as $productLines) {
                // Just need the "first()" one, because all we need here is the Product Category for constructing the link URL.
                $productCategoryId = $productLines->first()->productSubcategory
                    ->product_category_id;
                // Likewise, just need the Subcategory's "short_name" for constructing the link URL.
                $productSubcategoryShortName = $productLines->first()
                    ->productSubcategory->short_name;
                // Finally, just getting the Print Method ID for the link URL.
                $printMethodId = $productLines->first()->print_method_id;
                // If the first Product Line is "unprinted", then don't make a dropdown for it.
                $unprinted =
                    $productLines->first()->print_method_id === 'unprinted';
                $parentClass = $unprinted ? '' : 'dropdown_parent';
                $route = route('product', [$productCategoryId, $productSubcategoryShortName, $printMethodId]);
                $html .= "<li class='{$parentClass}'>";
                $html .= "<a href='{$route}' target='_self'>";
                $html .= "<span>{$productLines->first()
                    ->productSubcategory->long_name}</span>";
                $html .= "</a>" . PHP_EOL;
                if (!$unprinted) {
                    $html .=
                        "<ul class='dropdown_flyout_level'>" .
                        PHP_EOL;
                    foreach ($productLines as $productLine) {
                        $printMethodId = $productLine->print_method_id;
                        $route = route('product', [$productCategoryId, $productSubcategoryShortName, $printMethodId]);
                        $printMethodLongName =
                            $productLine->printMethod->long_name;
                        $html .= "<li class='dropdown_parent'>";
                        $html .= "<a href='{$route}' target='_self' title='{$printMethodLongName}'>";
                        $html .=
                            "<span>{$printMethodLongName}</span>" .
                            PHP_EOL;
                        $html .= "</a>";

                        // For the Print Method's long_description.
                        $html .=
                            "<ul class='dropdown_flyout_level'>" .
                            PHP_EOL;
                        $html .= "<li>";
                        $html .= $productLine->printMethod->long_description;
                        $html .= "</li>";
                        $html .= "</ul>" . PHP_EOL; // Ends the Print Method's long_description.

                        $html .= "</li>" . PHP_EOL; // Ends Print Method.
                    }
                    $html .= "</ul>" . PHP_EOL; // Ends Print Method list.
                } // Ends the list for Print Methods (only runs if the first Print Method is "unprinted".
                $html .= "</li>" . PHP_EOL; // Ends Product Subcategory.
            }
            $html .= "</ul>" . PHP_EOL; // Ends Product Subcategory list.
            $html .= "</div>" . PHP_EOL; // Ends dropdown for Menu Category.
            $html .= "</li>" . PHP_EOL; // Ends Menu Category.
        }

        return $html;
    }

    /**
     * Scan through the `images/clipart` folder and build up
     * Bootstrap 4-compatible navbar entries from them.
     *
     * @return string
     */
    private function prepareClipartMenu()
    {
        $clipartFolders = glob(config('global.clipartPath') . '*', GLOB_ONLYDIR);
        $html = '';

        if (count($clipartFolders) > 0) {
            $html .= "<li><span>Clip-Art</span>" . PHP_EOL;
            $html .=
                "   <div class='flexinav_ddown flexinav_ddown_fly_out flexinav_ddown_240'>" .
                PHP_EOL;
            $html .= "      <ul class='dropdown_flyout'>" . PHP_EOL;
            foreach ($clipartFolders as $dirtyName) {
                $explodedName = explode('/', $dirtyName);
                $folderName = array_pop($explodedName);
                $withSpaces = str_replace('_', ' ', $folderName);
                $cappedName = ucwords($withSpaces);
                $route = route('clipart', $folderName);
                $html .= "<li><a href='{$route}' target='_self' title='{$cappedName}'>";
                $html .= $cappedName;
                $html .= "</a></li>" . PHP_EOL;
            }
            $html .= "      </ul>" . PHP_EOL;
            $html .= "   </div>" . PHP_EOL;
            $html .= "</li>" . PHP_EOL;
        }

        return $html;
    }
}
