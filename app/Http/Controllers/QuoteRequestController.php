<?php

namespace App\Http\Controllers;

use App\Mail\QuoteRequestAdmin;
use App\Mail\QuoteRequestConfirmation;
use App\Models\QuoteRequest;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class QuoteRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:50',
            'job_details' => 'required|string|max:2000',
            'suburb' => 'required|string|max:255',
        ]);

        $quote = QuoteRequest::create($validated);

        try {
            // Send notification to admin
            $notificationEmail = SiteSetting::where('key', 'notification_email')->value('value')
                ?? SiteSetting::where('key', 'email')->value('value')
                ?? config('mail.from.address');

            Mail::to($notificationEmail)->send(new QuoteRequestAdmin($quote));

            // Send confirmation to the user
            if ($quote->email) {
                Mail::to($quote->email)->send(new QuoteRequestConfirmation($quote));
            }
        } catch (\Exception $e) {
            Log::error('Failed to send quote email: ' . $e->getMessage());
        }

        return back()->with('success', 'Quote request submitted successfully! We will contact you shortly.');
    }
}
