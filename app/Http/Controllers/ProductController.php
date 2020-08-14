<?php
namespace App\Http\Controllers;

use App\AcsPrice;
use App\ColorType;
use App\ImprintType;
use App\Product;
use App\ProductFeature;
use App\ProductLine;
use App\ProductNote;
use Illuminate\Database\Eloquent\Collection;

class ProductController extends Controller
{
    /**
     * Show the Product view and populate it with a particular
     * Product Category and Product Subcategory combo.
     *
     * @param $category
     * @param $subcategory
     * @param $printMethod
     * @param string $includeInactive
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(
        $category,
        $subcategory,
        $printMethod,
        $includeInactive = ''
    ) {
        // Set whether or not to include inactive items.
        $activeArray = [$includeInactive === 'include_inactive' ? 0 : 1, 1];

        $allProductLines = ProductLine::with([
            'productSubcategory',
            'printMethod'
        ])->get();

        // Filter to only the _single_ Product Line we want.
        $productLine = $allProductLines
            ->filter(function ($productLine) use (
                $category,
                $subcategory,
                $printMethod
            ) {
                return $productLine->productSubcategory->short_name ===
                    $subcategory &&
                    $productLine->productSubcategory->product_category_id ===
                        $category &&
                    $productLine->print_method_id === $printMethod;
            })
            ->first();

        // Get and construct the Features & Options list for this Product Line.
        $productFeatures = $this->getFeatures($productLine->id, $activeArray);

        // Get and construct other notes for this Product Line.
        $productNotes = $this->getTextNotes($productLine, $activeArray);

        // Get the splash image for this Product Line.
        $productLineText = "{$category}-{$subcategory}-{$printMethod}";

        // Get and construct the product cards for this Product Line.
        $productCards = $this->getProducts($productLine, $activeArray);

        // Get and construct the product color swatches area.
        $swatchesProduct = $this->getSwatchesProduct(
            $productLine,
            $activeArray
        );

        // Get and construct the imprint color swatches area.
        $swatchesImprintColor = $this->getSwatchesImprintColor(
            $productLine,
            $activeArray
        );

        // Get and construct the imprint types swatches area.
        $swatchesImprintType = $this->getSwatchesImprintType(
            $productLine,
            $activeArray
        );

        return view(
            'product',
            compact(
                'productLine',
                'productFeatures',
                'productNotes',
                'productLineText',
                'productCards',
                'swatchesProduct',
                'swatchesImprintColor',
                'swatchesImprintType'
            )
        );
    }

    /**
     * Get all of the Features & Options for a given Product Line.
     *
     * @param $productLineId
     * @param $activeArray
     * @return string
     */
    private function getFeatures($productLineId, $activeArray)
    {
        // Get the Product Features associated with the given Product Line ID.
        $allProductFeatures = ProductFeature::with([
            'productFeaturesPivot',
            'productLines'
        ])
            ->orderBy('id', 'desc')
            ->get();

        // Narrow the results to only the Product Features we want for the given Product Line ID.
        $narrowedProductFeatures = $allProductFeatures
            ->reject(function ($productFeature) use ($productLineId) {
                $productLines = $productFeature->productLines->filter(function (
                    $productLine
                ) use ($productLineId) {
                    return $productLine->id == $productLineId;
                });
                return empty(sizeof($productLines));
            })
            ->filter(function ($productFeature) use ($activeArray) {
                return in_array($productFeature->active, $activeArray);
            });

        // Convert the model collection to a nested set of just the data we need,
        // before converting it to a JSON and sending it back.
        $productFeatures = Collection::make();
        $childIds = Collection::make();
        $narrowedProductFeatures->each(function (
            ProductFeature $featureItem
        ) use (&$narrowedProductFeatures, $productFeatures, &$childIds) {
            $tempFeature = collect(
                $featureItem->only(['id', 'active', 'feature'])
            );

            if (!$childIds->contains($tempFeature['id'])) {
                // If this `$featureItem` has _not_ been used in a previous iteration as a child.
                $childFeatures = $narrowedProductFeatures->filter(function (
                    $feature
                ) use ($tempFeature) {
                    if ($feature->productFeaturesPivot->isNotEmpty()) {
                        $match = $feature->productFeaturesPivot->firstWhere(
                            'parent_id',
                            $tempFeature['id']
                        );
                        return !is_null($match);
                    }
                    return false;
                });
                $filteredChildren = $childFeatures->map(function (
                    ProductFeature $childFeature
                ) {
                    return collect(
                        $childFeature->only(['id', 'active', 'feature'])
                    );
                });

                if ($filteredChildren->isNotEmpty()) {
                    $childIds = $filteredChildren->pluck('id'); //***Maybe
                    // just ADD instead of ASSIGN. ** DOESN'T WORK.
                    $tempFeature['children'] = collect($filteredChildren);
                }
                $productFeatures->push($tempFeature);
            }
        });

        return $productFeatures->count() > 0
            ? $this->formatFeatures($productFeatures)
            : null;
    }

