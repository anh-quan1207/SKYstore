<?php
namespace App\Repositories;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ProductRepository 
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function create(array $data)
    {
        return $this->product->create($data);
    }

    public function update(array $data, $product)
    {
        return $product->update($data);
    }

    public function delete($product)
    {
        return $product->delete();
    }

    public function getProducts()
    {
        return $this->product->paginate(30);
    }

    public function getProductsWithProductVariants()
    {
        return $this->product->with('productVariants')->get();
    }

    public function getByIdWithImage($id)
    {
        return $this->product->with('imageProducts')->find($id);
    }


    public function existsProductName($productName)
    {
        return $this->product->where('name',$productName)->exists();
    }

    public function getById($id)
    {
        return  $this->product->find($id);
    }

    public function getByIdWithProductVariants($id)
    {
        return $this->product->with('productVariants')->find($id);
    }

    public function getByCategories(array $categoryIds)
    {
        return  Product::whereIn('category_id', $categoryIds)->whereHas('productVariants')->orderByDesc('created_at')->paginate(16);
    }

    public function getByCategoriesAndName(array $categoryIds, $productName)
    {
        return Product::whereIn('category_id', $categoryIds)->whereHas('productVariants')->where('name','like','%' . $productName . '%')->orderByDesc('created_at')->paginate(16);
    } 

    public function getByCategory($categoryId)
    {
        return $this->product->where('category_id', $categoryId)->paginate(16);
    }

    // top san pham theo so don hang
    public function getTopProductOrderByMonth($yearNow, $monthNow, $status)
    {
        $query = DB::table('products as p')
            ->select(
                'p.id',
                'p.name',
                DB::raw('COUNT(p.id) as quantity_order'),
                DB::raw('SUM(ol.quantity) as sum_quantity'),
                DB::raw('SUM(o.total_amount) as sum_total_amount')
            )
            ->join('product_variants as pv', 'p.id', '=', 'pv.product_id')
            ->join('order_lines as ol', 'pv.id', '=', 'ol.product_variant_id')
            ->join('orders as o', function ($join) use ($status, $yearNow, $monthNow) {
                $join->on('ol.order_id', '=', 'o.id');
                $join->where('o.status', '=', $status); 
                $join->whereYear('o.created_at', '=', $yearNow);
                $join->whereMonth('o.created_at', '=', $monthNow);
            })
            ->groupBy('p.id','p.name')
            ->orderByDesc('quantity_order')
            ->limit(20)
            ->get();

        return $query;
    }

    
    // top san pham theo doanh thu
    public function getTopProductRevenueByMonth($yearNow, $monthNow, $status)
    {
        $query = DB::table('products as p')
            ->select(
                'p.id',
                'p.name',
                DB::raw('COUNT(p.id) as quantity_order'),
                DB::raw('SUM(ol.quantity) as sum_quantity'),
                DB::raw('SUM(o.total_amount) as sum_total_amount')
            )
            ->join('product_variants as pv', 'p.id', '=', 'pv.product_id')
            ->join('order_lines as ol', 'pv.id', '=', 'ol.product_variant_id')
            ->join('orders as o', function ($join) use ($status, $yearNow, $monthNow) {
                $join->on('ol.order_id', '=', 'o.id');
                $join->where('o.status', '=', $status); 
                $join->whereYear('o.created_at', '=', $yearNow);
                $join->whereMonth('o.created_at', '=', $monthNow);
            })
            ->groupBy('p.id','p.name')
            ->orderByDesc('sum_total_amount')
            ->limit(20)
            ->get();

        return $query;
    }

    public function getBestSellingProducts($yearNow, $monthNow, $status)
    {
        $query = DB::table('products as p')
            ->select(
                'p.id',
                'p.name',
                DB::raw('COUNT(p.id) as quantity_order'),
                DB::raw('SUM(ol.quantity) as sum_quantity'),
                DB::raw('SUM(o.total_amount) as sum_total_amount')
            )
            ->join('product_variants as pv', 'p.id', '=', 'pv.product_id')
            ->join('order_lines as ol', 'pv.id', '=', 'ol.product_variant_id')
            ->join('orders as o', function ($join) use ($status, $yearNow, $monthNow) {
                $join->on('ol.order_id', '=', 'o.id');
                $join->where('o.status', '=', $status); 
                $join->whereYear('o.created_at', '=', $yearNow);
                $join->whereMonth('o.created_at', '=', $monthNow);
            })
            ->groupBy('p.id','p.name')
            ->orderByDesc('sum_quantity')
            ->limit(20)
            ->get();

        return $query;
    }
}