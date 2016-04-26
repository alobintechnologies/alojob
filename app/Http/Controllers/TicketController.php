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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Project $project)
	{
		$tickets = $project->tickets()->with('ticket_category', 'assigned_user', 'project')->orderBy('title', 'asc')->paginate(10);

		return view('tickets.index', compact('tickets'))->with('project', $project);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Project $project, Request $request)
	{
		return view('tickets.create')
						->with($this->getEditViewModel())
						->with('project', $project);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Project $project, Request $request)
	{
		$validator = Validator::make($request->all(), [
			'title' => 'required'
		]);
		if($validator->fails()) {
			return back()
								->withErrors($validator)
								->withInput();
		}
		$ticket = new Ticket();

		$ticket->title = $request->input("title");
    $ticket->description = $request->input("description");
		$ticket->user_id = Auth::user()->id;
		$ticket->priority_id = $request->input('priority_id', 1);
		$ticket->assigned_user_id = $request->input("assigned_user_id");
		$ticket->ticket_category_id = $request->input("ticket_category_id");

		$project->tickets()->save($ticket);

		return redirect()->route('tickets.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Project $project, $id, Request $request)
	{
		$ticket = $project->tickets()->with('ticket_category', 'assigned_user', 'user')->findOrFail($id);

		return view('tickets.show', compact('ticket'))
									->with($this->getShowViewModel($request))
									->with('project', $project);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Project $project, $id)
	{
		$ticket = $project->tickets()->with('ticket_category', 'assigned_user')->findOrFail($id);

		return view('tickets.edit', compact('ticket'))
										->with($this->getEditViewModel())
										->with('project', $project);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Project $project, Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'title' => 'required'
		]);
		if($validator->fails()) {
			return back()
								->withErrors($validator)
								->withInput();
		}
		$ticket = $project->tickets()->findOrFail($id);

		$ticket->title = $request->input("title");
    $ticket->description = $request->input("description");
		$ticket->user_id = Auth::user()->id;
		$ticket->priority_id = $request->input('priority_id', $ticket->priority_id);

		/*$client_id = $request->input('client_id');
		if(is_numeric($client_id)) {
			$ticket->client_id = $client_id;
		}*/
		$ticket->project_id = $project->id;
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
	public function destroy(Project $project, $id)
	{
		$ticket = $project->tickets()->findOrFail($id);
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

	protected function getShowViewModel(Request $request)
	{
			$client_number = $request->input("client_number");
			$client = null;
			if(is_numeric($client_number)) {
				$client = AccountUtil::current()->clients()->findOrFail($client_number);
			}

			return [
				'client' => $client
			];
	}

}
