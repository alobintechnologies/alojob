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
	 * App\Client
	 */
	protected $client;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($clientId)
	{
			$this->setCurrentClient($clientId);
			$projects = $this->client->projects()->orderBy('title', 'asc')->paginate(10);

			return view('projects.index', compact('projects'))
									->with('client', $this->client);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($clientId, Request $request)
	{
			$this->setCurrentClient($clientId);
			return view('projects.create')
								->with('client', $this->client);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store($clientId, Request $request)
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
			$this->setCurrentClient($clientId);

			$project->title = $request->input("title");
	    $project->description = $request->input("description");
			$project->user_id = Auth::user()->id;
			$project->project_type = $request->input('project_type');

			$this->client->projects()->save($project);

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
	public function show($clientId, $id)
	{
			$this->setCurrentClient($clientId);
			$project = $this->client->projects()->with('tickets')->findOrFail($id);

			return view('projects.show', compact('project'))
							->with('client', $this->client);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($clientId, $id)
	{
			$this->setCurrentClient($clientId);
			$project = $this->client->projects()->findOrFail($id);

			return view('projects.edit', compact('project'))
							->with('client', $this->client);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($clientId, Request $request, $id)
	{
			$validator = Validator::make($request->all(), [
					'title' => 'required'
			]);
			if($validator->fails()) {
					return back()
									->withErrors($validator)
									->withInput();
			}
			$this->setCurrentClient($clientId);
			$project = $this->client->projects()->findOrFail($id);

			$project->title = $request->input("title");
	    $project->description = $request->input("description");
			$project->user_id = Auth::user()->id;
			$project->project_type = $request->input('project_type');

			$project->save($project);

			return redirect()->route('projects.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($clientId, $id)
	{
			$this->setCurrentClient($clientId);
			$this->client->projects()->findOrFail($id)->delete();

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

	public function setCurrentClient($clientId)
	{
			$this->client = AccountUtil::current()->clients()->findOrFail($clientId);
			if(!$this->client) {
				return App::abort(404, 'Client not found');
			}
	}

	public function currentProjects($clientId = false)
	{
			return AccountUtil::current()->projects()->where('client_id', $clientId);
	}

}
