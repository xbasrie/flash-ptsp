<?php

namespace App\Observers;

use App\Models\Submission;
use App\Mail\SubmissionReceived;
use App\Mail\SubmissionStatusChanged;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SubmissionObserver
{
    /**
     * Handle the Submission "created" event.
     */
    public function created(Submission $submission): void
    {
        try {
            if (isset($submission->content['email']) && !empty($submission->content['email'])) {
                Mail::to($submission->content['email'])->send(new SubmissionReceived($submission));
            }
        } catch (\Exception $e) {
            Log::error('Failed to send submission received email: ' . $e->getMessage());
        }
    }

    /**
     * Handle the Submission "updated" event.
     */
    public function updated(Submission $submission): void
    {
        try {
            // Check if status transformed to approved or rejected (and changed from something else)
            if ($submission->isDirty('status') && in_array($submission->status, ['approved', 'rejected'])) {
                
                if (isset($submission->content['email']) && !empty($submission->content['email'])) {
                    Mail::to($submission->content['email'])->send(new SubmissionStatusChanged($submission));
                }
            }
        } catch (\Exception $e) {
            Log::error('Failed to send submission status update email: ' . $e->getMessage());
        }
    }
}
