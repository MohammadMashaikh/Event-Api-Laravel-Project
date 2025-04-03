<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 
use Illuminate\Routing\Controller;
use App\Http\Resources\AttendeeResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AttendeeController extends Controller
{
    use AuthorizesRequests, CanLoadRelationships;

    private array $relations = ['user'];


    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show', 'update');
        $this->middleware('throttle:60,1')->only(['store', 'destroy']);
        $this->authorizeResource(Attendee::class, 'attendee');
        
        
    }

    public function index(Event $event)
    {
        $attendees = $this->loadRelationships(
            $event->attendees()->latest()
        );

        return AttendeeResource::collection(
            $attendees->paginate()
        );
    }

    public function store(Request $request, Event $event)
    {
        $attendee = $this->loadRelationships(
            $event->attendees()->create([
                'user_id' => $request->user()->id
            ])
        );

        return new AttendeeResource($attendee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Attendee $attendee)
    {
        return new AttendeeResource(
            $this->loadRelationships($attendee)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event, Attendee $attendee)
    {
        // if (Gate::denies('delete-attendee', [$event, $attendee]))
        // {
        //     abort(403, 'You are not Authorized to delete this Action');
        // }

        $attendee->delete();
        return response(status: 204);
    }
}