<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use App\Models\BuyerRequestConversation;
use App\Events\ChatCreatedEvent;
use Livewire\Component;

class LiveUser extends Component
{
    public $buyerId;
    public $sellerId;
    public $buyerRequest;
    public $identity;
    public $conversations;


    #[On('message-updated')]
    public function mount() {
        $this->dispatch('message-sidebar-updated');
    }

    
    #[On('start-chat')]
    public function startChat($buyerId, $sellerId)
    {
        $conversation = BuyerRequestConversation::create([
            'buyer_request_id' => $this->buyerRequest->id,
            'buyer_id' => $buyerId,
            'seller_id' => $sellerId
        ]);

        $this->buyerId = $buyerId;
        $this->sellerId = $sellerId;

        $this->conversations[] = $conversation;

        $reciever = $this->identity == 'seller'
                        ? $conversation->buyer
                        : $conversation->seller;
        

        broadcast(new ChatCreatedEvent($conversation, $reciever));

        $this->dispatch('conversation-created', sellerId: $conversation->seller_id);
        $this->dispatch('show-chat', conversationId: $conversation->id);
    }

    #[On('chat-created')]
    public function updateConversations($conversation)
    {
        $conversation = BuyerRequestConversation::find($conversation['id']);
        $this->conversations[] = $conversation;

        if(count($this->conversations) == 1) {
            $this->dispatch('show-chat', conversationId: $conversation->id);
        }

        $this->dispatch('conversation-created', sellerId: $conversation->seller_id);
    }

    public function render()
    {
        return view('livewire.live-users');
    }
    
}
