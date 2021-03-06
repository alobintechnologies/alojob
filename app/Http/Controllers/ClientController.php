<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$clients = Client::orderBy('id', 'desc')->paginate(10);

		return view('clients.index', compact('clients'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('clients.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$data = $request->all();

		$validator = Validator::make($data, [
			'first_name' => 'required',
			'company_name' => 'required',
			'primary_email' => 'required|email'
		]);

		if($validator->fails()) {
			return back()
						->withErrors($validator)
						->withInput();
		} else {
			$client = new Client();

			$client->title = $request->input("title");
			$client->first_name = $request->input("first_name");
			$client->last_name = $request->input("last_name");
			$client->company_name = $request->input("company_name");
			$client->primary_mobile = $request->input("primary_mobile");
			$client->secondary_mobile = $request->input("secondary_mobile");
			$client->primary_email = $request->input("primary_email");
			$client->secondary_email = $request->input("secondary_email");

			$client->save();

			return redirect()->route('clients.index')->with('message', 'Item created successfully.');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$client = Client::findOrFail($id);

		return view('clients.show', compact('client'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$client = Client::findOrFail($id);

		return view('clients.edit', compact('client'));
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
		$client = Client::findOrFail($id);

		$client->title = $request->input("title");
        $client->first_name = $request->input("first_name");
        $client->last_name = $request->input("last_name");
        $client->company_name = $request->input("company_name");
        $client->primary_mobile = $request->input("primary_mobile");
        $client->secondary_mobile = $request->input("secondary_mobile");
        $client->primary_email = $request->input("primary_email");
        $client->secondary_email = $request->input("secondary_email");

		$client->save();

		return redirect()->route('clients.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$client = Client::findOrFail($id);
		$client->delete();

		return redirect()->route('clients.index')->with('message', 'Item deleted successfully.');
	}

}
