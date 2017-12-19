<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller {

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
		$invoices = Invoice::orderBy('id', 'desc')->paginate(10);

		return view('invoices.index', compact('invoices'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('invoices.create');
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
            'valor' => 'required',
            'data' => 'required',
            'descricao' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

		$invoice = new Invoice();

		$invoice->valor = $request->input("valor");
        $invoice->data = Carbon::createFromFormat('d/m/Y', $request->input("data"));
        $invoice->codigo = $request->input("codigo");
        $invoice->descricao = $request->input("descricao");

		$invoice->save();

		return redirect()->route('invoices.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$invoice = Invoice::findOrFail($id);

		return view('invoices.show', compact('invoice'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$invoice = Invoice::findOrFail($id);

		return view('invoices.edit', compact('invoice'));
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
            'valor' => 'required',
            'data' => 'required',
            'descricao' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

		$invoice = Invoice::findOrFail($id);

		$invoice->valor = $request->input("valor");
        $invoice->data = Carbon::createFromFormat('d/m/Y', $request->input("data"));
        $invoice->descricao = $request->input("descricao");

		$invoice->save();

		return redirect()->route('invoices.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$invoice = Invoice::findOrFail($id);
		$invoice->delete();

		return redirect()->route('invoices.index')->with('message', 'Item deleted successfully.');
	}

}