    /**
     * Format the Features & Options into an HTML string
     * with <ul> structure.
     *
     * @param $features Collection
     * @return string
     */
    private function formatFeatures($features)
    {
        $html = "";

        if ($features->count() > 0) {
            $html .= "<ul>" . PHP_EOL;
            foreach ($features as $feature) {
                $html .= "<li>{$feature['feature']}</li>" . PHP_EOL;
                if ($feature->has('children')) {
                    $html .= $this->formatFeatures($feature['children']);
                }
            }
            $html .= "</ul>" . PHP_EOL;
        }

        return $html;
    }

    /**
     * Get all of the Text Notes for a given Product Line.
     *
     * @param $productLine
     * @param $activeArray
     * @return string
     */
    private function getTextNotes($productLine, $activeArray)
    {
        // Get the Notes associated with the given Product Line ID.
        $expandedProductLine = $productLine
            ->load([
                'productNotes' => function ($query) use ($activeArray) {
                    $query
                        ->whereIn('active', $activeArray)
                        ->orderBy('priority', 'asc');
                }
            ])
            ->load([
                'imprintTypes' => function ($query) use ($activeArray) {
                    $query
                        ->whereIn('active', $activeArray)
                        ->orderBy('priority', 'asc');
                }
            ]);

        $numNotes =
            $expandedProductLine->productNotes->count() +
            $expandedProductLine->imprintTypes->count();
        return $numNotes > 0
            ? $this->formatTextNotes($expandedProductLine)
            : null;
    }

    /**
     * Format the text notes into an HTML string
     * with a <p> at the top, then a <dl> structure below.
     *
     * @param $productLine
     * @param $notes
     * @return string
     */
    private function formatTextNotes($productLine)
    {
        $html = "";

        $color_item = preg_match(
            "/color/i",
            $productLine->productSubcategory->short_name
        );
        $napkin_item = preg_match(
            "/napkin/i",
            $productLine->productSubcategory->product_category_id
        );

        // Begin building the string that will be returned.
        // This first section is for the paragraph text.
        $productColor = "";
        $imprintMethod = "";
        if ($color_item) {
            $productColor =
                ucfirst($productLine->productSubcategory->product_category_id) .
                " color, ";
        }
        if ($napkin_item && $productLine->print_method_id === "tradition") {
            $imprintMethod = "Imprint method, ";
        }

        $html .= "<p>";
        $html .= "<span class='is-accented'>Be sure to specify:</span> ";
        $html .= $productColor;
        $html .= $imprintMethod;
        $html .=
            "Imprint placement, and ink color (chosen from the Standard Ink Color list below or provided as a Pantone&reg; ink number).";
        $html .= "</p>" . PHP_EOL;

        // Now add the notes we retrieved earlier.
        $html .= "<dl>" . PHP_EOL;
        foreach ($productLine->productNotes as $note) {
            $title = "";
            if (!empty($note->title)) {
                $title = "<dt>{$note->title}</dt>" . PHP_EOL;
            }
            $html .= $title;
            $html .= "<dd>{$note->body}</dd>" . PHP_EOL;
        }
        foreach ($productLine->imprintTypes as $imprintType) {
            // Only show an Imprint Type if the `body` field is not null.
            if (!empty($imprintType->body)) {
                $title = $body = "";
                if (!empty($imprintType->title)) {
                    $title = "<dt>{$imprintType->title} -</dt>" . PHP_EOL;
                }
                $body .= "<dd>{$imprintType->body}</dd>" . PHP_EOL;
                $html .= $title . $body;
            }
        }
        $html .= "</dl>" . PHP_EOL;

        return $html;
    }

