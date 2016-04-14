<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use AccountUtil;
use Auth;
use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tickets = $this->currentTickets()->with('ticket_category', 'assigned_user')->orderBy('title', 'asc')->paginate(10);

		return view('tickets.index', compact('tickets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$project_id = $request->input('project_number');
		$project = null;
		if(is_numeric($project_id)) {
				$project = AccountUtil::current()->projects()->findOrFail($project_id);
				if(!$project) {
						$request->session()->flash('error', 'Project does not exists to add ticket');
						return back();
				}
		}
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
	public function store(Request $request)
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

		$client_id = $request->input('client_id');
		if(is_numeric($client_id)) {
			$ticket->client_id = $client_id;
		}
		$project_id = $request->input('project_id');
		if(is_numeric($project_id)) {
			$ticket->project_id = $project_id;
		}
		$ticket->assigned_user_id = $request->input("assigned_user_id");
		$ticket->ticket_category_id = $request->input("ticket_category_id");

		$this->currentTickets()->save($ticket);

		return redirect()->route('tickets.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ticket = $this->currentTickets()->with('ticket_category', 'client', 'project', 'assigned_user')->findOrFail($id);

		return view('tickets.show', compact('ticket'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ticket = $this->currentTickets()->with('ticket_category', 'client', 'project', 'assigned_user')->findOrFail($id);

		return view('tickets.edit', compact('ticket'))->with($this->getEditViewModel());;
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
		$ticket = $this->currentTickets()->findOrFail($id);

		$ticket->title = $request->input("title");
    $ticket->description = $request->input("description");
		$ticket->user_id = Auth::user()->id;

		$client_id = $request->input('client_id');
		if(is_numeric($client_id)) {
			$ticket->client_id = $client_id;
		}
		$project_id = $request->input('project_id');
		if(is_numeric($project_id)) {
			$ticket->project_id = $project_id;
		}
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
	public function destroy($id)
	{
		$ticket = $this->currentTickets()->findOrFail($id);
		$ticket->delete();

		return redirect()->route('tickets.index')->with('message', 'Item deleted successfully.');
	}

	public function currentTickets()
	{
			return AccountUtil::current()->tickets();
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

}
