<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index(): View
    {
        $products = ProductService::getAllProducts();
        $featuredProducts = ProductService::getFeatured(8);
        $saleProducts = ProductService::getSaleProducts();
        $categories = ProductService::getCategories();

        return view('pages.index', [
            'products' => $products,
            'featuredProducts' => $featuredProducts,
            'saleProducts' => $saleProducts,
            'categories' => $categories,
        ]);
    }
}
