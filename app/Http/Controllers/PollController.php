<?php

namespace App\Http\Controllers;

use App\Poll;
use App\HTTP\Resources\Poll as PollResource;
use Illuminate\Http\Request;
use Validator;


class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return response()->json(Poll::all(), 200);
        return response()->json(Poll::paginate(1), 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = [
            'title' => 'required|max:10',
        ];
        $validation = Validator::make($request->all(), $rule);
        if($validation->fails()){
            return response()->json($validation->errors(), 400); 
        }
        $poll = Poll::create($request->all());
        return response()->json($poll, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $poll = Poll::with('question')->findOrFail($id);
        // if(is_null($poll)){
        //     return response()->json(null,404);
        // }
        // return response()->json(Poll::findOrFail($id), 200);
        // $poll = Poll::with('question')->findOrFail($id);
        $response['poll'] = $poll;
        $response['question'] = $poll->question;
        // $response = new PollResource($poll, 200);
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll)
    {
        $poll->update($request->all());
        return response()->json($poll, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        $poll->delete();
        return response()->json(null, 204);
    }

    public function errors()
    {
        return response()->json(['msg'=>'Payment required'], 501);
    }

    public function question(Request $request, Poll $poll)
    {
        $questions = $poll->question;
        return response()->json($questions, 200);
    }

}
