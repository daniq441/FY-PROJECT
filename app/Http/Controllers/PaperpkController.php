<?php

namespace App\Http\Controllers;

use App\Models\Paperpkjob;
use Illuminate\Http\Request;

class PaperpkController extends Controller
{
    public function showJobs()
    {
        $jobs = Paperpkjob::paginate(5);
        return view('website.paperpk', compact('jobs'));
    }
    public function search(Request $request)
    {
        $title = $request->input('title');
        $location = $request->input('location');

        $jobs = Paperpkjob::query()
            ->when($title, function ($query, $title) {
                return $query->where('title', 'LIKE', "%$title%");
            })
            ->when($location, function ($query, $location) {
                return $query->where('location', 'LIKE', "%$location%");
            })
            ->paginate(5);

        return view('website.paperpk', compact('jobs'));
    }

    public function reset(){
        return redirect()->route('websitepaperpk');
    }
}
