<?php

namespace App\Http\Controllers;

use App\Models\Contourjob;
use Illuminate\Http\Request;

class ContourController extends Controller
{
    public function showJobs()
    {
        $jobs = Contourjob::paginate(5);
        return view('website.contour', compact('jobs'));
    }
    
    public function search(Request $request)
    {
        $title = $request->input('title');
        $location = $request->input('location');

        $jobs = Contourjob::query()
            ->when($title, function ($query, $title) {
                return $query->where('title', 'LIKE', "%$title%");
            })
            ->when($location, function ($query, $location) {
                return $query->where('location', 'LIKE', "%$location%");
            })
            ->paginate(5);

        return view('website.contour', compact('jobs'));
    }

    public function reset(){
        return redirect()->route('websitecontour');
    }
}
