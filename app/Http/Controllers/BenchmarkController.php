<?php

namespace App\Http\Controllers;

use App\Models\Benchmark;
use Illuminate\Http\Request;

class BenchmarkController extends Controller
{
    public function index(Request $request)
    {
        $benchmarks = Benchmark::filter($request->all())->paginate(8);

        return view('benchmark.index', compact('benchmarks'));
    }

    public function create()
    {
        return view('benchmark.create');
    }

    public function store(Request $request)
    {
        request()->validate(Benchmark::$rules);

        Benchmark::create($request->all());

        return redirect()->route('benchmarks.index');
    }

    public function show(Benchmark $benchmark)
    {
        return view('benchmark.show', compact('benchmark'));
    }

    public function edit(Benchmark $benchmark)
    {
        return view('benchmark.edit', compact('benchmark'));
    }

    public function update(Request $request, Benchmark $benchmark)
    {
        request()->validate(Benchmark::$rules);

        $benchmark->update($request->all());

        return redirect()->route('benchmarks.index');
    }

    public function destroy(Benchmark $benchmark)
    {
        $benchmark->delete();

        return redirect()->route('benchmarks.index');
    }
}