    /**
     * Prepare the HTML for the thumbnail images for each Product.
     *
     * @param $productLine
     * @param $product
     * @param $decodedProductName
     * @return string
     */
    private function getThumbnails($productLine, $product, $decodedProductName)
    {
        // Preface the main thumbnail with the "Sample" ribbon.
        $result =
            "<div class='thumbnail__ribbon-area'><div class='thumbnail__ribbon'>Sample</div></div>" .
            PHP_EOL;

        $folder = "storage/images/products-assets/{$productLine->productSubcategory->productCategory->id}/{$productLine->productSubcategory->short_name}/";
        //        $html_folder = substr($folder, 3);
        $productList = [$decodedProductName];

        // If this Product is one that has multiple colors, populate $productList with all of the Product Names, but have "(COLOR)" replaced with the actual Color name, formatted properly.
        if (
            stripos($decodedProductName, "(COLOR)") !== false &&
            stripos($decodedProductName, "TIP") !== 0 // Exclude 'TIP - (COLOR)' from this algorithm.
        ) {
            // Get all the colors available for this single Product.
            $productList = [];
            $productColors = $product->colors->all();
            foreach ($productColors as $productColor) {
                // Iterate through them, format them the same as the thumbnail filenames, then put them in place of the "(COLOR)" text.
                // This is all to prepare for the thumbnail filenames.
                $condensedColorName = str_replace(
                    ['/', ' '],
                    ['', ''],
                    $productColor->short_name
                );
                $upperCaseColorName = strtoupper($condensedColorName);
                $imageName = str_replace(
                    '(COLOR)',
                    $upperCaseColorName,
                    $decodedProductName
                );
                $productList[] = $imageName;
            }
        }

        // Prepare the class and style for multi-colored Products.
        $rotatingImagesClass = "";
        $rotatingImagesStyle = "";
        if (count($productList) > 1) {
            $rotatingImagesClass = "rotating-item";
            $rotatingImagesStyle = "style='display: none;'";
        }

        // Set the correct class for Products that have a Print Method.
        $sampleExists =
            preg_match("/^[DTH]-/", $decodedProductName) > 0 ? true : false;
        $blankClass = '';
        if ($sampleExists) {
            $blankClass = 'thumbnail__image--blank';
        }

        // Build up the HTML.
        foreach ($productList as $image) {
            // Prepare the blank and sample thumbnails.
            $blankImage = asset($folder . $image . '-blank_thumb.png');
            $sampleImage = asset($folder . $image . '-sample_thumb.png');

            $result .=
                "<div class='{$rotatingImagesClass}' {$rotatingImagesStyle}>" .
                PHP_EOL;
            $result .=
                "<img src='{$blankImage}' class='rounded thumbnail__image {$blankClass}' data-rjs='3' alt='{$image}'>" .
                PHP_EOL;
            if ($sampleExists) {
                $result .=
                    "<img src='{$sampleImage}' class='rounded thumbnail__image thumbnail__image--sample' data-rjs='3' style='display: none;' alt='{$image}'>" .
                    PHP_EOL;
            }
            $result .= "</div>" . PHP_EOL;
        }

        return $result;
    }

