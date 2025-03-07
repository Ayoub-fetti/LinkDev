<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Job_offers;

class NewJobPosted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $job;

    /**
     * Create a new event instance.
     */
    public function __construct(Job_offers $job)
    {
        $this->job = $job;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('jobs'),
        ];
    }
    public function broadcastAs()
    {
        return 'NewJobPosted';
    }
    public function broadcastWith()
    {
        // Explicitly define what gets sent to avoid serialization issues
        return [
            'job' => [
                'id' => $this->job->id,
                'title' => $this->job->title,
                'company_name' => $this->job->company_name,
                'description' => $this->job->description,
                'location' => $this->job->location,
                'offer_link' => $this->job->offer_link,
                'contract_type' => $this->job->contract_type,
                'created_at' => $this->job->created_at->toIso8601String()
            ]
        ];
    }

}