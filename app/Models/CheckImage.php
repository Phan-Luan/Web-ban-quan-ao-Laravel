<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CheckImage extends Model
{
    use HasFactory;

    public static function checkImage(Request $request, $folderName)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->hashName();
            $request->file('image')->storeAs('public/images/' . $folderName, $imageName);
        }
        return $imageName;
    }
}
