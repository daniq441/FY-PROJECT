<?php

namespace App\Http\Controllers;

use App\Models\Rozeejob;
use Illuminate\Http\Request;

class RozeeController extends Controller
{
    public function showJobs(Request $request)
    {
        $jobs = Rozeejob::paginate(5);
        return view('website.rozee', compact('jobs'));
    }
    public function search(Request $request)
    {
        $title = $request->input('title');
        $location = $request->input('location');

        $jobs = Rozeejob::query()
            ->when($title, function ($query, $title) {
                return $query->where('title', 'LIKE', "%$title%");
            })
            ->when($location, function ($query, $location) {
                return $query->where('location', 'LIKE', "%$location%");
            })
            ->paginate(5);

        return view('website.rozee', compact('jobs'));
    }

    public function reset(){
        return redirect()->route('websiterozee');
    }
}
