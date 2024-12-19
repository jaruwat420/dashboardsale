<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\MonthClickHistory;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $mainCategoryId = 6;
        // $subCategories = SubCategory::where('main_category_id', $mainCategoryId)->get();
        // return response()->json($subCategories);

        return view('frontend.report.index_2');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer',
            'month' => 'required|integer|between:1,12',
        ]);

        MonthClickHistory::create([
            'user_id' => auth()->user()->id,
            'user_name' => auth()->user()->name,
            'month' => $request->month,
            'year' => $request->year,
        ]);
        return response()->json(['message' => 'Click recorded successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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

    public function salesPerformance (Request $request)
    {
        return view('frontend.report.sales.index');
    }

    public function salesPromotion (Request $request)
    {
        return view('frontend.report.promotion.index');
    }

    public function reportFranchise ()
    {
        return view ('frontend.report.index');
    }
}
