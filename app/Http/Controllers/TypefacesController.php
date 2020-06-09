<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypefacesController extends Controller
{
    public function index()
    {
        // Get all of the images of typefaces in the `fonts` folder.
        $allFiles = scandir(config('global.typefacesPath'));
        $typefaces = preg_grep('/^[0-9A-Za-z].*\.(svg|png|jpg)$/', $allFiles);

        return view('typefaces', compact('typefaces'));
    }
}
