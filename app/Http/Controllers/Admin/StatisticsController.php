<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\biddings;
use Illuminate\Support\Carbon;

class StatisticsController extends Controller
{
    public function index(){
        $currentMonth = biddings::whereMonth('end_at','=',Carbon::now())->count();
        $lastMonth    = biddings::whereMonth('end_at','=',Carbon::now()->subMonth())->count();
        $lastMonth2   = biddings::whereMonth('end_at','=',Carbon::now()->subMonth(2))->count();
        $lastMonth3   = biddings::whereMonth('end_at','=',Carbon::now()->subMonth(3))->count();
        $lastMonth4   = biddings::whereMonth('end_at','=',Carbon::now()->subMonth(4))->count();
        $lastMonth5   = biddings::whereMonth('end_at','=',Carbon::now()->subMonth(5))->count();

        $chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('line')
            ->size(['width' => 350, 'height' => 200])
            ->labels([StatisticsController::GetLastMonth5(),StatisticsController::GetLastMonth4(),
                StatisticsController::GetLastMonth3(), StatisticsController::GetLastMonth2(),
                StatisticsController::GetLastMonth(), StatisticsController::GetCurrentMonth()])
            ->datasets([
                [
                    "label" => "عدد المزادات",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#81b214",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [$lastMonth5,$lastMonth4,$lastMonth3,
                        $lastMonth2,$lastMonth,$currentMonth],
                ],
            ])
            ->options([]);

        $companies_biddings = biddings::whereHas('trader', function ($query){
            $query->where('type','=','company');
        } )->count();

        $banks_biddings = biddings::whereHas('trader', function ($query){
            $query->where('type','=','bank');
        } )->count();

        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 350, 'height' => 200])
            ->labels([ 'مزادات البنوك','مزادات الشركات'])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214'],
                    'data' => [$banks_biddings,$companies_biddings]
                ]
            ])
            ->options([]);
        return view('admin.statistics', compact('chartjs','chartjs_2'));
    }

    public function getCurrentMonth()
    {
        $date = Carbon::now();
        $lastMonth =  $date->format('F'); // November
        return $lastMonth;
    }
    public function getLastMonth()
    {
        $date = Carbon::now();
        $lastMonth =  $date->subMonth()->format('F'); // November
        return $lastMonth;
    }
    public function getLastMonth2()
    {
        $date = Carbon::now();
        $lastMonth =  $date->subMonth(2)->format('F'); // November
        return $lastMonth;
    }
    public function getLastMonth3()
    {
        $date = Carbon::now();
        $lastMonth =  $date->subMonth(3)->format('F'); // November
        return $lastMonth;
    }
    public function getLastMonth4()
    {
        $date = Carbon::now();
        $lastMonth =  $date->subMonth(4)->format('F'); // November
        return $lastMonth;
    }
    public function getLastMonth5()
    {
        $date = Carbon::now();
        $lastMonth =  $date->subMonth(5)->format('F'); // November
        return $lastMonth;
    }
}
