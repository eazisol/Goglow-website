<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
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
        $rescheduleBookingId = $request->query('reschedule'); // Booking ID to reschedule
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
                    'photoURL' => $user->photoUrl ?? null,
                    'photo' => $user->photoUrl ?? null,
                ];
            } catch (\Throwable $e) {
                // If we can't get user data, use what we have in session
                $userData = [
                    'id' => $firebaseUid,
                    'name' => '',
                    'email' => session('firebase_email', ''),
                    'phone' => '',
                    'photoURL' => null,
                    'photo' => null,
                ];
            }
        }

        if ($serviceId) {
            try {
                // Cache service by ID for 10 minutes to improve performance
                $json = Cache::remember("service_by_id_{$serviceId}", 600, function () use ($serviceId) {
                    $response = Http::get('https://us-central1-beauty-984c8.cloudfunctions.net/getServiceById', [
                        'service_id' => $serviceId,
                    ]);

                    if ($response->ok()) {
                        return $response->json();
                    }
                    return null;
                });

                if ($json) {
                    // API returns keys: service, category, agents, spDeposit, commission
                    $selectedService = $json['service'] ?? null;
                    $selectedCategory = $json['category'] ?? null;
                    $agents = $json['agents'] ?? [];
                    
                    // Merge spDeposit and commission into selectedService if they exist
                    if ($selectedService && isset($json['spDeposit'])) {
                        $selectedService['spDeposit'] = $json['spDeposit'];
                    }
                    if ($selectedService && isset($json['commission'])) {
                        $selectedService['commission'] = $json['commission'];
                    }
                } else {
                    $selectedService = null;
                    $selectedCategory = null;
                    $agents = [];
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
            'rescheduleBookingId' => $rescheduleBookingId,
        ]);
    }

    public function showBySlug(Request $request, $companyUserName, $servicesSlug)
    {
        // First, validate that the provider exists
        // try {
        //     $cacheKey = "provider_by_username_{$companyUserName}";
        //     $providers = Cache::remember($cacheKey, 900, function () use ($companyUserName) {
        //         return Http::get('https://us-central1-beauty-984c8.cloudfunctions.net/searchProviders', [
        //             'companyUserName' => $companyUserName
        //         ])->json() ?? [];
        //     });
            
        //     // If provider doesn't exist, redirect to 404
        //     if (!is_array($providers) || count($providers) === 0) {
        //         return redirect('/404');
        //     }
        // } catch (\Exception $e) {
        //     // Error fetching provider, redirect to 404
        //     return redirect('/404');
        // }
        
        $firebaseUid = session('firebase_uid');
        
        // Store the current URL in the session for authentication redirect
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
        $serviceProviderId = null;

        // Get user data if authenticated
        if ($firebaseUid) {
            try {
                $user = $this->auth->getUser($firebaseUid);
                $userData = [
                    'id' => $firebaseUid,
                    'name' => $user->displayName ?? '',
                    'email' => $user->email ?? session('firebase_email', ''),
                    'phone' => $user->phoneNumber ?? '',
                    'photoURL' => $user->photoUrl ?? null,
                    'photo' => $user->photoUrl ?? null,
                ];
            } catch (\Throwable $e) {
                // If we can't get user data, use what we have in session
                $userData = [
                    'id' => $firebaseUid,
                    'name' => '',
                    'email' => session('firebase_email', ''),
                    'phone' => '',
                    'photoURL' => null,
                    'photo' => null,
                ];
            }
        }

        if ($servicesSlug) {
            try {
                // Cache service by slug for 10 minutes to improve performance
                $json = Cache::remember("service_by_slug_{$servicesSlug}", 10, function () use ($servicesSlug) {
                    $response = Http::get('https://us-central1-beauty-984c8.cloudfunctions.net/getServiceById', [
                        'services_slug' => $servicesSlug,
                    ]);

                    if ($response->ok()) {
                        return $response->json();
                    }
                    return null;
                });

                if ($json) {
                    // API returns keys: service, category, agents, spDeposit, commission
                    $selectedService = $json['service'] ?? null;
                    $selectedCategory = $json['category'] ?? null;
                    $agents = $json['agents'] ?? [];
                    
                    // // If service doesn't exist, redirect to 404
                    // if (!$selectedService) {
                    //     return redirect('/404');
                    // }
                    
                    // Merge spDeposit and commission into selectedService if they exist
                    if ($selectedService && isset($json['spDeposit'])) {
                        $selectedService['spDeposit'] = $json['spDeposit'];
                    }
                    if ($selectedService && isset($json['commission'])) {
                        $selectedService['commission'] = $json['commission'];
                    }
                    
                    // Extract service provider ID from service data if available
                    // Use ownerId field from service data (as per API response structure)
                    if ($selectedService && isset($selectedService['ownerId'])) {
                        $serviceProviderId = $selectedService['ownerId'];
                    }
                } else {
                    // Service not found, redirect to 404
                    // return redirect('/404');
                    $selectedService = null;
                    $selectedCategory = null;
                    $agents = [];
                }
            } catch (\Throwable $e) {
                // Service not found or error, redirect to 404
                // return redirect('/404');
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
            'serviceId' => $selectedService['id'] ?? null,
            'companyUserName' => $companyUserName,
            'servicesSlug' => $servicesSlug,
            'userId' => $firebaseUid,
            'userData' => $userData,
            'whiteLabel' => true, // Enable white-label mode for provider booking pages
        ]);
    }
}


