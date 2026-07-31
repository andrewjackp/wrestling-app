<?php

namespace App\Http\Controllers;

use App\Models\Wrestler;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class WrestlerController extends Controller
{
    public function getWrestlers() {
        $selectedPromotions = selectedPromotions();

        $query = Wrestler::with('promotion')->orderBy('name');

        if (!empty($selectedPromotions)) {
            $query->whereIn('promotion_id', $selectedPromotions);
        }

        return view('wrestlers', [
            'wrestlers' => $query->paginate(24)->withQueryString(),
        ]);
    }
   
    public function loadAddWrestlerForm(Wrestler $wrestler) {
        $promotions = Promotion::all();

        return view ('add-wrestler', [
            "wrestler" => $wrestler,
            "promotions" => $promotions
        ]);
    }

    public function loadWrestler(Wrestler $wrestler) {
        $wrestler->load([
            'promotion',
            'championships',
            'bouts.result.winner',
            'bouts.event',
            'bouts.wrestlers',
            'bouts.promotion',
        ]);

        $bouts = $wrestler->bouts->sortByDesc(fn($b) => $b->event?->event_date);

        $boutsWithResults = $bouts->filter(fn($b) => $b->result !== null);

        $wins       = $boutsWithResults->filter(fn($b) => $b->result->winner_id === $wrestler->id)->count();
        $losses     = $boutsWithResults->filter(fn($b) => $b->result->winner_id !== null && $b->result->winner_id !== $wrestler->id)->count();
        $noContests = $boutsWithResults->filter(fn($b) => $b->result->winner_id === null)->count();

        return view('wrestler', [
            'wrestler' => $wrestler,
            'bouts'    => $bouts,
            'record'   => [
                'wins'        => $wins,
                'losses'      => $losses,
                'no_contests' => $noContests,
                'total'       => $bouts->count(),
            ],
        ]);
    }
    
    public function addWrestler(Request $request): RedirectResponse {

        $request->validate([
            'name'         => 'required|string',
            'promotion_id' => 'nullable|exists:promotions,id',
            'image'        => 'nullable|url',
            'hometown'     => 'nullable|string|max:255',
            'height'       => 'nullable|string|max:50',
            'weight'       => 'nullable|string|max:50',
            'bio'          => 'nullable|string',
        ]);

        try {
            Wrestler::create($request->only(['name', 'promotion_id', 'image', 'hometown', 'height', 'weight', 'bio']));

            return redirect('/wrestlers')->with('success', 'Wrestler added.');

        } catch (\Exception $e) {
            return redirect('add/wrestler')->with('fail', $e->getMessage());
        }
    }

    public function editWrestler($id) {
        $wrestler = Wrestler::find($id);
        $promotions = Promotion::all();
        $wrestler->load('promotion');
        return view ('edit-wrestler', compact('wrestler'), [
            "promotions" => $promotions
        ]); 
    }

    public function updateWrestler(Request $request, $id) {

        $request->validate([
            'name'         => 'required|string',
            'promotion_id' => 'nullable|exists:promotions,id',
            'image'        => 'nullable|url',
            'hometown'     => 'nullable|string|max:255',
            'height'       => 'nullable|string|max:50',
            'weight'       => 'nullable|string|max:50',
            'bio'          => 'nullable|string',
        ]);

        try {
            $wrestler = Wrestler::findOrFail($id);
            $wrestler->update($request->only(['name', 'promotion_id', 'image', 'hometown', 'height', 'weight', 'bio']));

            return redirect('/wrestlers')->with('success', 'Wrestler updated.');

        } catch (\Exception $e) {
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }

    public function deleteWrestler($id) {
        try {
                Wrestler::where('id', $id)->delete();
                return redirect('/wrestlers')->with('success', 'wrestler deleted successfully');
            }   

        catch (\Exception $e) {
                return redirect('/wrestlers')->with('fail',$e->getMessage());
        }
    }
}
