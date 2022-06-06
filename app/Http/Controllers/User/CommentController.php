<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'content' => 'required|max:2000',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }
        else
        {
            $user->comments()->create($request->all());
            return response()->json([
                'status' => 200,
                'message' => 'Comentario enviado!'
            ]);
        }
    }
}
