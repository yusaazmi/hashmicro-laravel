<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function inputFeature()
    {
        return view('inputFeature');
    }

    public function storeInputFeature(Request $request)
    {
        $request->validate([
            'keyword' => 'required',
            'word' => 'required',
        ]);
        $keyword = strtoupper($request->input('keyword'));
        $word = strtoupper($request->input('word'));

        $keywordCount = array_count_values(str_split($keyword));
        $wordCount = array_count_values(str_split($word));

        $totalChars = array_sum($keywordCount);

        if ($totalChars == 0) {
            return response()->json(['percentage' => 0]);
        }

        $matchedCount = 0;

        foreach ($keywordCount as $char => $count) {
            if (isset($wordCount[$char])) {
                $matchedCount += min($count, $wordCount[$char]);
            }
        }

        $percentage = ($matchedCount / $totalChars) * 100;

        return response()->json(['percentage' => round($percentage, 2)]);
    }
}
