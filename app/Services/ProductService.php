<?php

namespace App\Services;

class ProductService
{
    /**
     * Get all categories.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function getCategories(): array
    {
        return [
            'haircare' => [
                'id' => 'haircare',
                'name' => 'Hair Care',
                'count' => 3,
                'icon' => 'fa-tint',
            ],
            'bodycare' => [
                'id' => 'bodycare',
                'name' => 'Body Care',
                'count' => 2,
                'icon' => 'fa-leaf',
            ],
            'facialcare' => [
                'id' => 'facialcare',
                'name' => 'Facial Care',
                'count' => 2,
                'icon' => 'fa-heart',
            ],
            'sets' => [
                'id' => 'sets',
                'name' => 'Sets & Bundles',
                'count' => 2,
                'icon' => 'fa-gift',
            ],
            'travel' => [
                'id' => 'travel',
                'name' => 'Travel Essentials',
                'count' => 1,
                'icon' => 'fa-suitcase',
            ],
        ];
    }

    /**
     * Get departments list for dropdown menus and sidebar.
     *
     * @return array<int, array<string, string>>
     */
    public static function getDepartments(): array
    {
        return [
            ['slug' => 'all', 'name' => 'All Botanical Products'],
            ['slug' => 'haircare', 'name' => 'Hair Care & Scalp'],
            ['slug' => 'bodycare', 'name' => 'Body Wash & Lotion'],
            ['slug' => 'facialcare', 'name' => 'Facial Care & Serums'],
            ['slug' => 'sets', 'name' => 'Botanical Rituals & Sets'],
            ['slug' => 'travel', 'name' => 'Travel Essentials'],
        ];
    }

