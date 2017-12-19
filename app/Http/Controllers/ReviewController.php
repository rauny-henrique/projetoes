<?php namespace App\Http\Controllers;

use App\Game;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller {

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
		$reviews = Review::orderBy('id', 'desc')->paginate(10);

		return view('reviews.index', compact('reviews'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $games = Game::all()->pluck('nome','id');

		return view('reviews.create', compact('games'));
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
            'descricao' => 'required',
            'nota' => 'required',
            'game_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

		$review = new Review();

		$review->user_id = $request->input("user_id");
        $review->game_id = $request->input("game_id");
        $review->descricao = $request->input("descricao");
        $review->nota = $request->input("nota");

		$review->save();

		return redirect()->route('reviews.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$review = Review::findOrFail($id);

		return view('reviews.show', compact('review'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$review = Review::findOrFail($id);

        $games = Game::all()->pluck('nome','id');

		return view('reviews.edit', compact('review', 'games'));
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
            'descricao' => 'required',
            'nota' => 'required',
            'game_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

		$review = Review::findOrFail($id);

		$review->user_id = $request->input("user_id");
        $review->game_id = $request->input("game_id");
        $review->descricao = $request->input("descricao");
        $review->nota = $request->input("nota");

		$review->save();

		return redirect()->route('reviews.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$review = Review::findOrFail($id);
		$review->delete();

		return redirect()->route('reviews.index')->with('message', 'Item deleted successfully.');
	}

}
