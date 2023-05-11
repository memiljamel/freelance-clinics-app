<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = User::query()
            ->select(['longest' => User::selectRaw('COUNT(*) AS longest')
                ->where('created_at', '<', now()->subMonth())])
            ->addSelect(['latest' => User::selectRaw('COUNT(*) AS latest')
                ->where('created_at', '>=', now()->subMonth())])
            ->first();

        $doctor = Doctor::query()
            ->select(['longest' => Doctor::selectRaw('COUNT(*) AS longest')
                ->where('created_at', '<', now()->subMonth())])
            ->addSelect(['latest' => Doctor::selectRaw('COUNT(*) AS latest')
                ->where('created_at', '>=', now()->subMonth())])
            ->first();
        
        $patient = Patient::query()
            ->select(['longest' => Patient::selectRaw('COUNT(*) AS longest')
                ->where('created_at', '<', now()->subMonth())])
            ->addSelect(['latest' => Patient::selectRaw('COUNT(*) AS latest')
                ->where('created_at', '>=', now()->subMonth())])
            ->addSelect(['general' => Patient::selectRaw('COUNT(*) AS general')
                ->where('type', '=', 'General')])
            ->addSelect(['jkn' => Patient::selectRaw('COUNT(*) AS jkn')
                ->where('type', '=', 'JKN')])
            ->addSelect(['jan' => Patient::selectRaw('SUM(CASE WHEN MONTH(created_at) = 1 THEN 1 ELSE 0 END) as jan')
                ->where('created_at', '>=', now()->subYear())])
            ->addSelect(['feb' => Patient::selectRaw('SUM(CASE WHEN MONTH(created_at) = 2 THEN 1 ELSE 0 END) as feb')
                ->where('created_at', '>=', now()->subYear())])
            ->addSelect(['mar' => Patient::selectRaw('SUM(CASE WHEN MONTH(created_at) = 3 THEN 1 ELSE 0 END) as mar')
                ->where('created_at', '>=', now()->subYear())])
            ->addSelect(['apr' => Patient::selectRaw('SUM(CASE WHEN MONTH(created_at) = 4 THEN 1 ELSE 0 END) as apr')
                ->where('created_at', '>=', now()->subYear())])
            ->addSelect(['may' => Patient::selectRaw('SUM(CASE WHEN MONTH(created_at) = 5 THEN 1 ELSE 0 END) as may')
                ->where('created_at', '>=', now()->subYear())])
            ->addSelect(['jun' => Patient::selectRaw('SUM(CASE WHEN MONTH(created_at) = 6 THEN 1 ELSE 0 END) as jun')
                ->where('created_at', '>=', now()->subYear())])
            ->addSelect(['jul' => Patient::selectRaw('SUM(CASE WHEN MONTH(created_at) = 7 THEN 1 ELSE 0 END) as jul')
                ->where('created_at', '>=', now()->subYear())])
            ->addSelect(['aug' => Patient::selectRaw('SUM(CASE WHEN MONTH(created_at) = 8 THEN 1 ELSE 0 END) as aug')
                ->where('created_at', '>=', now()->subYear())])
            ->addSelect(['sep' => Patient::selectRaw('SUM(CASE WHEN MONTH(created_at) = 9 THEN 1 ELSE 0 END) as sep')
                ->where('created_at', '>=', now()->subYear())])
            ->addSelect(['oct' => Patient::selectRaw('SUM(CASE WHEN MONTH(created_at) = 10 THEN 1 ELSE 0 END) as oct')
                ->where('created_at', '>=', now()->subYear())])
            ->addSelect(['nov' => Patient::selectRaw('SUM(CASE WHEN MONTH(created_at) = 11 THEN 1 ELSE 0 END) as nov')
                ->where('created_at', '>=', now()->subYear())])
            ->addSelect(['dec' => Patient::selectRaw('SUM(CASE WHEN MONTH(created_at) = 12 THEN 1 ELSE 0 END) as decs')
                ->where('created_at', '>=', now()->subYear())])
            ->first();

        return view('dashboard.index', compact('user', 'doctor', 'patient'));
    }
}