    /**
     * Get all products in the catalog.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function getAllProducts(): array
    {
        return [
            [
                'id' => 1,
                'slug' => 'liva-balancing-shampoo',
                'name' => 'LIVA Balancing Shampoo',
                'category_id' => 'haircare',
                'category_name' => 'Hair Care',
                'price' => 32.00,
                'original_price' => 38.00,
                'is_sale' => true,
                'discount_percent' => '-15%',
                'image' => 'img/shampoo.webp',
                'hover_image' => 'img/shampoo-hover.jpg',
                'gallery' => [
                    'img/shampoo.webp',
                    'img/shampoo-hover.jpg',
                    'img/conditioner.webp',
                    'img/campaign/hair-pair.webp',
                ],
                'rating' => 4.9,
                'reviews_count' => 38,
                'short_description' => 'A gentle, botanical shampoo crafted with rosemary, sage, and chamomile to balance sebum production and purify roots while preserving natural moisture.',
                'description' => 'Formulated with organic botanicals and cold-pressed plant essences, LIVA Balancing Shampoo cleanses the scalp with delicate coconut-derived surfactants. It clarifies without stripping essential moisture, leaving hair feeling weightless, refreshed, and visibly luminous.',
                'skin_type' => 'All Hair & Scalp Types',
                'size' => '250ml / 8.4 fl oz',
                'weight' => '0.35 kg',
                'stock' => 'In Stock',
                'features' => [
                    'Infused with certified organic rosemary and white tea extracts',
                    'Sulfate-free, paraben-free, silicone-free formula',
                    '100% Vegan & Leaping Bunny certified cruelty-free',
                    'Recyclable amber bottle protecting botanical bio-actives',
                ],
            ],
            [
                'id' => 2,
                'slug' => 'liva-nourishing-conditioner',
                'name' => 'LIVA Nourishing Conditioner',
                'category_id' => 'haircare',
                'category_name' => 'Hair Care',
                'price' => 34.00,
                'original_price' => 40.00,
                'is_sale' => true,
                'discount_percent' => '-15%',
                'image' => 'img/conditioner.webp',
                'hover_image' => 'img/conditioner-hover.webp',
                'gallery' => [
                    'img/conditioner.webp',
                    'img/conditioner-hover.webp',
                    'img/shampoo.webp',
                    'img/hair-mask.png',
                ],
                'rating' => 4.8,
                'reviews_count' => 29,
                'short_description' => 'Rich botanical conditioner with shea butter, jojoba oil, and oat protein to deeply nourish, detangle, and restore hair softness without buildup.',
                'description' => 'Impart silky smoothness and radiant shine with LIVA Nourishing Conditioner. Hydrolyzed oat peptides penetrate hair fibers to strengthen dry strands, while organic argan and jojoba oils seal the cuticle against environmental stressors.',
                'skin_type' => 'Dry, Normal & Color-Treated Hair',
                'size' => '250ml / 8.4 fl oz',
                'weight' => '0.35 kg',
                'stock' => 'In Stock',
                'features' => [
                    'Enriched with cold-pressed Moroccan argan oil and shea butter',
                    'Prevents split ends and reduces hair breakage by 80%',
                    'Safe for color-treated and keratin-treated hair',
                    'Delicate aroma of bergamot, cedarwood, and lavender',
                ],
            ],
            [
                'id' => 3,
                'slug' => 'liva-restorative-hair-mask',
                'name' => 'LIVA Restorative Hair Mask',
                'category_id' => 'haircare',
                'category_name' => 'Hair Care',
                'price' => 45.00,
                'original_price' => null,
                'is_sale' => false,
                'discount_percent' => null,
                'image' => 'img/hair-mask.png',
                'hover_image' => 'img/hair-mask.png',
                'gallery' => [
                    'img/hair-mask.png',
                    'img/shampoo.webp',
                    'img/conditioner.webp',
                    'img/ritual-duo.webp',
                ],
                'rating' => 5.0,
                'reviews_count' => 42,
                'short_description' => 'An intensive weekly rescue treatment formulated with cupuaçu butter and plant ceramides to rejuvenate damaged, heat-stressed hair.',
                'description' => 'Experience intense deep-conditioning renewal. The LIVA Restorative Hair Mask wraps each strand in a nourishing cocoon of botanical ceramides and virgin coconut nectar, reviving elasticity, suppleness, and high-gloss vitality in just 10 minutes.',
                'skin_type' => 'Damaged, Dry or Chemically Treated',
                'size' => '200ml / 6.7 fl oz',
                'weight' => '0.30 kg',
                'stock' => 'In Stock',
                'features' => [
                    'Intense repair treatment with biomimetic plant ceramides',
                    'Clinically tested to restore elasticity and natural moisture',
                    'Noticeable soft touch after just one application',
                    'Free from synthetic fragrances, phthalates, and mineral oils',
                ],
            ],
            [
                'id' => 4,
                'slug' => 'liva-refreshing-shower-gel',
                'name' => 'LIVA Refreshing Shower Gel',
                'category_id' => 'bodycare',
                'category_name' => 'Body Care',
                'price' => 28.00,
                'original_price' => null,
                'is_sale' => false,
                'discount_percent' => null,
                'image' => 'img/shower-gel.png',
                'hover_image' => 'img/shower-gel.png',
                'gallery' => [
                    'img/shower-gel.png',
                    'img/body-lotion.webp',
                    'img/botanical.png',
                    'img/travel-set.webp',
                ],
                'rating' => 4.7,
                'reviews_count' => 21,
                'short_description' => 'Invigorating body wash infused with organic eucalyptus, peppermint, and aloe vera leaf juice to cleanse and energize.',
                'description' => 'Transform your daily shower into a spa-like sensory awakening. LIVA Refreshing Shower Gel creates a plush, micro-fine lather that purifies pores while organic aloe vera soothes and preserves skin hydration.',
                'skin_type' => 'All Skin Types',
                'size' => '300ml / 10.1 fl oz',
                'weight' => '0.40 kg',
                'stock' => 'In Stock',
                'features' => [
                    'Naturally revitalizing eucalyptus and citrus essential oils',
                    'pH-balanced formula respecting the natural skin barrier',
                    'Biodegradable plant-derived cleanser with aloe vera base',
                    'Leaves skin revitalized and delicately scented all day',
                ],
            ],
            [
                'id' => 5,
                'slug' => 'liva-hydrating-body-lotion',
                'name' => 'LIVA Hydrating Body Lotion',
                'category_id' => 'bodycare',
                'category_name' => 'Body Care',
                'price' => 36.00,
                'original_price' => null,
                'is_sale' => false,
                'discount_percent' => null,
                'image' => 'img/body-lotion.webp',
                'hover_image' => 'img/body-lotion.webp',
                'gallery' => [
                    'img/body-lotion.webp',
                    'img/shower-gel.png',
                    'img/botanical.png',
                    'img/daily-edit.webp',
                ],
                'rating' => 4.9,
                'reviews_count' => 34,
                'short_description' => 'Fast-absorbing botanical body moisturizer packed with sweet almond oil, botanical squalane, and green tea polyphenols.',
                'description' => 'Provide 24-hour hydration without greasy residue. LIVA Hydrating Body Lotion melts effortlessly upon contact, locking in moisture with olive squalane and calming irritated or dry skin with antioxidant-rich green tea leaf extracts.',
                'skin_type' => 'Dry to Very Dry Skin',
                'size' => '250ml / 8.4 fl oz',
                'weight' => '0.35 kg',
                'stock' => 'In Stock',
                'features' => [
                    'Fast-absorbing velvet finish with zero sticky residue',
                    'Phytosqualane and sweet almond oil reinforce moisture seal',
                    'Calms dry redness and restores silky skin elasticity',
                    'Dermatologically tested for sensitive skin',
                ],
            ],
            [
                'id' => 6,
                'slug' => 'liva-botanical-daily-edit',
                'name' => 'LIVA Botanical Daily Edit',
                'category_id' => 'sets',
                'category_name' => 'Sets & Bundles',
                'price' => 68.00,
                'original_price' => 85.00,
                'is_sale' => true,
                'discount_percent' => '-20%',
                'image' => 'img/daily-edit.webp',
                'hover_image' => 'img/daily-edit-detail.webp',
                'gallery' => [
                    'img/daily-edit.webp',
                    'img/daily-edit-detail.webp',
                    'img/ritual-duo.webp',
                    'img/travel-set.webp',
                ],
                'rating' => 5.0,
                'reviews_count' => 64,
                'short_description' => 'The ultimate 3-step botanical morning ritual: Balancing Shampoo, Nourishing Conditioner, and Hydrating Body Lotion in an exclusive gift box.',
                'description' => 'Elevate your daily self-care ritual. The LIVA Botanical Daily Edit brings together our three most celebrated daily formulations, carefully curated to cleanse, nourish, and protect your hair and body with pure botanical synergy.',
                'skin_type' => 'All Skin & Hair Types',
                'size' => '3-Piece Full Ritual Set',
                'weight' => '1.10 kg',
                'stock' => 'In Stock',
                'features' => [
                    'Includes Shampoo (250ml), Conditioner (250ml) & Body Lotion (250ml)',
                    'Saves 20% compared to purchasing items individually',
                    'Packaged in an elegant, eco-friendly luxury gift box',
                    'Perfect gift for mindful beauty lovers and wellness enthusiasts',
                ],
            ],
            [
                'id' => 7,
                'slug' => 'liva-hair-ritual-duo',
                'name' => 'LIVA Hair Ritual Duo',
                'category_id' => 'sets',
                'category_name' => 'Sets & Bundles',
                'price' => 58.00,
                'original_price' => 68.00,
                'is_sale' => true,
                'discount_percent' => '-15%',
                'image' => 'img/ritual-duo.webp',
                'hover_image' => 'img/campaign/hair-pair.webp',
                'gallery' => [
                    'img/ritual-duo.webp',
                    'img/campaign/hair-pair.webp',
                    'img/shampoo.webp',
                    'img/conditioner.webp',
                ],
                'rating' => 4.9,
                'reviews_count' => 47,
                'short_description' => 'The complete botanical hair care solution featuring our Balancing Shampoo and Nourishing Conditioner.',
                'description' => 'Harmonize your scalp health and amplify natural shine. The LIVA Hair Ritual Duo combines our gentle balancing cleanse with our peptide-rich conditioning therapy for resilient, flowing, silky-smooth hair.',
                'skin_type' => 'All Hair Types',
                'size' => '2 x 250ml Bottles',
                'weight' => '0.75 kg',
                'stock' => 'In Stock',
                'features' => [
                    'Full size Balancing Shampoo (250ml) and Nourishing Conditioner (250ml)',
                    'Rebalances scalp pH while deeply moisturizing mid-lengths to tips',
                    'Visible reduction in frizz and tangles from the first wash',
                    'Recyclable sustainable packaging',
                ],
            ],
            [
                'id' => 8,
                'slug' => 'liva-travel-essentials-set',
                'name' => 'LIVA Travel Essentials Set',
                'category_id' => 'travel',
                'category_name' => 'Travel Essentials',
                'price' => 42.00,
                'original_price' => 50.00,
                'is_sale' => true,
                'discount_percent' => '-16%',
                'image' => 'img/travel-set.webp',
                'hover_image' => 'img/travel-set.webp',
                'gallery' => [
                    'img/travel-set.webp',
                    'img/daily-edit.webp',
                    'img/shampoo.webp',
                    'img/body-lotion.webp',
                ],
                'rating' => 4.8,
                'reviews_count' => 31,
                'short_description' => 'TSA-compliant 4-piece travel collection featuring miniature editions of our signature haircare and bodycare heroes.',
                'description' => 'Never compromise on pure botanical care while on the road. The LIVA Travel Essentials Set features 4 flight-ready 50ml bottles housed in an organic cotton travel pouch, ensuring your hair and skin remain balanced wherever you wander.',
                'skin_type' => 'All Skin Types / Travel Ready',
                'size' => '4 x 50ml Flight-Approved',
                'weight' => '0.35 kg',
                'stock' => 'In Stock',
                'features' => [
                    '4 x 50ml travel bottles: Shampoo, Conditioner, Shower Gel, Body Lotion',
                    'Airline carry-on compliant (under 100ml each)',
                    'Includes reusable organic cotton cosmetic pouch',
                    'Leak-proof caps engineered for pressure changes during travel',
                ],
            ],
            [
                'id' => 9,
                'slug' => 'liva-botanical-pure-essence',
                'name' => 'LIVA Botanical Pure Essence',
                'category_id' => 'facialcare',
                'category_name' => 'Facial Care',
                'price' => 48.00,
                'original_price' => null,
                'is_sale' => false,
                'discount_percent' => null,
                'image' => 'img/botanical.png',
                'hover_image' => 'img/daily-edit-detail.webp',
                'gallery' => [
                    'img/botanical.png',
                    'img/daily-edit-detail.webp',
                    'img/daily-edit.webp',
                    'img/hero.webp',
                ],
                'rating' => 4.9,
                'reviews_count' => 53,
                'short_description' => 'Concentrated facial treatment essence featuring fermented green tea, niacinamide, and damask rose water for deep cellular hydration.',
                'description' => 'Prepare and prime your skin canvas. LIVA Botanical Pure Essence infuses skin with moisture-binding fermented botanical actives, evening skin tone and boosting the absorption of subsequent serums and moisturizers.',
                'skin_type' => 'All Skin Types / Dull & Dehydrated Skin',
                'size' => '100ml / 3.4 fl oz',
                'weight' => '0.25 kg',
                'stock' => 'In Stock',
                'features' => [
                    'Fermented green tea bio-ferment for intense antioxidant protection',
                    'Niacinamide (Vitamin B3) refines pores and clarifies texture',
                    'Organic Bulgarian rose hydrosol provides instant dewiness',
                    'Alcohol-free, non-comedogenic, and fragrance-free',
                ],
            ],
            [
                'id' => 10,
                'slug' => 'liva-radiant-glow-elixir',
                'name' => 'LIVA Radiant Glow Elixir',
                'category_id' => 'facialcare',
                'category_name' => 'Facial Care',
                'price' => 54.00,
                'original_price' => 65.00,
                'is_sale' => true,
                'discount_percent' => '-17%',
                'image' => 'img/result-1.webp',
                'hover_image' => 'img/result-2.jpg',
                'gallery' => [
                    'img/result-1.webp',
                    'img/result-2.jpg',
                    'img/result-3.jpg',
                    'img/botanical.png',
                ],
                'rating' => 5.0,
                'reviews_count' => 61,
                'short_description' => 'Lightweight facial oil infused with rosehip seed oil, sea buckthorn, and squalane to restore youthful glow and skin bounce.',
                'description' => 'Unlock luminous, plump radiance. The LIVA Radiant Glow Elixir blends nutrient-dense botanicals rich in Omega 3, 6, 7 and 9. It protects against oxidative damage, calms irritation, and locks in dewy hydration without clogging pores.',
                'skin_type' => 'Dry, Normal, Sensitive & Mature Skin',
                'size' => '50ml / 1.7 fl oz',
                'weight' => '0.18 kg',
                'stock' => 'In Stock',
                'features' => [
                    'Cold-pressed Chilean rosehip seed and Himalayan sea buckthorn oils',
                    'Rich in Vitamin C, carotenoids, and essential fatty acids',
                    'Absorbs quickly with a luminous, non-greasy finish',
                    'Can be blended with moisturizer or worn alone as final step',
                ],
            ],
        ];
    }

    /**
     * Find a product by ID or slug.
     *
     * @return array<string, mixed>|null
     */
    public static function find(int|string|null $idOrSlug): ?array
    {
        if ($idOrSlug === null) {
            return null;
        }

        $products = self::getAllProducts();

        foreach ($products as $product) {
            if ((string) $product['id'] === (string) $idOrSlug || $product['slug'] === (string) $idOrSlug) {
                return $product;
            }
        }

        return null;
    }

