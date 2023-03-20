<?php

namespace App\Http\Controllers;

use App\Models\AdditionalEvent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class AdditionalEventController extends Controller
{
    public function index(Request $request)
    {
        $additionalEvents = AdditionalEvent::filter($request->all())->paginate(8);

        return view('additional_event.index', compact('additionalEvents'));
    }

    public function create()
    {
        return view('additional_event.create');
    }

    public function store(Request $request)
    {
        request()->validate(AdditionalEvent::$rules);

        AdditionalEvent::create($request->all());

        return redirect()->route('additional_events.index');
    }

    public function show(AdditionalEvent $additionalEvent)
    {
        return view('additional_event.show', compact('additionalEvent'));
    }

    public function edit(AdditionalEvent $additionalEvent)
    {
        return view('additional_event.edit', compact('additionalEvent'));
    }

    public function update(Request $request, AdditionalEvent $additionalEvent)
    {
        request()->validate(AdditionalEvent::$rules);

        $additionalEvent->update($request->all());

        return redirect()->route('additional_events.index');
    }

    public function destroy(AdditionalEvent $additionalEvent)
    {
        $additionalEvent->delete();

        return redirect()->route('additional_events.index');
    }
}
