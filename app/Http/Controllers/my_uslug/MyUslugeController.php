<?php

namespace App\Http\Controllers\my_uslug;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class MyUslugeController extends Controller
{
    public function show($id)
    {
        $service = Service::with('user')->findOrFail($id);
        return view('freelancer.my_uslug.show_usluge.show', compact('service'));
    }
    public function usluge(Request $request)
    {
        $query = Auth::user()->services();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%$search%");
        }

        if ($sort = $request->input('sort')) {
            $query->orderBy('price', $sort === 'price_asc' ? 'asc' : 'desc');
        }

        $services = $query->paginate(10);

        // Увеличиваем просмотры, если пользователь не видел услугу ранее (через сессию)
        foreach ($services as $service) {
            $viewed = session()->get('viewed_services', []);

            if (!in_array($service->id, $viewed)) {
                $service->increment('views');
                session()->put('viewed_services', array_merge($viewed, [$service->id]));
            }
        }

        return view('freelancer.my_uslug.usluge', compact('services'));
    }

    public function stats()
    {
        $user = Auth()->user();

        $totalIncome = $user->services()->sum('price');
        $serviceCount = $user->services()->count();
        $popularServices = $user->services()->orderByDesc('price')->limit(5)->get();

        return view('freelancer.my_uslug.stats', compact('totalIncome', 'serviceCount', 'popularServices'));
    }

    public function create()
    {
        return view('freelancer.my_uslug.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        auth()->user()->services()->create($validated);

        return redirect()->route('usluge')->with('success', 'Услуга успешно добавлена!');
    }

    public function edit($id)
    {
        $service = auth()->user()->services()->findOrFail($id);

        return view('freelancer.my_uslug.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $service = auth()->user()->services()->findOrFail($id);
        $service->update($validated);

        return redirect()->route('usluge')->with('success', 'Услуга успешно обновлена.');
    }

    public function destroy($id)
    {
        auth()->user()->services()->findOrFail($id)->delete();

        return redirect()->route('usluge')->with('success', 'Услуга успешно удалена.');
    }

    public function like($id)
    {
        $user = auth()->user();
        $service = Service::findOrFail($id);

        $existingLike = Like::where('user_id', $user->id)
            ->where('service_id', $service->id)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            $service->decrement('likes');
        } else {
            Like::create([
                'user_id' => $user->id,
                'service_id' => $service->id
            ]);
            $service->increment('likes');
        }

        $likes = $service->likes;

        return response()->json(['likes' => $likes]);
    }
}
