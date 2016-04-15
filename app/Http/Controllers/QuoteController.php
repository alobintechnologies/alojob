<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Quote;
use Illuminate\Http\Request;
use AccountUtil;

class QuoteController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$quotes = $this->currentQuotes()->orderBy('id', 'desc')->paginate(10);

		return view('quotes.index', compact('quotes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		$project_id = $request->input('project_number');
		$project = null;
		if(is_numeric($project_id)) {
				$project = AccountUtil::current()->projects()->findOrFail($project_id);
				if(!$project) {
					dd($project);
					$request->session()->flash('error', 'Project does not exists to add ticket');
					return back();
				}
		}
		return view('quotes.create')
								->with(compact('project'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$quote = new Quote();

		$quote->title = $request->input("title");

		$this->currentQuotes()->save($quote);

		return redirect()->route('quotes.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$quote = $this->currentQuotes()->findOrFail($id);

		return view('quotes.show', compact('quote'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$quote = $this->currentQuotes()->findOrFail($id);

		return view('quotes.edit', compact('quote'));
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
		$quote = $this->currentQuotes()->findOrFail($id);

		$quote->title = $request->input("title");

		$quote->save();

		return redirect()->route('quotes.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$quote = $this->currentQuotes()->findOrFail($id);
		$quote->delete();

		return redirect()->route('quotes.index')->with('message', 'Item deleted successfully.');
	}

	protected function currentQuotes()
	{
			return AccountUtil::current()->quotes();
	}

}
