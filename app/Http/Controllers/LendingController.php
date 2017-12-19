<?php namespace App\Http\Controllers;

use App\Friend;
use App\Game;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lending;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LendingController extends Controller {

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
		$lendings = Lending::orderBy('id', 'desc')->paginate(10);

		return view('lendings.index', compact('lendings'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    $friends = Friend::all()->pluck('nome', 'id');

        $games = Game::all()->pluck('nome', 'id');

		return view('lendings.create', compact('friends', 'games'));
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
            'data' => 'required',
            'friend_id' => 'required',
            'game_id' => 'required|unique:lendings',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

		$lending = new Lending();

		$lending->data = Carbon::createFromFormat('d/m/Y', $request->input("data"));
        $lending->friend_id = $request->input("friend_id");
        $lending->game_id = $request->input("game_id");

		$lending->save();

		return redirect()->route('lendings.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$lending = Lending::findOrFail($id);

		return view('lendings.show', compact('lending'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$lending = Lending::findOrFail($id);

        $friends = Friend::all()->pluck('nome', 'id');

        $games = Game::all()->pluck('nome', 'id');

		return view('lendings.edit', compact('lending', 'friends', 'games'));
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
            'data' => 'required',
            'friend_id' => 'required',
            'game_id' => 'required|unique:lendings',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

		$lending = Lending::findOrFail($id);

		$lending->data = Carbon::createFromFormat('d/m/Y', $request->input("data"));
        $lending->friend_id = $request->input("friend_id");
        $lending->game_id = $request->input("game_id");

		$lending->save();

		return redirect()->route('lendings.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$lending = Lending::findOrFail($id);
		$lending->delete();

		return redirect()->route('lendings.index')->with('message', 'Item deleted successfully.');
	}

}
