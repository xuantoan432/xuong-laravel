<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catelogue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    const PATH_VIEW = 'admin.products.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::with(['catelogue', 'tags'])->latest()->get();


        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catelogues = Catelogue::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();


        return view(self::PATH_VIEW . __FUNCTION__, compact('catelogues', 'colors', 'sizes', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataProduct = $request->except(['product_variants', 'tags', 'gallergies']);
        $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
        $dataProduct['is_hot_deal'] = isset($dataProduct['is_hot_deal']) ? 1 : 0;
        $dataProduct['is_good_deal'] = isset($dataProduct['is_good_deal']) ? 1 : 0;
        $dataProduct['is_new'] = isset($dataProduct['is_new']) ? 1 : 0;
        $dataProduct['is_show_home'] = isset($dataProduct['is_show_home']) ? 1 : 0;
        $dataProduct['slug'] = \Str::slug($dataProduct['name']) . '-' . \Str::random(8);
        if ($dataProduct['img_thumbnail']) {
            $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
        }

        $dataProductVariantsTmp = $request->product_variants;

        $dataProductVariants = [];
        foreach ($dataProductVariantsTmp as $key => $item) {
            [$sizeID, $colorID] = explode('-', $key);
            if (!empty($item['quantity'])) {
                $dataProductVariants[] = [
                    'product_color_id' => $colorID,
                    'product_size_id' => $sizeID,
                    'quantity' => $item['quantity'],
                    'image' => $item['image'] ?? null
                ];
            }

        }

        $dataTags = $request->tags;
        $dataGallergies = $request->gallergies ?: null;
        // dd($dataGallergies);
        try {

            \DB::beginTransaction();
            $product = Product::create($dataProduct);

            foreach ($dataProductVariants as $dataProductVariant) {
                $dataProductVariant['product_id'] = $product->id;
                if ($dataProductVariant['image']) {
                    $dataProductVariant['image'] = Storage::put('products', $dataProductVariant['image']);
                }

                ProductVariant::create($dataProductVariant);
            }

            $product->tags()->sync($dataTags);

            foreach ($dataGallergies as $item) {
                ProductGallery::create([
                    'product_id' => $product->id,
                    'image' => Storage::put('products', $item),
                ]);
            }

            \DB::commit();
        } catch (\Exception $exception) {
            \DB::rollBack();
            dd($exception->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            \DB::transaction(function () use ($product){
                $product->tags()->sync([]);
                $product->variants()->delete();
                $product->gallergies()->delete();
            });
        } catch (\Exception $exception) {
            return back();
        }
    }
}