    /**
     * Get all of the Products for a given Product Line.
     *
     * @param $productLine
     * @param array $activeArray
     * @return string
     */
    private function getProducts($productLine, array $activeArray)
    {
        // Set a couple of variables we'll need for Hi-Speed items.
        $decimals = 0;
        $perThousand = "";
        if (
            $productLine->productSubcategory->product_category_id ===
                "napkin" &&
            $productLine->print_method_id === "hispeed"
        ) {
            $decimals = 2;
            $perThousand = "M";
        }

        // Get the Products associated with the given Product Line ID.
        $products = Product::whereHas('printMethods', function ($query) use (
            $productLine
        ) {
            $query->where('print_method_id', $productLine->print_method_id);
        })
            ->where(
                'product_subcategory_id',
                $productLine->productSubcategory->id
            )
            ->whereIn('active', $activeArray)
            ->orderBy('priority', 'asc')
            ->get();

        // Get all of the Prices along with their associated ProductLineQuantityBreaks, ProductLines, QuantityBreaks, and Products.
        $allPrices = AcsPrice::with([
            'productLineQuantityBreak.productLine',
            'productLineQuantityBreak.quantityBreak',
            'productLineQuantityBreak.acsCharges.chargeType',
            'productLineQuantityBreak.acsPrices',
            'product'
        ])->get();
        // Filter that massive list down to only Prices whose ProductLineQuantityBreaks are active.
        $filteredPLQBs = $allPrices->filter(function ($value) use (
            $activeArray
        ) {
            return in_array(
                $value->productLineQuantityBreak->active,
                $activeArray
            );
        });
        // Then filter that result down to only Prices whose QuantityBreaks are active.
        $filteredQuantityBreaks = $filteredPLQBs->filter(function ($value) use (
            $activeArray
        ) {
            return in_array(
                $value->productLineQuantityBreak->quantityBreak->active,
                $activeArray
            );
        });
        // Then filter that result down to only Prices whose ProductLines are active.
        $filteredProductLines = $filteredQuantityBreaks->filter(function (
            $value
        ) use ($activeArray) {
            return in_array(
                $value->productLineQuantityBreak->productLine->active,
                $activeArray
            );
        });
        // Finally, filter that result down to only Prices whose Products are active.
        $filteredPrices = $filteredProductLines->filter(function ($value) use (
            $activeArray
        ) {
            return in_array($value->product->active, $activeArray);
        });

        // Begin laying out the HTML.
        $output = "";
        foreach ($products as $product) {
            $productName = $productLine->printMethod->prefix . $product->name;
            $decodedProductName = str_replace("/", "-", $productName);
            $decodedProductName = str_replace(' ', '', $decodedProductName);
            $singletonClass = $products->count() === 1 ? 'singleton' : '';
            $rotatorClass =
                stripos($decodedProductName, "(COLOR)") !== false
                    ? 'rotating-item-group'
                    : '';

            // Outer div for the entire card.
            $output .= "<div class='col-12 col-xl-6 py-2'>" . PHP_EOL;
            $output .=
                "<div class='{$singletonClass} item-info card text-center'>" .
                PHP_EOL;
            $output .= "<div class='row m-0'>" . PHP_EOL;

            // Div for the Product number (with Print Method), thumbnail, and description.
            // Usually on the left side of the card.
            $output .=
                "<div class='col-12 col-sm-5 item-info__num-thumb-desc card-header p-2'>" .
                PHP_EOL;

            // Product number with Print Method
            $output .=
                "<h5 class='item-info__number my-4'>{$productName}</h5>" .
                PHP_EOL;

            // Thumbnail
            $output .= "<div class='item-info__thumbnail rounded'>" . PHP_EOL;
            $output .=
                "<div class='thumbnail__overlay {$rotatorClass} rounded'>" .
                PHP_EOL;
            $output .= $this->getThumbnails(
                $productLine,
                $product,
                $decodedProductName
            );
            $output .= "</div>" . PHP_EOL; // div.item-thumb-overlay.overlay-rollover
            $output .= "</div>" . PHP_EOL; // div.item-thumb

            // Item Description
            $output .=
                "<h6 class='item-info__description my-4'>{$product->description}</h6>" .
                PHP_EOL;

            $output .= "</div>" . PHP_EOL; // div.item-info__num-thumb-desc.card-header

            // Get all of the Quantity Breaks and Prices for the given Product.
            $allQuantityBreaks = $filteredPrices->filter(function ($value) use (
                $product
            ) {
                return $value->product_id == $product->id;
            });
            // Narrow those Breaks down to only those whose PLQB's Product Line's print_method_id is the one we currently need.
            $quantityBreaks = $allQuantityBreaks
                ->filter(function ($value) use ($productLine) {
                    return $value->productLineQuantityBreak->productLine
                        ->print_method_id === $productLine->print_method_id;
                })
                ->sortBy('productLineQuantityBreak.quantity_break_id');

            $output .=
                "<div class='col-12 col-sm-7 item-info__pricing card-body p-2'>" .
                PHP_EOL;

            $output .=
                "<table class='item-info__price-table table table-sm table-striped table-bordered bg-light mb-2'>" .
                PHP_EOL;
            $output .= "<thead>" . PHP_EOL;
            $output .= "<tr>" . PHP_EOL;

            // Set up only those columns that have at least one bit of data for them.
            // Build up the first row, which are header cells (<th>).
            $chargeNames = []; // Hold the list of charges that have actual amounts.
            foreach (
                $productLine->productLineQuantityBreaks
                as $quantityBreak
            ) {
                foreach ($quantityBreak->acsCharges as $charge) {
                    if (!empty($charge->amount)) {
                        $chargeNames[] = $charge->charge_type_id;
                    }
                }
            }
            $chargeNames = array_unique($chargeNames);
            $numColumns = 2 + count($chargeNames);

            // Insert the first two columns, Quantity and Price.
            $output .=
                "<th class='price-table__th price-table__main-column price-table--columns{$numColumns} bg-accent text-light'>Quantity</th>" .
                PHP_EOL;
            $output .=
                "<th class='price-table__th price-table__main-column price-table--columns{$numColumns} bg-accent text-light'>Price</th>" .
                PHP_EOL;

            // Insert the rest of the columns (the additional Charges).
            // During the process, prepare the legend for the Charge symbols.
            $symbolLegend = "";
            foreach ($chargeNames as $chargeName) {
                // Convert the _name_ of the charge into a Charge object.
                $charge = $productLine->productLineQuantityBreaks
                    ->first()
                    ->acsCharges->where('charge_type_id', $chargeName)
                    ->first();
                $iconBaseName = "charge-{$charge->charge_type_id}";
                $chargeLongName = $charge->chargeType->long_name;
                $iconHeader = asset(
                    "storage/images/charges-icons/{$iconBaseName}-th.svg"
                );
                $iconPrint = asset(
                    "storage/images/charges-icons/{$iconBaseName}-print.svg"
                );
                $iconLegend = asset(
                    "storage/images/charges-icons/{$iconBaseName}-legend.svg"
                );

                $symbolLegend .= "<li>" . PHP_EOL;
                $symbolLegend .= "<div class='icon'>" . PHP_EOL;
                $symbolLegend .= "<img src='{$iconLegend}' class='svg-bullet icon-screen mx-1'>";
                $symbolLegend .= "<img src='{$iconPrint}' class='svg-bullet icon-print mx-1'>";
                $symbolLegend .= "{$chargeLongName}" . PHP_EOL;
                $symbolLegend .= "</div>" . PHP_EOL;
                $symbolLegend .= "</li>" . PHP_EOL;

                $output .=
                    "<th class='price-table__th price-table--columns{$numColumns} bg-accent text-light'>" .
                    PHP_EOL;
                $output .= "<div class='icon'>" . PHP_EOL;
                $output .=
                    "<img src='{$iconHeader}' class='svg icon-screen'>" .
                    PHP_EOL;
                $output .=
                    "<img src='{$iconPrint}' class='svg icon-print'>" . PHP_EOL;
                $output .= "</div>" . PHP_EOL;
                $output .= "</th>" . PHP_EOL;
            }

            $output .= "</tr>" . PHP_EOL;
            $output .= "</thead>" . PHP_EOL;
            $output .= "<tbody>" . PHP_EOL;

            // Display Quantity, Price, and any other charges for each quantity break.
            $everyThousand = false;
            foreach ($quantityBreaks as $index => $break) {
                // Keep only those charges that have amounts for them.
                $charges = $break->productLineQuantityBreak->acsCharges->sortBy('charge_type_id');
                //                $charges = $charges->reject(function ($charge) {
                //                    return empty($charge->amount);
                //                });

                // If there is a quantity break at 1,000 or above, enable the printing of the "Every Thousand" note.
                $quantity = $break->productLineQuantityBreak->quantity_break_id;
                if ($quantity >= 1000) {
                    $everyThousand = true;
                }

                $output .= "<tr>" . PHP_EOL;

                // Quantity cell
                $formattedQuantity = number_format(
                    $break->productLineQuantityBreak->quantity_break_id,
                    0
                );
                $output .=
                    "<td class='price-table__td price-table--quantity bg-accent text-light align-baseline'>{$formattedQuantity}</td>" .
                    PHP_EOL;

                // Price cell
                $formattedPrice =
                    $break->price === null
                        ? "N/A"
                        : "<span class='sup'>$</span>" .
                            number_format($break->price, $decimals) .
                            $perThousand;
                $output .=
                    "<td class='price-table__td text-dark align-baseline'>{$formattedPrice}</td>" .
                    PHP_EOL;

                // Charges cells
                foreach ($charges as $charge) {
                    if (in_array($charge->charge_type_id, $chargeNames)) {
                        $formattedCharge =
                            $charge->amount === null
                                ? "N/A"
                                : "<span class='sup'>$</span>" .
                                    number_format($charge->amount, $decimals) .
                                    $perThousand;
                        $output .=
                            "<td class='price-table__td price-table--charge text-dark align-baseline'>{$formattedCharge}</td>" .
                            PHP_EOL;
                    }
                }

                $output .= "</tr>" . PHP_EOL;
            }

            $output .= "</tbody>" . PHP_EOL;
            $output .= "</table>" . PHP_EOL;

            $output .= "<div class='item-info__notes text-left'>" . PHP_EOL;

            // Print the "Every Thousand" note.
            if ($everyThousand) {
                $output .=
                    "<p>Quantities 1,000 and above are priced per thousand.</p>" .
                    PHP_EOL;
            }

            if ($numColumns > 2) {
                $output .= "<ul class='list-unstyled'>" . PHP_EOL;
                $output .= $symbolLegend;
                $output .= "</ul>" . PHP_EOL;
            }

            $output .= "</div>" . PHP_EOL; // div.item-info__notes

            $output .= "</div>" . PHP_EOL; // div.item-info__pricing card-body

            $output .= "</div>" . PHP_EOL; // div.row

            $output .= "</div>" . PHP_EOL; // div.item-info

            $output .= "</div>" . PHP_EOL; // div.col-12.col-sm-6
        }

        return $output;
    }

