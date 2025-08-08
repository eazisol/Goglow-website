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

        $selectedService = null;

        if ($serviceId) {
            try {
                $response = Http::get('https://us-central1-beauty-984c8.cloudfunctions.net/getServiceById', [
                    'service_id' => $serviceId,
                ]);

                if ($response->ok()) {
                    $json = $response->json();
                    // API returns keys: service, category, agents
                    $selectedService = $json['service'] ?? null;
                }
            } catch (\Throwable $e) {
                // Silently ignore and render page without prefilled service
                $selectedService = null;
            }
        }

        return view('bookAppointment.index', [
            'selectedService' => $selectedService,
            'serviceProviderId' => $serviceProviderId,
            'serviceId' => $serviceId,
        ]);
    }
}


