<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BuyerRequest;
use App\Models\Message;
use App\Events\MessageSentEvent;
use Livewire\Attributes\On;

class Openchat extends Component
{
    public $reciever;
    public $buyerRequestConversation;
    public $message;
    public $identity;
    public $messages;
    public $buyerRequest;

    public function mount() 
    {
        if($this->buyerRequestConversation != null){
            $this->reciever = $this->identity == 'seller'
                            ? $this->buyerRequestConversation->buyer
                            : $this->buyerRequestConversation->seller;
        

            $this->messages = $this->getMessages();
        }

    }

    #[On('show-chat')]
    #[On('open-chat')]
    public function openChat($conversationId, $recieverId = null) 
    {
        $conversation = $this->buyerRequest->buyerRequestConversation->firstWhere('id', $conversationId);
        
        $this->buyerRequestConversation = $conversation;

        $this->reciever = $this->identity == 'seller'
                        ? $this->buyerRequestConversation->buyer
                        : $this->buyerRequestConversation->seller;
                        
        $this->dispatch('message-sidebar-updated');
    }

    public function render()
    {
        return view('livewire.open-chats');
    }

    public function sendMessage() 
    {
        if($this->message != null){
            $sentMessage = $this->saveMessage();

            $this->message = null;

            broadcast(new MessageSentEvent($sentMessage));
        
            $this->dispatch('message-updated');
        }
    }


    #[On('message-received')]
    public function listenMessage($event)
    {
        $this->dispatch('message-updated');
    }

    public function saveMessage()
    {
        $message = Message::create([
            'buyer_request_conversation_id' => $this->buyerRequestConversation->id,
            'sender_id' => auth()->id(),
            'reciever_id' => $this->reciever->id,
            'message' => $this->message,
            // 'file_path' => $file_path,
            // 'file_type' => $file_type,
        ]);

        return $message;
    }

    public function getMessages() 
    {
        $this->messages = $this->buyerRequestConversation->messages;
    }
}
