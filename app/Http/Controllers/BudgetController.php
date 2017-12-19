<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller {

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
		$budgets = Budget::orderBy('id', 'desc')->paginate(10);

		return view('budgets.index', compact('budgets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('budgets.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$budget = new Budget();

		$budget->valor = $request->input("valor");
        $budget->user_id = $request->input("user_id");

		$budget->save();

		return redirect()->route('budgets.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$budget = Budget::findOrFail($id);

		return view('budgets.show', compact('budget'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$budget = Budget::findOrFail($id);

		return view('budgets.edit', compact('budget'));
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
		$budget = Budget::findOrFail($id);

		$budget->valor = $request->input("valor");
        $budget->user_id = $request->input("user_id");

		$budget->save();

		return redirect()->route('budgets.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$budget = Budget::findOrFail($id);
		$budget->delete();

		return redirect()->route('budgets.index')->with('message', 'Item deleted successfully.');
	}

}
