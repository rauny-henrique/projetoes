<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller {

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
		$platforms = Platform::orderBy('id', 'desc')->paginate(10);

		return view('platforms.index', compact('platforms'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('platforms.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$platform = new Platform();

		$platform->nome = $request->input("nome");

		$platform->save();

		return redirect()->route('platforms.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$platform = Platform::findOrFail($id);

		return view('platforms.show', compact('platform'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$platform = Platform::findOrFail($id);

		return view('platforms.edit', compact('platform'));
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
		$platform = Platform::findOrFail($id);

		$platform->nome = $request->input("nome");

		$platform->save();

		return redirect()->route('platforms.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$platform = Platform::findOrFail($id);
		$platform->delete();

		return redirect()->route('platforms.index')->with('message', 'Item deleted successfully.');
	}

}
