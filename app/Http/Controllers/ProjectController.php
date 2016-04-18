<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Project;
use Illuminate\Http\Request;
use Auth;
use AccountUtil;

class ProjectController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
			$projects = $this->currentProjects()->orderBy('title', 'desc')->paginate(10);

			return view('projects.index', compact('projects'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
			$client_id = $request->input('client_number');
			$client = null;
			if(is_numeric($client_id)) {
					$client = AccountUtil::current()->clients()->findOrFail($client_id);
					if(!$client) {
							$request->session()->flash('error', 'Client does not exists to add project');
							return back();
					}
			}
			return view('projects.create')
								->with('client', $client);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
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
			$project->client_id = $request->input('client_id');

			$this->currentProjects()->save($project);

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
	public function show($id)
	{
		$project = $this->currentProjects()->with('tickets')->findOrFail($id);

		return view('projects.show', compact('project'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$project = $this->currentProjects()->with('client')->findOrFail($id);

		return view('projects.edit', compact('project'));
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
					'title' => 'required'
			]);
			if($validator->fails()) {
					return back()
									->withErrors($validator)
									->withInput();
			}
			$project = $this->currentProjects()->findOrFail($id);

			$project->title = $request->input("title");
	    $project->description = $request->input("description");
			$project->user_id = Auth::user()->id;
			$project->project_type = $request->input('project_type');
			$project->client_id = $request->input('client_id');

			$project->save();

			return redirect()->route('projects.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$project = $this->currentProjects()->findOrFail($id);
		$project->delete();

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
