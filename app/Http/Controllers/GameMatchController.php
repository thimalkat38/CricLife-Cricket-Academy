<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class GameMatchController extends Controller
{
    /**
     * Display a listing of the matches.
     */
    public function index(): View
    {
        $matches = GameMatch::latest('date')->paginate(15);
        return view('superadmin.Matches', compact('matches'));
    }

    /**
     * Show the form for creating a new match.
     */
    public function create(): View
    {
        return view('superadmin.AddMatches');
    }

    /**
     * Store a newly created match in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'team_1' => ['required', 'string', 'max:255'],
            'team_2' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'venue' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:One Day,2 Day,3 Day,T20,T10,Limited Overs One Day,Other'],
            'level' => ['required', 'string', 'in:U 09,U 11,U 13,U 15,U 17,U 19,Other'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        GameMatch::create($validated);

        return redirect()->route('matches.index')
            ->with('success', 'Match added successfully!');
    }

    /**
     * Display the specified match.
     */
    public function show(GameMatch $match): View
    {
        return view('superadmin.matches.show', compact('match'));
    }

    /**
     * Show the form for editing the specified match.
     */
    public function edit(GameMatch $match): View
    {
        return view('superadmin.EditMatches', compact('match'));
    }

    /**
     * Update the specified match in storage.
     */
    public function update(Request $request, GameMatch $match): RedirectResponse
    {
        $validated = $request->validate([
            'team_1' => ['required', 'string', 'max:255'],
            'team_2' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'venue' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:One Day,2 Day,3 Day,T20,T10,Limited Overs One Day,Other'],
            'level' => ['required', 'string', 'in:U 09,U 11,U 13,U 15,U 17,U 19,Other'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $match->update($validated);

        return redirect()->route('matches.index')
            ->with('success', 'Match updated successfully!');
    }

    /**
     * Remove the specified match from storage.
     */
    public function destroy(GameMatch $match): RedirectResponse
    {
        $match->delete();

        return redirect()->route('matches.index')
            ->with('success', 'Match deleted successfully!');
    }

    // Admin Methods (No Delete)
    public function adminIndex(): View
    {
        $matches = GameMatch::latest('date')->paginate(15);
        return view('admin.Matches', compact('matches'));
    }

    public function adminCreate(): View
    {
        return view('admin.AddMatches');
    }

    public function adminStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'team_1' => ['required', 'string', 'max:255'],
            'team_2' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'venue' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:One Day,2 Day,3 Day,T20,T10,Limited Overs One Day,Other'],
            'level' => ['required', 'string', 'in:U 09,U 11,U 13,U 15,U 17,U 19,Other'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        GameMatch::create($validated);

        return redirect()->route('admin.matches.index')
            ->with('success', 'Match added successfully!');
    }

    public function adminShow(GameMatch $match): View
    {
        return view('admin.matches.show', compact('match'));
    }

    public function adminEdit(GameMatch $match): View
    {
        return view('admin.EditMatches', compact('match'));
    }

    public function adminUpdate(Request $request, GameMatch $match): RedirectResponse
    {
        $validated = $request->validate([
            'team_1' => ['required', 'string', 'max:255'],
            'team_2' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'venue' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:One Day,2 Day,3 Day,T20,T10,Limited Overs One Day,Other'],
            'level' => ['required', 'string', 'in:U 09,U 11,U 13,U 15,U 17,U 19,Other'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $match->update($validated);

        return redirect()->route('admin.matches.index')
            ->with('success', 'Match updated successfully!');
    }

    // User Methods (Read Only)
    public function userIndex(): View
    {
        $matches = GameMatch::latest('date')->paginate(15);
        return view('user.Matches', compact('matches'));
    }

    public function userShow(GameMatch $match): View
    {
        return view('user.matches.show', compact('match'));
    }
}
