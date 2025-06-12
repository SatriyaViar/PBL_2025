<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $filename = time() . '_' . $request->file('upload')->getClientOriginalName();
            $request->file('upload')->storeAs('public/uploads', $filename);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/' . $filename);
            return response("<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url')</script>");
        }
    }
}