    /**
     * Format a collection of categorized Colors into nice HTML.
     *
     * @param $swatchCategories
     * @param $nameField
     * @return null|string
     */
    private function formatSwatches($swatchCategories, $nameField)
    {
        $output = "";
        $numColors = 0;

        foreach ($swatchCategories as $category) {
            if ($category->colors->count() > 0) {
                $numColors += $category->colors->count();
                $output .= "<div class='d-flex flex-row'>" . PHP_EOL;
                $output .=
                    "<h6 class='swatches__header align-self-center mr-3 text-right flex-shrink-0' id='{$category->id}-title'>{$category->$nameField}:</h6>" .
                    PHP_EOL;
                $output .=
                    "<ul class='swatches__list list-unstyled d-flex flex-wrap'>" .
                    PHP_EOL;

                foreach ($category->colors as $color) {
                    $hexColor = "#" . $color->hex;
                    $gradient = "";
                    $background = "";
                    if ($color->color_type_id === 'ink-metallic') {
                        $hexColor2 = shadeColor2($hexColor, -0.5);
                        $gradient = "background-image: linear-gradient(135deg, {$hexColor} 0%, {$hexColor2} 100%);";
                    }
                    if ($color->color_type_id === 'foil') {
                        $spacesRemoved = str_replace(
                            " ",
                            "",
                            $color->long_name
                        );
                        $lowered = strtolower($spacesRemoved);
                        $filename = $lowered . ".jpg";
                        $background = "background: url(/storage/images/swatches-foils-assets/{$filename}); background-size: cover;";
                    }
                    $output .=
                        "<li class='swatches__item text-stroke-black d-flex justify-content-center align-items-center text-center' style='background-color: {$hexColor}; {$gradient} {$background}'>{$color->short_name}</li>" .
                        PHP_EOL;
                }

                $output .= "</ul>" . PHP_EOL;
                $output .= "</div>" . PHP_EOL;
            } // if (!empty($category->colors))
        } // foreach ($swatchCategories as $category)

        // If there are no colors _at all_, just return null.
        if (empty($numColors)) {
            return null;
        }

        return $output;
    }

