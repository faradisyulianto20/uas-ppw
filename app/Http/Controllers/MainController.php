<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        // Gender chart
        $genderStats = Pegawai::select('gender', DB::raw('COUNT(*) as total'))
            ->groupBy('gender')
            ->pluck('total', 'gender');

        $male = $genderStats['male'] ?? 0;
        $female = $genderStats['female'] ?? 0;

        // Top 5 pekerjaan
        $topJobs = Pekerjaan::withCount('pegawai')
            ->orderByDesc('pegawai_count')
            ->limit(5)
            ->get();

        $jobLabels = $topJobs->pluck('nama');
        $jobTotals = $topJobs->pluck('pegawai_count');

        return view('index', compact(
            'male',
            'female',
            'jobLabels',
            'jobTotals'
        ));
    }
}
