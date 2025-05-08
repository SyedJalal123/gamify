<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BuyerRequest;
use App\Models\Message;
use App\Events\MessageSeenEvent;
use App\Events\MessageSentEvent;
use Livewire\Attributes\On;
use Carbon\Carbon;


class Openchat extends Component
{
    public $reciever;
    public $buyerRequestConversation;
    public $message;
    public $identity;
    public $messages;
    public $buyerRequest;
    public $senderId;

    public function mount() 
    {
        if($this->buyerRequestConversation != null){
            $this->reciever = $this->identity == 'seller'
                            ? $this->buyerRequestConversation->buyer
                            : $this->buyerRequestConversation->seller;
        

            $this->readAllMessages();
            $this->getMessages();
            $this->senderId = auth()->id();
        }

    }

    #[On('show-chat')]
    #[On('open-chat')]
    public function openChat($conversationId, $recieverId = null) 
    {
        $conversation = $this->buyerRequest->buyerRequestConversation->firstWhere('id', $conversationId);
        
        $this->buyerRequestConversation = $conversation;

        $this->getMessages();

        $this->reciever = $this->identity == 'seller'
                        ? $this->buyerRequestConversation->buyer
                        : $this->buyerRequestConversation->seller;
                        
        $this->dispatch('sidebar-updated');

        $this->readAllMessages();
    }

    public function render()
    {
        return view('livewire.live-chats');
    }

    #[On('sendMessage')]
    public function sendMessage($message) 
    {
        if($message != null){
            $this->message = $message;
            $sentMessage = $this->saveMessage();

            $this->messages[] = $sentMessage;

            broadcast(new MessageSentEvent($sentMessage));
            $this->dispatch('message-updated');
        }
    }


    #[On('message-received')]
    public function listenMessage($event)
    {
        $newMessage = Message::find($event['id']);

        if($this->buyerRequestConversation->id == $event['buyer_request_conversation_id']){
            $this->messages[] = $newMessage;
        }

        $this->dispatch('message-updated');

        $this->readAllMessages();
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

    #[On('readAllMessages')]
    public function readAllMessages()
    {
        // dd('fds');
        $this->buyerRequestConversation->messages()
        ->where('reciever_id', auth()->user()->id)
        ->whereNull('read_at')
        ->update(['read_at' => now()]);

        broadcast(new MessageSeenEvent($this->reciever->id, $this->buyerRequestConversation->id));
    }

    #[On('chat-seen')]
    public function chatSeen($event){
        if($event['conversationId'] == $this->buyerRequestConversation->id)
        $this->getMessages();
    }
}