    /**
     * Get all of the Product Color swatches for a given Product Line.
     *
     * @param $productLine
     * @param array $activeArray
     * @return string
     */
    private function getSwatchesProduct($productLine, array $activeArray)
    {
        $products = Product::with([
            'colors' => function ($query) use ($activeArray) {
                $query
                    ->whereIn('active', $activeArray)
                    ->orderBy('priority', 'asc');
            }
        ])
            ->where(
                'product_subcategory_id',
                $productLine->product_subcategory_id
            )
            ->whereIn('active', $activeArray)
            ->orderBy('priority', 'asc')
            ->get();

        return $this->formatSwatches($products, 'name');
    }

    /**
     * Get all of the Imprint Color swatches for a given Product Line.
     *
     * @param $productLine
     * @param array $activeArray
     * @return null|string
     */
    private function getSwatchesImprintColor($productLine, array $activeArray)
    {
        // Retrieve the Color Types for this Product Line and its associated info that we need.
        $colorTypes = ColorType::whereHas('productLines', function (
            $query
        ) use ($activeArray, $productLine) {
            $query
                ->where('product_line_id', $productLine->id)
                ->whereIn('active', $activeArray);
        })
            ->with([
                'colors' => function ($query) use ($activeArray, $productLine) {
                    $query
                        ->with([
                            'printMethods' => function ($subquery) use (
                                $activeArray,
                                $productLine
                            ) {
                                $subquery
                                    ->where(
                                        'print_method_id',
                                        $productLine->print_method_id
                                    )
                                    ->whereIn(
                                        'color_print_method.active',
                                        $activeArray
                                    )
                                    ->orderBy('priority', 'asc');
                            }
                        ])
                        ->whereIn('active', $activeArray);
                }
            ])
            ->whereIn('active', $activeArray)
            ->where('id', '<>', 'product')
            ->orderBy('priority', 'asc')
            ->get();

        return $this->formatSwatches($colorTypes, 'long_name');
    }

