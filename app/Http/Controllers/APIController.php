<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public static function getCategories(){
        $query = Category::select('id','name','image','created_at','updated_at');
        return datatables($query)->addColumn('action', function ($row) {
            $html = '<a href="javascript:void(0)" data-id="' . $row->id . '"  class="edit btn btn-xs btn-secondary btn-edit " ><span><i class="bi bi-pencil-square"></i></span></a>';
            $html .= '<button data-id="' . $row->id . '" class="delete btn btn-xs btn-danger btn-delete"><i class="bi bi-trash-fill"></i></span></button>';
            return $html;
        })->make(true);

    }

    public static function getBrands(){
        $query = Brands::select('id','name','logo','created_at','updated_at');
        return datatables($query)->addColumn('action', function ($row) {
            $html = '<a href="javascript:void(0)" data-id="' . $row->id . '"  class="edit btn btn-xs btn-secondary btn-edit " ><span><i class="bi bi-pencil-square"></i></span></a>';
            $html .= '<a  data-toggle="modal" id="smallButton" data-target="#smallModal" data-attr= "' . "{{ route('brand.delete',$row->id) }}" . '" class="delete btn btn-xs btn-danger btn-delete"><i class="bi bi-trash-fill"></i></span></button>';
            return $html;
        })->make(true);
    }

    public static function getProducts(){
        $query = Product::select('id','name','stock','price','image','created_at','updated_at');
        return datatables($query)->addColumn('action', function ($row) {
            $html = '<a href="javascript:void(0)" data-id="' . $row->id . '"  class="edit btn btn-xs btn-secondary btn-edit " ><span><i class="bi bi-pencil-square"></i></span></a>';
            $html .= '<button data-id="' . $row->id . '" class="delete btn btn-xs btn-danger btn-delete"><i class="bi bi-trash-fill"></i></span></button>';
            return $html;
        })->make(true);
    }
}
