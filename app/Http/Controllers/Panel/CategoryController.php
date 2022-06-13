<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=> 'required|max:191',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Category validated successfully',
            ]);
        }
    }

    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect()
            ->route('posts.index')
            ->withSuccess('La categoria se agregó exitosamente!');
    }
}