    /**
     * Get all of the Imprint Type swatches for a given Product Line.
     *
     * @param $productLine
     * @param array $activeArray
     * @return null|string
     */
    private function getSwatchesImprintType($productLine, array $activeArray)
    {
        $output = "";

        $imprintTypes = ImprintType::whereHas('productLines', function (
            $query
        ) use ($activeArray, $productLine) {
            $query
                ->where('product_line_id', $productLine->id)
                ->whereIn('active', $activeArray);
        })
            ->whereIn('active', $activeArray)
            ->orderBy('priority', 'asc')
            ->get();

        // If there are no imprint types _at all_, just return null.
        if ($imprintTypes->count() < 2) {
            return null;
        }

        $output .= "<div class='d-flex flex-row'>" . PHP_EOL;
        $output .=
            "<ul class='swatches__list list-unstyled d-flex flex-wrap'>" .
            PHP_EOL;
        foreach ($imprintTypes as $imprintType) {
            // Set up the file name for this imprint type.
            $imageFile = asset(
                "storage/images/imprint-types-assets/{$imprintType->id}.jpg"
            );

            $output .= "<li class='text-center m-1'>" . PHP_EOL;
            $output .= "<figure>" . PHP_EOL;
            $output .=
                "<figcaption class='swatches__caption'>{$imprintType->title}</figcaption>" .
                PHP_EOL;
            $output .=
                "<img src='{$imageFile}' data-rjs='3' alt='{$imprintType->title}' class='swatches__image'>" .
                PHP_EOL;
            $output .= "</figure>" . PHP_EOL;
            $output .= "</li>" . PHP_EOL;
        }

        $output .= "</ul>" . PHP_EOL;
        $output .= "</div>" . PHP_EOL;

        return $output;
    }
}