    /**
     * Get filtered products.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function filter(?string $category = null, ?string $search = null, ?float $minPrice = null, ?float $maxPrice = null): array
    {
        $products = self::getAllProducts();

        return array_values(array_filter($products, function (array $product) use ($category, $search, $minPrice, $maxPrice): bool {
            if ($category && $category !== 'all') {
                if ($product['category_id'] !== $category) {
                    return false;
                }
            }

            if ($search) {
                $term = mb_strtolower(trim($search));
                $nameMatch = str_contains(mb_strtolower($product['name']), $term);
                $descMatch = str_contains(mb_strtolower($product['short_description']), $term);
                $catMatch = str_contains(mb_strtolower($product['category_name']), $term);

                if (! $nameMatch && ! $descMatch && ! $catMatch) {
                    return false;
                }
            }

            if ($minPrice !== null && $product['price'] < $minPrice) {
                return false;
            }

            if ($maxPrice !== null && $product['price'] > $maxPrice) {
                return false;
            }

            return true;
        }));
    }

    /**
     * Get featured products.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function getFeatured(int $limit = 8): array
    {
        return array_slice(self::getAllProducts(), 0, $limit);
    }

    /**
     * Get sale / discount products.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function getSaleProducts(): array
    {
        return array_values(array_filter(self::getAllProducts(), function (array $product): bool {
            return (bool) ($product['is_sale'] ?? false);
        }));
    }

    /**
     * Get related products for a given product.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function getRelated(int|string $idOrSlug, int $limit = 4): array
    {
        $current = self::find($idOrSlug);
        $products = self::getAllProducts();

        $related = array_filter($products, function (array $product) use ($current): bool {
            if (! $current) {
                return true;
            }

            return (int) $product['id'] !== (int) $current['id'];
        });

        // Prioritize same category
        if ($current) {
            usort($related, function (array $a, array $b) use ($current): int {
                $aMatch = ($a['category_id'] === $current['category_id']) ? 1 : 0;
                $bMatch = ($b['category_id'] === $current['category_id']) ? 1 : 0;

                return $bMatch <=> $aMatch;
            });
        }

        return array_slice(array_values($related), 0, $limit);
    }
}
