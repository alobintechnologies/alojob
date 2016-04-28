<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use AccountUtil;
use Auth;
use App\Ticket;
use App\Project;
use Illuminate\Http\Request;

class TicketController extends Controller {

	/**
	 * @var App\Project
	 */
	protected $project;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($projectId)
	{
		$this->setCurrentProject($projectId);

		$tickets = $this->project->tickets()->with('ticket_category', 'assigned_user')->orderBy('title', 'asc')->paginate(10);

		return view('tickets.index', compact('tickets'))->with('project', $this->project);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($projectId, Request $request)
	{
		$this->setCurrentProject($projectId);

		return view('tickets.create')
						->with($this->getEditViewModel())
						->with('project', $this->project);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store($projectId, Request $request)
	{
		$validator = Validator::make($request->all(), [
			'title' => 'required'
		]);
		if($validator->fails()) {
			return back()
								->withErrors($validator)
								->withInput();
		}

		$this->setCurrentProject($projectId);
		$ticket = new Ticket();

		$ticket->title = $request->input("title");
    $ticket->description = $request->input("description");
		$ticket->user_id = Auth::user()->id;
		$ticket->priority_id = $request->input('priority_id', 1);
		$ticket->assigned_user_id = $request->input("assigned_user_id");
		$ticket->ticket_category_id = $request->input("ticket_category_id");

		$this->project->tickets()->save($ticket);

		return redirect()->route('tickets.index')->with('message', 'Ticket created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($projectId, $id, Request $request)
	{
		$this->setCurrentProject($projectId);
		$ticket = $this->project->tickets()->with('ticket_category', 'assigned_user', 'user')->findOrFail($id);

		return view('tickets.show', compact('ticket'))
									->with('project', $this->project);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($projectId, $id)
	{
		$this->setCurrentProject($projectId);
		$ticket = $this->project->tickets()->with('ticket_category', 'assigned_user')->findOrFail($id);

		return view('tickets.edit', compact('ticket'))
										->with($this->getEditViewModel())
										->with('project', $this->project);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($projectId, Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'title' => 'required'
		]);
		if($validator->fails()) {
			return back()
								->withErrors($validator)
								->withInput();
		}
		$this->setCurrentProject($projectId);
		$ticket = $this->project->tickets()->findOrFail($id);

		$ticket->title = $request->input("title");
    $ticket->description = $request->input("description");
		$ticket->user_id = Auth::user()->id;
		$ticket->priority_id = $request->input('priority_id', $ticket->priority_id);

		/*$client_id = $request->input('client_id');
		if(is_numeric($client_id)) {
			$ticket->client_id = $client_id;
		}*/
		$ticket_status = $request->input('ticket_status');
		if(is_numeric($ticket_status)) {
			$ticket->ticket_status = $ticket_status;
		}
		$ticket->ticket_status = $request->input('ticket_status');
		$ticket->assigned_user_id = $request->input("assigned_user_id");
		$ticket->ticket_category_id = $request->input("ticket_category_id");

		$ticket->save();

		return redirect()->route('tickets.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($projectId, $id)
	{
		$this->setCurrentProject($projectId);
		$ticket = $this->project->tickets()->findOrFail($id);
		$ticket->delete();

		return redirect()->route('tickets.index')->with('message', 'Item deleted successfully.');
	}

	protected function getEditViewModel()
	{
			$ticket_categories = AccountUtil::current()->ticket_categories()->get();
			$assignees = AccountUtil::current()->memberships()->with('user')->get();

			return [
				'ticket_categories' => $ticket_categories,
				'assignees' => $assignees
			];
	}

	public function setCurrentProject($projectId)
	{
			$this->project = AccountUtil::current()->projects()->findOrFail($projectId);
			if(!$this->project) {
				return App::abort(404, 'Project not found');
			}
	}

	public function currentTickets($projectId = false)
	{
			return AccountUtil::current()->tickets()->where('project_id', $projectId);
	}

}
