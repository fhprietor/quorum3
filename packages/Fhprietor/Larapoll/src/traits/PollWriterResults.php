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
        $total = $poll->votes->sum('weight')/100;
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
                    'votes' => $result['votes']*100,
                    'percent' => $total === 0 ? 0 : ($result['votes'] / $total) * 100,
                    'name' => $result['option']->name,
                    'seatsbyquotient'=> floor($result['votes'] / $quotient * 100),
                    'residue' => $result['votes'] / $quotient * 100 - floor($result['votes'] / $quotient * 100),
                ];
            });
        }
        else {
            $options = collect($results)->map(function ($result) use ($total) {
                return (object)[
                    'votes' => $result['votes'] * 100,
                    'percent' => $total === 0 ? 0 : round(($result['votes'] / $total) * 10000,2),
                    'name' => $result['option']->name,
                ];
            })->sortByDesc('votes');
        }
        $question = $poll->question;

        echo view(config('larapoll_config.results') ? config('larapoll_config.results') : 'larapoll::stubs.results',
            compact('options', 'question', 'total', 'seats', 'quotient','quorum','users'));
    }
}
