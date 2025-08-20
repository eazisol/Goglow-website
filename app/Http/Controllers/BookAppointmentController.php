<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Auth as FirebaseAuth;

class BookAppointmentController extends Controller
{
    protected $auth;

    public function __construct(FirebaseAuth $auth)
    {
        $this->auth = $auth;
    }

    public function show(Request $request)
    {
        $serviceId = $request->query('serviceId');
        $serviceProviderId = $request->query('service_provider_id');
        $firebaseUid = session('firebase_uid');
        
        // Store the current URL with query parameters in the session
        // This will be used if authentication is needed
        session(['last_book_appointment_url' => $request->fullUrl()]);
        
        // If user is not authenticated, set a flag to show the auth modal
        if (!$firebaseUid) {
            session()->flash('show_auth_modal', true);
            session()->flash('auth_redirect', $request->fullUrl());
        }

        $selectedService = null;
        $selectedCategory = null;
        $agents = [];
        $userData = null;

        // Get user data if authenticated
        if ($firebaseUid) {
            try {
                $user = $this->auth->getUser($firebaseUid);
                $userData = [
                    'id' => $firebaseUid,
                    'name' => $user->displayName ?? '',
                    'email' => $user->email ?? session('firebase_email', ''),
                    'phone' => $user->phoneNumber ?? '',
                ];
            } catch (\Throwable $e) {
                // If we can't get user data, use what we have in session
                $userData = [
                    'id' => $firebaseUid,
                    'name' => '',
                    'email' => session('firebase_email', ''),
                    'phone' => '',
                ];
            }
        }

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
            'userData' => $userData,
        ]);
    }
}


