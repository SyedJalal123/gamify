<ui class="contacts">
    @foreach ($conversations as $conversation)
        @php
            $reciever = auth()->id() === $conversation->buyer_id
                ? $conversation->seller
                : $conversation->buyer;
        @endphp
        <li wire:click="$dispatch('open-chat', { conversationId: {{ $conversation->id }}, recieverId: {{ $reciever->id }} })"
            class="active cursor-pointer">
            <div class="d-flex bd-highlight py-2">
                <div class="img_cont">
                    <div class="user_img seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                        {{ strtoupper(substr($reciever->name,0,1)) }}
                    </div>
                    {{-- <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img"> --}}
                    <span class="online_icon"></span>
                </div>
                <div class="user_info">
                    <span class="fs-15">{{$reciever->name}}</span>

                    <p class="one-line-ellipsis-2 small-message m-0">{{$conversation->messages->last()?->message ?? 'No messages yet'}}</p>
                </div>
            </div>
        </li>
    @endforeach
</ui>