<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    /**
     * Display a listing of the players.
     */
    public function index(): View
    {
        $players = Player::latest()->paginate(15);
        return view('superadmin.Players', compact('players'));
    }

    /**
     * Show the form for creating a new player.
     */
    public function create(): View
    {
        return view('superadmin.AddPlayers');
    }

    /**
     * Store a newly created player in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'gender' => ['required', 'string', 'in:Male,Female,Other'],
            'school' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'p_name' => ['required', 'string', 'max:255'],
            'p_num' => ['required', 'string', 'max:20'],
            'num' => ['nullable', 'string', 'max:20'],
            'monthly_fee' => ['nullable', 'string', 'max:50'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('players/photos', 'public');
            $validated['photo'] = $photoPath;
        }

        Player::create($validated);

        return redirect()->route('players.index')
            ->with('success', 'Player added successfully!');
    }

    /**
     * Display the specified player.
     */
    public function show(Player $player): View
    {
        return view('superadmin.players.show', compact('player'));
    }

    /**
     * Show the form for editing the specified player.
     */
    public function edit(Player $player): View
    {
        return view('superadmin.EditPlayers', compact('player'));
    }

    /**
     * Update the specified player in storage.
     */
    public function update(Request $request, Player $player): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'gender' => ['required', 'string', 'in:Male,Female,Other'],
            'school' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'p_name' => ['required', 'string', 'max:255'],
            'p_num' => ['required', 'string', 'max:20'],
            'num' => ['nullable', 'string', 'max:20'],
            'monthly_fee' => ['nullable', 'string', 'max:50'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($player->photo && Storage::disk('public')->exists($player->photo)) {
                Storage::disk('public')->delete($player->photo);
            }
            $photoPath = $request->file('photo')->store('players/photos', 'public');
            $validated['photo'] = $photoPath;
        }

        $player->update($validated);

        return redirect()->route('players.index')
            ->with('success', 'Player updated successfully!');
    }

    /**
     * Remove the specified player from storage.
     */
    public function destroy(Player $player): RedirectResponse
    {
        // Delete photo if exists
        if ($player->photo && Storage::disk('public')->exists($player->photo)) {
            Storage::disk('public')->delete($player->photo);
        }

        $player->delete();

        return redirect()->route('players.index')
            ->with('success', 'Player deleted successfully!');
    }

    // Admin Methods (No Delete)
    public function adminIndex(): View
    {
        $players = Player::latest()->paginate(15);
        return view('admin.Players', compact('players'));
    }

    public function adminCreate(): View
    {
        return view('admin.AddPlayers');
    }

    public function adminStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'gender' => ['required', 'string', 'in:Male,Female,Other'],
            'school' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'p_name' => ['required', 'string', 'max:255'],
            'p_num' => ['required', 'string', 'max:20'],
            'num' => ['nullable', 'string', 'max:20'],
            'monthly_fee' => ['nullable', 'string', 'max:50'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('players/photos', 'public');
            $validated['photo'] = $photoPath;
        }

        Player::create($validated);

        return redirect()->route('admin.players.index')
            ->with('success', 'Player added successfully!');
    }

    public function adminShow(Player $player): View
    {
        return view('admin.players.show', compact('player'));
    }

    public function adminEdit(Player $player): View
    {
        return view('admin.EditPlayers', compact('player'));
    }

    public function adminUpdate(Request $request, Player $player): RedirectResponse
    {
        $validated = $request->validate([  
            'name' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'gender' => ['required', 'string', 'in:Male,Female,Other'],
            'school' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'p_name' => ['required', 'string', 'max:255'],
            'p_num' => ['required', 'string', 'max:20'],
            'num' => ['nullable', 'string', 'max:20'],
            'monthly_fee' => ['nullable', 'string', 'max:50'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            if ($player->photo && Storage::disk('public')->exists($player->photo)) {
                Storage::disk('public')->delete($player->photo);
            }
            $photoPath = $request->file('photo')->store('players/photos', 'public');
            $validated['photo'] = $photoPath;
        }

        $player->update($validated);

        return redirect()->route('admin.players.index')
            ->with('success', 'Player updated successfully!');
    }

    // User Methods (Read Only)
    public function userIndex(): View
    {
        $players = Player::latest()->paginate(15);
        return view('user.Players', compact('players'));
    }

    public function userShow(Player $player): View
    {
        return view('user.players.show', compact('player'));
    }
}
