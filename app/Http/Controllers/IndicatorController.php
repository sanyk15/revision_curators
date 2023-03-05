<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class IndicatorController extends Controller
{
    public function index()
    {
        $indicators = Indicator::query()->orderBy('title')->paginate(8);

        return view('indicators.index', compact('indicators'));
    }

    public function create()
    {
        return view('indicators.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
        ]);

        Indicator::create($request->all());

        return redirect()->route('indicators.index');
    }

    public function edit(Indicator $indicator)
    {
        return view('indicators.edit',compact('indicator'));
    }

    public function update(Request $request, Indicator $indicator): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
        ]);

        $indicator->fill($request->all())->save();

        return redirect()->route('indicators.index');
    }

    public function destroy(Indicator $indicator): RedirectResponse
    {
        $indicator->delete();

        return redirect()->route('indicators.index');
    }
}
