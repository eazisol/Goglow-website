<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookAppointmentController extends Controller
{
    public function show(Request $request)
    {
        $serviceId = $request->query('serviceId');
        $serviceProviderId = $request->query('service_provider_id');
        $firebaseUid = session('firebase_uid');

        $selectedService = null;
        $selectedCategory = null;
        $agents = [];

        if ($serviceId) {
            try {
                $response = Http::get('https://us-central1-beauty-984c8.cloudfunctions.net/getServiceById', [
                    'service_id' => $serviceId,
                ]);

                if ($response->ok()) {
                    $json = $response->json();
                    // API returns keys: service, category, agents
                    $selectedService = $json['service'] ?? null;
                    $selectedCategory = $json['category'] ?? null;
                    $agents = $json['agents'] ?? [];
                }
            } catch (\Throwable $e) {
                // Silently ignore and render page without prefilled service
                $selectedService = null;
                $selectedCategory = null;
                $agents = [];
            }
        }

        return view('bookAppointment.index', [
            'selectedService' => $selectedService,
            'selectedCategory' => $selectedCategory,
            'agents' => $agents,
            'serviceProviderId' => $serviceProviderId,
            'serviceId' => $serviceId,
            'userId' => $firebaseUid,
        ]);
    }
}


