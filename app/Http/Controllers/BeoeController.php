<?php

namespace App\Http\Controllers;

use App\Models\Beoejob;
use Illuminate\Http\Request;

class BeoeController extends Controller
{
    public function showJobs()
    {
        $jobs = Beoejob::paginate(5);
        return view('website.beoe', compact('jobs'));
    }
    public function search(Request $request)
    {
        $title = $request->input('title');
        $location = $request->input('location');

        $jobs = Beoejob::query()
            ->when($title, function ($query, $title) {
                return $query->where('title', 'LIKE', "%$title%");
            })
            ->when($location, function ($query, $location) {
                return $query->where('location', 'LIKE', "%$location%");
            })
            ->paginate(5);

        return view('website.beoe', compact('jobs'));
    }

    public function reset(){
        return redirect()->route('website.beoe');
    }
}
