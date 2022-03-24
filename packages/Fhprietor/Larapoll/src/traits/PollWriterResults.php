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
                    'votes' => $result['votes'],
                    'percent' => $total === 0 ? 0 : ($result['votes'] / $total) * 100,
                    'name' => $result['option']->name,
                    'seatsbyquotient'=> floor($result['votes'] / $quotient ),
                    'residue' => $result['votes'] / $quotient - floor($result['votes'] / $quotient),
                ];
            });
        }
        else {
            $options = collect($results)->map(function ($result) use ($total) {
                return (object)[
                    'votes' => $result['votes']/10000,
                    'percent' => $total === 0 ? 0 : round(($result['votes']/10000 / $total),4),
                    'name' => $result['option']->name,
                ];
            })->sortByDesc('votes');
        }
        $question = $poll->question;

        echo view(config('larapoll_config.results') ? config('larapoll_config.results') : 'larapoll::stubs.results',
            compact('options', 'question', 'total', 'seats', 'quotient','quorum','users'));
    }
}
