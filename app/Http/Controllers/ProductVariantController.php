<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductVariantRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdateProductVariantRequest;
use App\Services\ImageProductService;
use App\Services\ProductService;
use App\Services\ProductVariantService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductVariantController extends Controller
{
    protected $productVariantService;
    protected $productService;
    protected $imageProductService;
    public function __construct(ProductVariantService $productVariantService,
    ProductService $productService,
    ImageProductService $imageProductService,
    )
    {
        $this->productVariantService = $productVariantService;
        $this->productService = $productService;
        $this->imageProductService = $imageProductService;
    }

    public function index(Request $request)
    {
        $productId = $request->id;
        $product = $this->productService->getByIdWithProductVariants($productId);
        if(is_null($product))
        {
            return redirect()->route('error-404');
        }

        $productVariants = $product->productVariants;
        if($productVariants->isEmpty())
        {
            $productVariants = null;
        }

        $sizes = config('variant.size');

        return view("admin.product-variant.list-product-variant", 
        ['productId' => $productId, 
        "productVariants" => $productVariants,
        'increment' => 0,
        'size'=> $sizes,
        ]);
    }

    public function create(Request $request)
    {
        $productId = $request->id;
        $product = $this->productService->getByIdWithProductVariants($productId);
        if (is_null($product)) {
            return redirect()->route('error-404');
        }
        $sizes = config('variant.size');

        return view('admin.product-variant.form-create', ['productId' => $productId, 'sizes' => $sizes]);
    }

    public function store(CreateProductVariantRequest $request)
    {
        $productId = $request->id;
        $product = $this->productService->getByIdWithProductVariants($productId);
        if (is_null($product)) {
            return redirect()->route('error-404');
        }

        $data["product_id"] = $productId;
        $data["color"] =Str::upper($request->input('color'));
        $data["size"] = Str::upper($request->input('size'));
        $data["sold_quantity"] = 0;
        $data["remain_quantity"] = $request->input('remain_quantity');
        $data["image_path"] = $request->file('image');

        $productVariantExists = $this->productVariantService->getproductVariantExists($data["product_id"],$data["color"], $data["size"]);
        if(!is_null($productVariantExists))
        {
            $result = [
                $message = "Biến thể đã tồn tại",
                $status = 'error',
            ];
            return redirect()->route('admin-product-variant-list', ['id' => $productId])->with('result', $result);
        }

        if(!is_null($data["image_path"]))
        {
             $data["image_path"] = $this->handleFileImage($data["image_path"]);
        }

        $resultCreate = $this->productVariantService->create($data);
        if ($resultCreate) {
            $product = $resultCreate->product;
            $product->remain_quantity += $resultCreate->remain_quantity;
            $product->save();

            $result = [
                $message = "Thêm biến thể thành công",
                $status = 'success',
            ];
            return redirect()->route('admin-product-variant-list',['id' => $productId])->with('result', $result);
        } else {
            $result = [
                $message = "Thêm biến thể thất bại",
                $status = 'error',
            ];
            return redirect()->route('admin-product-variant-list', ['id' => $productId])->with('result', $result);
        }
    }

    public function edit(Request $request)
    {
        $productId = $request->id;
        $productvariantId = $request->product_variant_id;
        $product = $this->productService->getById($productId);
        $productVariant = $this->productVariantService->getByIdAndProduct($productvariantId, $productId);
        if (is_null($product) || is_null($productVariant)) {
            return redirect()->route('error-404');
        }
        
        return view(
            "admin.product-variant.form-update",
            [
                'productId' => $productId,
                'productVariant' => $productVariant,
            ]
        );
    }

    public function update(UpdateProductVariantRequest $request)
    {
        $productId = $request->id;
        $productvariantId = $request->product_variant_id;
        $product = $this->productService->getById($productId);
        $productVariant = $this->productVariantService->getByIdAndProduct($productvariantId, $productId);
        if (is_null($product) || is_null($productVariant)) {
            return redirect()->route('error-404');
        }

        $data["remain_quantity"] = $request->input('remain_quantity');
        $image_path = $request->file('image');

        if (!is_null($image_path)) {
            $data["image_path"] = $this->handleFileImage($image_path);
        }

        $remainQuantityOld = $productVariant->remain_quantity;
        $resultUpdate = $this->productVariantService->update($data, $productVariant);
        if ($resultUpdate) {
            $product->remain_quantity = $product->remain_quantity - $remainQuantityOld + $resultUpdate->remain_quantity;
            $product->save();
            $result = [
                $message = "Sửa biến thể thành công",
                $status = 'success',
            ];
            return redirect()->route('admin-product-variant-list', ['id' => $productId])->with('result', value: $result);
        } else {
            $result = [
                $message = "Sửa biến thể thất bại",
                $status = 'error',
            ];
            return redirect()->route('admin-product-variant-list', ['id' => $productId])->with('result', $result);
        }
    }

    public function delete(Request $request)
    {
        $productId = $request->id;
        $productvariantId = $request->product_variant_id;
        $product = $this->productService->getById($productId);
        $productVariant = $this->productVariantService->getByIdAndProduct($productvariantId, $productId);
        if (is_null($product) || is_null($productVariant)) {
            return redirect()->route('error-404');
        }
        $remainQuantityOld = $productVariant->remain_quantity;
        $resultDelete = $this->productVariantService->delete($productVariant);
        if ($resultDelete) {
            $product->remain_quantity -= $remainQuantityOld;
            $product->save();
            $result = [
                $message = "Xóa biến thể thành công",
                $status = 'success',
            ];
            return redirect()->route('admin-product-variant-list', ['id' => $productId])->with('result', $result);;
        } else {
            $result = [
                $message = "Xóa biến thể thất bại",
                $status = 'error',
            ];
            return redirect()->route('admin-product-variant-list', ['id' => $productId])->with('result', $result);;
        }
    }


    private function handleFileImage($image)
    {
        $generatedImageName = 'image' . time() . $image->getClientOriginalName();
        $image->move(public_path('image'), $generatedImageName);
        return $generatedImageName;
    }
}