<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    /**
     * Display the shop grid page.
     */
    public function index(Request $request): View
    {
        $category = $request->query('category');
        $search = $request->query('search');
        $minPrice = $request->filled('min_price') ? (float) $request->query('min_price') : null;
        $maxPrice = $request->filled('max_price') ? (float) $request->query('max_price') : null;

        $products = ProductService::filter($category, $search, $minPrice, $maxPrice);
        $saleProducts = ProductService::getSaleProducts();
        $categories = ProductService::getCategories();
        $departments = ProductService::getDepartments();
        $totalProductsCount = count(ProductService::getAllProducts());

        return view('pages.shop', [
            'products' => $products,
            'saleProducts' => $saleProducts,
            'categories' => $categories,
            'departments' => $departments,
            'currentCategory' => $category,
            'searchQuery' => $search,
            'totalCount' => count($products),
            'totalProductsCount' => $totalProductsCount,
        ]);
    }

    /**
     * Display the product details page.
     */
    public function show(int|string|null $id = null): View
    {
        $all = ProductService::getAllProducts();
        $product = $id ? ProductService::find($id) : ($all[5] ?? $all[0]);

        if (! $product) {
            $product = $all[0];
        }

        $relatedProducts = ProductService::getRelated($product['id'], 4);

        return view('pages.shop-details', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
