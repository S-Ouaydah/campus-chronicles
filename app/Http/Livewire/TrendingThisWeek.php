<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Episode;
use Livewire\Wire;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TrendingThisWeek extends Component
{
    
    public function render()
    {
        $lastWeek = Carbon::now()->subWeek();

        $trendingEps = Episode::select('episodes.*', 'listen_counts.listen_count')
        ->leftJoinSub(
            function ($query) use ($lastWeek) {
                $query->select('episode_id', DB::raw('COUNT(*) as listen_count'))
                    ->from('listens')
                    ->where('created_at', '>', $lastWeek)
                    ->groupBy('episode_id');
            },
            'listen_counts',
            'episodes.id',
            '=',
            'listen_counts.episode_id'
        )
        ->where('listen_counts.listen_count', '>', 0) // Exclude episodes with zero listens
        ->orderByDesc('listen_counts.listen_count')
        ->limit(5)
        ->get();

        return view('livewire.trending-this-week',[

            "trendingEps" => $trendingEps,
        ]);
    }
}
