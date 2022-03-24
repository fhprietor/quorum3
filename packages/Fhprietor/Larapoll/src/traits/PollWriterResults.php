<?php
namespace Inani\Larapoll\Traits;


use Inani\Larapoll\Poll;

trait PollWriterResults
{
    /**
     * Draw the results of voting
     *
     * @param Poll $poll
     */
    public function drawResult(Poll $poll)
    {
        $total = $poll->votes->sum('weight')/10000;
        $users = $poll->votes->unique('user_id')->count('user_id');
        $seats = $poll->seats;
        $quorum = $poll->quorum;
        $quotient = 0;
        // $total = $poll->votes->count();
        $results = $poll->results()->grab();
        if($poll->seats > 0) {
            $quotient = $total / $seats;
            if ($quotient == 0) {
                $quotient = 1;
            }

            $options = collect($results)->map(function ($result) use ($total,$quotient) {
                return (object)[
                    'votes' => $result['votes']/10000,
                    'percent' => $total === 0 ? 0 : ($result['votes']/10000 / $total) * 100,
                    'name' => $result['option']->name,
                    'seatsbyquotient'=> floor($result['votes']/10000 / $quotient ),
                    'residue' => $result['votes']/10000 / $quotient - floor($result['votes']/10000 / $quotient),
                ];
            });
        }
        else {
            $options = collect($results)->map(function ($result) use ($total) {
                return (object)[
                    'votes' => $result['votes']/10000,
                    'percent' => $total === 0 ? 0 : round(($result['votes']/10000 / $total * 100 ) ,2),
                    'name' => $result['option']->name,
                ];
            })->sortByDesc('votes');
        }
        $question = $poll->question;

        echo view(config('larapoll_config.results') ? config('larapoll_config.results') : 'larapoll::stubs.results',
            compact('options', 'question', 'total', 'seats', 'quotient','quorum','users'));
    }
}
