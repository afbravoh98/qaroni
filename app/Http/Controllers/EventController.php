<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventOrderRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Jobs\SendOrderNotification;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|View
     */
    public function index(Request $request)
    {
        $lang = in_array($request->get('language'), Config::get('constants.default_languages')) ? $request->get('language') : 'es';

        $events = Event::query()
            ->with(['description' => function ($query) use ($lang) {
                $query->where('language', $lang);
                }, 'category'])->get();

        $categories = Category::query()
            ->with(['description' => function ($query) use ($lang) {
                $query->where('language', $lang);
            }])->get();

        return view('events.index', ['events' => $events, 'lang' => $lang, 'categories' => $categories]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEventRequest $request
     * @return RedirectResponse
     */
    public function store(StoreEventRequest $request): RedirectResponse
    {
        $data = $request->validated();

        /** @var Event $event*/
        $event = Event::query()->create([
            'date' => $data['date'],
            'slug' => Str::random(10),
            'capacity' => $data['capacity'],
            'categoryId' => $data['categoryId'],
        ]);

        foreach (Config::get('constants.default_languages') as $language){
            $event->description()->create([
                'name' => $data["name_$language"],
                'language' => $language,
            ]);
        }

        Alert::success('Éxito!', 'Evento Creado Correctamente');

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param $slug
     * @return Application|Factory|View
     */
    public function edit(Request $request, $slug)
    {
        $lang = in_array($request->get('language'), Config::get('constants.default_languages')) ? $request->get('language') : 'es';

        $event = Event::query()->where('slug', $slug)->firstOrFail();

        $categories = Category::query()
            ->with(['description' => function ($query) use ($lang) {
                $query->where('language', $lang);
            }])->get();

        return view('events.edit', ['event' => $event, 'categories' => $categories, 'lang' => $lang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEventRequest $request
     * @param $slug
     * @return string
     */
    public function update(UpdateEventRequest $request, $slug): string
    {
        $data = $request->validated();
       /**@var Event $event*/
        $event = Event::query()->where('slug', $slug)->firstOrFail();

        $event->update([
            'date' => $data['date'],
            'capacity' => $data['capacity'],
            'categoryId' => $data['categoryId'],
        ]);

        foreach (Config::get('constants.default_languages') as $language){
            $description = $event->translation($language);
            if ($description) {
                $description->update(['name' => $data["name_$language"]]);
            }
        }

        Alert::success('Éxito!', 'Evento Actualizado Correctamente');

        return redirect('events');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $slug
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy($slug)
    {
        /**@var Event $event*/
        $event = Event::query()->where('slug', $slug)->firstOrFail();
        $event->description()->delete();

        $event->delete();

        Alert::success('Éxito!', 'Evento Eliminado Correctamente');
        return redirect('events');
    }

    public function order(StoreEventOrderRequest $request, $slug): RedirectResponse
    {
        /**@var Event $event*/
        $event = Event::query()->where('slug', $slug)->firstOrFail();
        $data = $request->validated();

        $available = $event->capacity - $event->orders->sum('quantity');

        if ($data['quantity'] > $available) {
            Alert::warning('Ups!', "Solamente quedan $available tickets disponibles");
            return  redirect()->back();
        }

        $order = $event->orders()->create([
            'buy_at' => now(),
            'email' => $data['email'],
            'quantity' => $data['quantity'],
        ]);

        dispatch(new SendOrderNotification($data['email'], $event, $order));

        Alert::success('Éxito!', 'Evento reservado Correctamente');

        return redirect()->back();
    }
}
