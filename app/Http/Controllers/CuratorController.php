<?php

namespace App\Http\Controllers;

use App\Models\Curator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CuratorController extends Controller
{
    public function index(Request $request)
    {
        $curators = Curator::filter($request->all())->paginate(8);

        return view('curators.index', compact('curators'));
    }

    public function create()
    {
        return view('curators.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        Curator::create($request->all());

        return redirect()->route('curators.index');
    }

    public function edit(Curator $curator)
    {
        return view('curators.edit',compact('curator'));
    }

    public function update(Request $request, Curator $curator): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $curator->fill($request->all())->save();

        return redirect()->route('curators.index');
    }

    public function destroy(Curator $curator): RedirectResponse
    {
        $curator->delete();

        return redirect()->route('curators.index');
    }
}
