<?php

namespace App\Http\Controllers;

use App\ClipartSubcategory;
use Cache;
use DateInterval;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ClipartController extends Controller
{
    /**
     * Show the Clipart view for a given category.
     *
     * @param $subcategory
     * @return Factory|View
     */
    public function index($subcategory)
    {
        // Get the Model for the given subcategory id.
        $clipartSubcategory = Cache::remember(
            'clipart:subcategory',
            new DateInterval('P1M'),
            function () use ($subcategory) {
                ClipartSubcategory::with('clipartCategory')->find($subcategory);
            }
        );

        // Get all of the images in the clipart folder for the subcategory.
        $allFiles = scandir(config('global.clipartPath') . $subcategory);
        $images = preg_grep('/^[0-9A-Za-z].*\.(svg|png|jpg)$/', $allFiles);

        return view('clipart', compact('clipartSubcategory', 'images'));
    }
}
