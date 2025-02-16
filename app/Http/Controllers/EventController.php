<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest()->paginate(15);
        $title = 'Event Data';
        $eventsCount = Event::count();
        $currentPage = $events->currentPage();
        $totalPages = $events->lastPage();
        $orderIn = 'created_at';
        $orderBy = 'desc';
        return view('panel.event.index', compact('title', 'events', 'eventsCount', 'currentPage', 'totalPages', 'orderBy', 'orderIn'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.event.create', [
            'title' => 'Create Event'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:events',
            'description' => 'required|string',
            'address' => 'required|string',
            'organizer' => 'required|string',
            'price' => 'required|integer',
            'event_date' => 'required',
            'layouts' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        $newEvent = new Event([
            'title' => $request->title,
            'description' => $request->description,
            'address' => $request->address,
            'organizer' => $request->organizer,
            'price' => $request->price,
            'event_date' => $request->event_date,
            'layouts' => $request->layouts,
            'thumbnail' => $request->file('thumbnail')->store('event_thumbnail', 'public'),
            'isTopPopular' => $request->isTopPopular ? true : false
        ]);

        $newEvent->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Successful create new event'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);

        return view('panel.event.edit', [
            'title' => 'Edit Event',
            'event' => $event,
            'layouts' => json_encode($event->layouts)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'address' => 'required',
            'organizer' => 'required',
            'price' => 'required|integer',
            'event_date' => 'required',
            'layouts' => 'required',
            'thumbnail' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        $event = Event::findOrFail($id);

        if ($request->title !== $event->title) {
            $request->validate([
                'title' => 'unique:events,title',
            ]);
            $event->title = $request->title;
        }

        $event['title'] = $request->title;
        $event['description'] = $request->description;
        $event['address'] = $request->address;
        $event['organizer'] = $request->organizer;
        $event['price'] = $request->price;
        $event['layouts'] = $request->layouts;
        $event['event_date'] = $request->event_date;
        $event['isTopPopular'] = (!is_null($request->isTopPopular)) ? true : false;


        if (!is_null($request->thumbnail)) {
            if (Storage::disk('public')->exists($event->thumbnail)) {
                Storage::disk('public')->delete($event->thumbnail);
            }
            $event['thumbnail'] = $request->file('thumbnail')->store('event_thumbnail', 'public');
        }

        $event->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Successful updated event'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);

        $event->delete();

        return back()->with([
            'status' => 'success',
            'message' => 'Successful deleted event'
        ]);
    }

    public function deleteSelected(Request $request)
    {
        $eventIds = $request->input('event_ids');
        if ($eventIds) {
            $events = Event::whereIn('id', $eventIds)->get();

            foreach ($events as $event) {
                if (Storage::disk('public')->exists($event->thumbnail)) {
                    Storage::disk('public')->delete($event->thumbnail);
                }
            }

            Event::whereIn('id', $eventIds)->delete();

            return back()->with([
                'status' => 'success',
                'message' => "Successfully deleted events"
            ]);
        }

        return back()->with([
            'status' => 'success',
            'message' => "No events selected for deletiion"
        ]);
    }

    public function search(Request $request)
    {
        $orderIn = $request->query('orderIn') ? $request->query('orderIn') : 'created_at';
        $orderBy = $request->query('orderBy') ? $request->query('orderBy') : 'desc';
        $search = $request->query('search') ? $request->query('search') : '';

        // Query dasar untuk pengguna dengan kriteria pencarian
        $query = Event::when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('organizer', 'like', '%' . $search . '%')
                    ->orWhere('price', 'like', '%' . $search . '%')
                    ->orWhere('event_date', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhere('updated_at', 'like', '%' . $search . '%');
            });
        });

        // Hitung total pengguna yang sesuai dengan kriteria pencarian
        $eventsCount = $query->count();
        // Dapatkan pengguna dengan pagination
        $events = $query->orderBy($orderIn, $orderBy)->paginate(15);
        $currentPage = $events->currentPage();
        $totalPages = $events->lastPage();
        return view('partials.events-table', compact('events', 'eventsCount', 'currentPage', 'totalPages', 'orderBy', 'orderIn'));
    }


    public function home()
    {
        $title = 'Homepage';
        $events = Event::latest()->paginate(8);
        $popularEvents = Event::where('isTopPopular', true)->get();
        $eventsCount = Event::count();
        $currentPage = $events->currentPage();
        $totalPages = $events->lastPage();
        return view('homepage', compact('title', 'events', 'popularEvents', 'eventsCount', 'currentPage', 'totalPages'));
    }

    public function publicSearch(Request $request)
    {
        $orderIn = $request->query('orderIn') ? $request->query('orderIn') : 'created_at';
        $orderBy = $request->query('orderBy') ? $request->query('orderBy') : 'desc';
        $search = $request->query('search') ? $request->query('search') : '';

        // Query dasar untuk pengguna dengan kriteria pencarian
        $query = Event::when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('organizer', 'like', '%' . $search . '%')
                    ->orWhere('price', 'like', '%' . $search . '%')
                    ->orWhere('event_date', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhere('updated_at', 'like', '%' . $search . '%');
            });
        });

        // Hitung total pengguna yang sesuai dengan kriteria pencarian
        $eventsCount = $query->count();
        // Dapatkan pengguna dengan pagination
        $events = $query->orderBy($orderIn, $orderBy)->paginate(15);
        $currentPage = $events->currentPage();
        $totalPages = $events->lastPage();
        return view('partials.events-list', compact('events', 'eventsCount', 'currentPage', 'totalPages', 'orderBy', 'orderIn'));
    }

    public function getEvent($title)
    {
        $event = Event::where('title', $title)->first();

        return $event;
    }
}
