<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
}
