<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarController extends Controller
{
    /**
     * Show the brand / model selection page.
     */
    public function index(Request $request): View
    {
        $cars = Car::query()
            ->orderBy('brand')
            ->orderBy('model')
            ->get()
            ->groupBy('brand');

        return view('cars.select', [
            'cars' => $cars,
            'selectedCar' => $request->user()->car,
        ]);
    }

    /**
     * Save the chosen car on the authenticated user.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'car_id' => ['required', 'integer', 'exists:cars,id'],
        ]);

        $request->user()->update(['car_id' => $validated['car_id']]);

        $car = Car::findOrFail($validated['car_id']);

        return redirect()
            ->route('game')
            ->with('status', "You're now driving the {$car->name()}!");
    }
}
