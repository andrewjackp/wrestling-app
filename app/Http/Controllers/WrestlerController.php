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
            return view ('wrestlers', [
            "wrestlers" => Wrestler::all()->sortBy('name')
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
        $wrestler->load('promotion');

        return view('wrestler', [
        "wrestler" => $wrestler
    ]);
    }
    
    public function addWrestler(Request $request): RedirectResponse {

        $request->validate([

            'name' => 'required|string',
            'promotion_id' => 'nullable|string'

        ]);
        
        try {
            $new_wrestler = new Wrestler;
            $new_wrestler->load('promotion');
            $new_wrestler->name = $request->name;
            $new_wrestler->promotion_id = $request->promotion_id;
            $new_wrestler->save();   

            return redirect('/wrestlers')->with('success', 'wrestler added');
            
            } 

            catch (\Exception $e) 
            {
                return redirect('add-wrestler')->with('failed', $e->getMessage());
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
            'name' => 'required|string',
            'promotion_id' => 'nullable|integer',
        ]);

        try {
            $wrestler = Wrestler::find($id);
            $wrestler->name = $request->input('name');
            $wrestler->promotion_id = $request->input('promotion_id');
            $wrestler->save();

            return redirect('/wrestlers')->with('success', 'wrestler updated successfully');
            
            } 

            catch (\Exception $e)  {
                return redirect('editWrestler')->with('failed',$e->getMessage());
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
