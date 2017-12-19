<?php namespace App\Http\Controllers;

use App\Budget;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Game;
use App\Invoice;
use App\Platform;
use App\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller {

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
		$games = Game::orderBy('id', 'desc')->paginate(10);

        $zerado = Game::where('user_id', Auth::id())->where('status', 'zerado')->count();

        $pendente = Game::where('user_id', Auth::id())->where('status', 'pendente')->count();

        $jogando = Game::where('user_id', Auth::id())->where('status', 'jogando')->count();

		$orcamento = Budget::where('user_id', Auth::id())->first();

		$total = $zerado + $pendente + $jogando;

		return view('games.index', compact('games', 'orcamento', 'zerado', 'pendente', 'jogando', 'total'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    $categories = Category::all();

        $platforms = Platform::all();

        //dd($categories, $platforms);

		return view('games.create', compact('categories', 'platforms'));
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
            'nome' => 'required|unique:games|max:255',
            'platform_id' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'valor' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

		$game = new Game();

		$game->nome = $request->input("nome");
        $game->platform_id = $request->input("platform_id");
        $game->status = $request->input("status");
        $game->category_id = $request->input("category_id");
        $game->valor = $request->input("valor");
        $game->user_id = Auth::id();

		$game->save();

        $game_id = $game->id;

        $invoice = new Invoice();

        $invoice->valor = $request->input("valor");
        $invoice->data = Carbon::now();
        $invoice->codigo = random_int(0, 999999999);
        $invoice->descricao = "Nota fiscal para o jogo - ".$request->input("nome");
        $invoice->game_id = $game_id;

        $invoice->save();

        $budget = Budget::where('user_id', Auth::id())->first();

        if ($budget) {

            $budget->valor = DB::table('invoices')->sum('valor');

            $budget->save();

        } else {

            $orcamento = new Budget();

            $orcamento->user_id = Auth::id();

            $orcamento->valor = $request->input("valor");

            $orcamento->save();

        }

        return redirect()->route('games.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$game = Game::findOrFail($id);

        $reviews = Review::where('game_id', $game->id)->get();

		return view('games.show', compact('game', 'reviews'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $categories = Category::all()->pluck('nome','id');

        $platforms = Platform::all()->pluck('nome','id');

		$game = Game::findOrFail($id);

		return view('games.edit', compact('game', 'categories', 'platforms'));
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
		$game = Game::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'platform_id' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'valor' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

		$game->nome = $request->input("nome");
        $game->platform_id = $request->input("platform_id");
        $game->status = $request->input("status");
        $game->category_id = $request->input("category_id");
        $game->valor = $request->input("valor");

		$game->save();

        $invoice = Invoice::where('game_id', $id)->first();

        if ($invoice) {

            $invoice->valor = $request->input("valor");
            $invoice->descricao = "Nota fiscal para o jogo - ".$request->input("nome");

            $invoice->save();

        }

		return redirect()->route('games.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$game = Game::findOrFail($id);
		$game->delete();

		return redirect()->route('games.index')->with('message', 'Item deleted successfully.');
	}

}
