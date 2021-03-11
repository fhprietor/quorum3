<?php

namespace Inani\Larapoll\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inani\Larapoll\Helpers\PollHandler;
use Inani\Larapoll\Http\Request\PollCreationRequest;
use Inani\Larapoll\Poll;
use Inani\Larapoll\Exceptions\DuplicatedOptionsException;

class PollManagerController extends Controller
{
    /**
     * Dashboard Home
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        return view('larapoll::dashboard.home');
    }
    /**
     * Show all the Polls in the database
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $polls = Poll::withCount('options', 'votes')->latest()->paginate(
            config('larapoll_config.pagination')
        );
        return view('larapoll::dashboard.index', compact('polls'));
    }

    /**
     * Store the Request
     *
     * @param PollCreationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Inani\Larapoll\Exceptions\CheckedOptionsException
     * @throws \Inani\Larapoll\Exceptions\OptionsInvalidNumberProvidedException
     * @throws \Inani\Larapoll\Exceptions\OptionsNotProvidedException
     */
    public function store(PollCreationRequest $request)
    {
        try {
            PollHandler::createFromRequest($request->all());
        } catch (DuplicatedOptionsException $exception) {
            return redirect(route('poll.create'))
                ->withInput($request->all())
                ->with('danger', $exception->getMessage());
        }

        return redirect(route('poll.index'))
            ->with('success', 'Pregunta agregada');
    }

    /**
     * Show the poll to be prepared to edit
     *
     * @param Poll $poll
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Poll $poll)
    {
        return view('larapoll::dashboard.edit', compact('poll'));
    }

    /**
     * Update the Poll
     *
     * @param Poll $poll
     * @param PollCreationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Poll $poll, PollCreationRequest $request)
    {
        PollHandler::modify($poll, $request->all());
        return redirect(route('poll.index'))
            ->with('success', 'Su pregunta ha sido actualizada');
    }

    /**
     * Delete a Poll
     *
     * @param Poll $poll
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Poll $poll)
    {
        $poll->remove();

        return redirect(route('poll.index'))
            ->with('success', 'Su pregunta se ha borrado');
    }
    public function create()
    {
        return view('larapoll::dashboard.create');
    }

    /**
     * Lock a Poll
     *
     * @param Poll $poll
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lock(Poll $poll)
    {
        $poll->lock();
        return redirect(route('poll.index'))
            ->with('success', 'Pregunta bloqueada');
    }

    /**
     * Unlock a Poll
     *
     * @param Poll $poll
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlock(Poll $poll)
    {
        $poll->unLock();
        return redirect(route('poll.index'))
            ->with('success', 'Pregunta desbloqueada');
    }
    /**
     * Show all the Polls in the database
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lists()
    {
        $polls = Poll::withCount('options', 'votes')->latest()->paginate(
            config('larapoll_config.pagination')
        );
        return view('larapoll::dashboard.lists', compact('polls'));
    }
    /**
     * Show the poll to be voted
     *
     * @param Poll $poll
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function vote(Poll $poll)
    {
        return view('larapoll::dashboard.votar', compact('poll'));
    }

    public function view(Poll $poll)
    {
        return view('larapoll::dashboard.view', compact('poll'));
    }
}
