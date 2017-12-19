<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FriendController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$friends = Friend::orderBy('id', 'desc')->paginate(10);

		return view('friends.index', compact('friends'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('friends.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
        $validator = Validator::make($request->all(), [
            'nome' => 'required|unique:friends|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

		$friend = new Friend();

		$friend->nome = $request->input("nome");
        $friend->user_id = $request->input("user_id");

		$friend->save();

		return redirect()->route('friends.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$friend = Friend::findOrFail($id);

		return view('friends.show', compact('friend'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$friend = Friend::findOrFail($id);

		return view('friends.edit', compact('friend'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        $validator = Validator::make($request->all(), [
            'nome' => 'required|unique:friends|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

		$friend = Friend::findOrFail($id);

		$friend->nome = $request->input("nome");
        $friend->user_id = $request->input("user_id");

		$friend->save();

		return redirect()->route('friends.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$friend = Friend::findOrFail($id);
		$friend->delete();

		return redirect()->route('friends.index')->with('message', 'Item deleted successfully.');
	}

}
