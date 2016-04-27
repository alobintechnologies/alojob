<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Project;
use App\Client;
use Illuminate\Http\Request;
use Auth;
use AccountUtil;

class ProjectController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Client $client)
	{
			$projects = $client->projects()->orderBy('title', 'asc')->paginate(10);

			return view('projects.index', compact('projects'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Client $client, Request $request)
	{
			return view('projects.create')
								->with('client', $client);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Client $client, Request $request)
	{
			$format = $request->input('format', 'html');
			$validator = Validator::make($request->all(), [
				'title' => 'required'
			]);
			if($validator->fails()) {
					if($format == 'json') {
						 return Response::json(['result' => 'failure', 'errors' => $validator->errors()]);
					}
				  return back()
				 					->withErrors($validator)
									->withInput();
			}
			$project = new Project();

			$project->title = $request->input("title");
	    $project->description = $request->input("description");
			$project->user_id = Auth::user()->id;
			$project->project_type = $request->input('project_type');

			$client->projects()->save($project);

			if($format == 'json') {
					return Response::json(['result' => 'success', 'project' => $project]);
			}
			return redirect()->route('projects.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Client $client, $id)
	{
		$project = $client->projects()->with('tickets', 'client')->findOrFail($id);

		return view('projects.show', compact('project'))
						->with('client', $client);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Client $client, $id)
	{
		$project = $client->projects()->findOrFail($id);

		return view('projects.edit', compact('project'))
						->with('client', $client);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Client $client, Request $request, $id)
	{
			$validator = Validator::make($request->all(), [
					'title' => 'required'
			]);
			if($validator->fails()) {
					return back()
									->withErrors($validator)
									->withInput();
			}
			$project = $client->projects()->findOrFail($id);

			$project->title = $request->input("title");
	    $project->description = $request->input("description");
			$project->user_id = Auth::user()->id;
			$project->project_type = $request->input('project_type');

			$client->projects()->save($project);

			return redirect()->route('projects.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Client $client, $id)
	{
		$client->projetcs()->findOrFail($id)->delete();

		return redirect()->route('projects.index')->with('message', 'Item deleted successfully.');
	}

	/**
	 * Filter the project with title for autocomplete display
	 */
	public function filter(Request $request)
	{
			$term = $request->input("term");
			return $this->currentProjects()->where('title', 'like', "%$term%")->get();
	}

	public function currentProjects()
	{
			return AccountUtil::current()->projects();
	}

}
