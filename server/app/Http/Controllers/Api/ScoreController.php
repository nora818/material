<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            "main_name" => 'required|integer|exists:products,id',
        ]);
        $data = $request->all();

        $productName = [];
        // 查出三个材料的分数
        $mainProduct = Product::query()->find($data["main_name"]);
        $mainScore = $mainProduct["score"];
        $productName['main_name'] = $mainProduct["name"];
        $secondScore = 0;
        $otherScore = 0;
        if (!empty($data['second_name'])) {
            $second = Product::query()->find($data["second_name"]);
            if ($second) {
                $secondScore = $second['score'];
                $productName['second_name'] = $second["name"];
            }
        }
        if (!empty($data['other_name'])) {
            $other = Product::query()->find($data["other_name"]);
            if ($other) {
                $otherScore = $other['score'];
                $productName['other_name'] = $other["name"];
            }
        }

        // 算出等分
        $mainWeight = 0.6;
        $secondWeight = 0.3;
        $otherWeight = 0.1;

        $finalScore = ($mainScore * $mainWeight) + ($secondScore * $secondWeight) + ($otherScore * $otherWeight);

        $data['score'] = $finalScore;
        $data['user_id'] = Auth::user()->id;
        // 保存这次评分
        Score::create($data);
        $imageUrl = $this->getImage($finalScore);
        return $this->success([
            'score' => $finalScore,
            'image_url' => $imageUrl,
            'name' => $productName
        ]);
    }

    protected function getImage($score)
    {
        if ($score >= 0 && $score <= 20) {
            return 'uploads/score1.png';
        } else if ($score > 20 && $score <= 40) {
            return 'uploads/score2.png';
        } else if ($score > 40 && $score <= 60) {
            return 'uploads/score3.png';
        } else if ($score > 61 && $score <= 80) {
            return 'uploads/score4.png';
        } else {
            return 'uploads/score5.png';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
