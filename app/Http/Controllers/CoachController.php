<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class CoachController extends Controller
{
    /**
     * Display a listing of the coaches.
     */
    public function index(): View
    {
        $coaches = Coach::latest()->paginate(15);
        return view('superadmin.Coaches', compact('coaches'));
    }

    /**
     * Show the form for creating a new coach.
     */
    public function create(): View
    {
        return view('superadmin.AddCoaches');
    }

    /**
     * Store a newly created coach in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:Head Coach,Assistant Coach,Sub Assistant Coach,Thrower'],
            'gender' => ['required', 'string', 'in:Male,Female,Other'],
            'nic' => ['nullable', 'string', 'max:20'],
            'qualifications' => ['nullable', 'string', 'max:500'],
            'num' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'salary' => ['nullable', 'string', 'max:50'],
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('coaches/photos', 'public');
            $validated['photo'] = $photoPath;
        }

        Coach::create($validated);

        return redirect()->route('coaches.index')
            ->with('success', 'Coach added successfully!');
    }

    /**
     * Display the specified coach.
     */
    public function show(Coach $coach): View
    {
        return view('superadmin.coaches.show', compact('coach'));
    }

    /**
     * Show the form for editing the specified coach.
     */
    public function edit(Coach $coach): View
    {
        return view('superadmin.EditCoaches', compact('coach'));
    }

    /**
     * Update the specified coach in storage.
     */
    public function update(Request $request, Coach $coach): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:Head Coach,Assistant Coach,Sub Assistant Coach,Thrower'],
            'gender' => ['required', 'string', 'in:Male,Female,Other'],
            'nic' => ['nullable', 'string', 'max:20'],
            'qualifications' => ['nullable', 'string', 'max:500'],
            'num' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'salary' => ['nullable', 'string', 'max:50'],
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($coach->photo && Storage::disk('public')->exists($coach->photo)) {
                Storage::disk('public')->delete($coach->photo);
            }
            $photoPath = $request->file('photo')->store('coaches/photos', 'public');
            $validated['photo'] = $photoPath;
        }

        $coach->update($validated);

        return redirect()->route('coaches.index')
            ->with('success', 'Coach updated successfully!');
    }

    /**
     * Remove the specified coach from storage.
     */
    public function destroy(Coach $coach): RedirectResponse
    {
        // Delete photo if exists
        if ($coach->photo && Storage::disk('public')->exists($coach->photo)) {
            Storage::disk('public')->delete($coach->photo);
        }

        $coach->delete();

        return redirect()->route('coaches.index')
            ->with('success', 'Coach deleted successfully!');
    }

    // Admin Methods (No Delete)
    public function adminIndex(): View
    {
        $coaches = Coach::latest()->paginate(15);
        return view('admin.Coaches', compact('coaches'));
    }

    public function adminCreate(): View
    {
        return view('admin.AddCoaches');
    }

    public function adminStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:Head Coach,Assistant Coach,Sub Assistant Coach,Thrower'],
            'gender' => ['required', 'string', 'in:Male,Female,Other'],
            'nic' => ['nullable', 'string', 'max:20'],
            'qualifications' => ['nullable', 'string', 'max:500'],
            'num' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'salary' => ['nullable', 'string', 'max:50'],
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('coaches/photos', 'public');
            $validated['photo'] = $photoPath;
        }

        Coach::create($validated);

        return redirect()->route('admin.coaches.index')
            ->with('success', 'Coach added successfully!');
    }

    public function adminShow(Coach $coach): View
    {
        return view('admin.coaches.show', compact('coach'));
    }

    public function adminEdit(Coach $coach): View
    {
        return view('admin.EditCoaches', compact('coach'));
    }

    public function adminUpdate(Request $request, Coach $coach): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:Head Coach,Assistant Coach,Sub Assistant Coach,Thrower'],
            'gender' => ['required', 'string', 'in:Male,Female,Other'],
            'nic' => ['nullable', 'string', 'max:20'],
            'qualifications' => ['nullable', 'string', 'max:500'],
            'num' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'salary' => ['nullable', 'string', 'max:50'],
        ]);

        if ($request->hasFile('photo')) {
            if ($coach->photo && Storage::disk('public')->exists($coach->photo)) {
                Storage::disk('public')->delete($coach->photo);
            }
            $photoPath = $request->file('photo')->store('coaches/photos', 'public');
            $validated['photo'] = $photoPath;
        }

        $coach->update($validated);

        return redirect()->route('admin.coaches.index')
            ->with('success', 'Coach updated successfully!');
    }

    // User Methods (Read Only)
    public function userIndex(): View
    {
        $coaches = Coach::latest()->paginate(15);
        return view('user.Coaches', compact('coaches'));
    }

    public function userShow(Coach $coach): View
    {
        return view('user.coaches.show', compact('coach'));
    }
}
