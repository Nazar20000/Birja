<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ClientContriller extends Controller
{
    /**
     * Отображает страницу всех исполнителей (фрилансеров) с их услугами.
     */
    public function client()
    {
        $services = \App\Models\Service::with(['user', 'likes'])->withCount('likes')->get();
    
        // Считаем просмотры
        $viewed = session()->get('viewed_services', []);
        foreach ($services as $service) {
            if (!in_array($service->id, $viewed)) {
                $service->increment('views');
                $viewed[] = $service->id;
            }
        }
        session()->put('viewed_services', $viewed);
    
        return view('client.work.client', compact('services'));
    }
    

    /**
     * Страница отклика клиентом на фрилансера.
     */
    public function respond($id)
    {
        $freelancer = User::with('services')->findOrFail($id);
        return view('client.respond', compact('freelancer'));
    }
}
