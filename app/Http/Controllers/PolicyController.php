<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Http\Requests\StorePolicyRequest;
use App\Http\Requests\UpdatePolicyRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $policies = Policy::all();
        return view('..pages.settings.policy', compact('policies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePolicyRequest  $request
     * @return Response
     */
    public function store(StorePolicyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Policy $policy
     * @return Response
     */
    public function show(Policy $policy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Policy $policy
     * @return Response
     */
    public function edit(Policy $policy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePolicyRequest $request
     * @param Policy $policy
     * @return RedirectResponse
     */
    public function update(UpdatePolicyRequest $request, Policy $policy): RedirectResponse
    {
        $input = $request->validate([
           'value' . $policy->id => 'required|integer|min:1|max:100'
        ]);

        try {
            $policy->update(['value' => $input['value' . $policy->id]]);
            $request->session()->flash('Polje je uspješno izmijenjeno.');

            return back();
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Policy $policy
     * @return Response
     */
    public function destroy(Policy $policy)
    {
        //
    }
}
