<div class="card m-0 p-0">
    @if($buyerRequestConversation != null)
    <div class="d-flex d-md-none px-3 py-2 fs-16 text-white cursor-pointer back">
        <i class="bi-caret-left-fill"></i>
        <span class="ml-2">Inbox</span>
    </div>
    <div class="card-header msg_head">
        <div class="d-flex bd-highlight">
            <div class="img_cont">
                <div class="user_img seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                    {{ strtoupper(substr($reciever->name,0,1)) }}
                </div>
                {{-- <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img"> --}}
                <span class="online_icon"></span>
            </div>
            <div class="user_info">
                <span>{{$reciever->name}}</span>
                <p class="one-line-ellipsis">Boosting request: 0c06a96b-6731-4edb-bcdf-02b89b4d9306</p>
            </div>
            {{-- <div class="video_cam">
                <span><i class="fas fa-video"></i></span>
                <span><i class="fas fa-phone"></i></span>
            </div> --}}
        </div>
        <span id="action_menu_btn"><i class="bi-three-dots-vertical"></i></span>
        <div class="action_menu">
            <ul>
                <li><i class="fas fa-user-circle"></i> View profile</li>
                <li><i class="fas fa-users"></i> Add to close friends</li>
                <li><i class="fas fa-plus"></i> Add to group</li>
                <li><i class="fas fa-ban"></i> Block</li>
            </ul>
        </div>
    </div>
    <div class="card-body fade-in-delay-small msg_card_body pb-0 mb-0" style="height: 351px;">
        <input type="hidden" name="" id="conversationId" value="{{$buyerRequestConversation->id}}">
        @foreach ($buyerRequestConversation->messages as $message)
            @if($message->sender_id == auth()->id())
                <div class="d-flex justify-content-end mb-4">
                    <div class="msg_cotainer_send">
                        {{$message->message}}
                        <span class="msg_time_send">{{shortTimeAgo($message->created_at)}}</span>
                    </div>
                    <div class="img_cont_msg">
                        <div class="user_img seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                            {{ strtoupper(substr($message->sender->name,0,1)) }}
                        </div>
                        <!-- <img src="" class="rounded-circle user_img_msg"> -->
                    </div>
                </div>
            @else
                <div class="d-flex justify-content-start mb-4">
                    <div class="img_cont_msg">
                        <div class="user_img_msg seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                            {{ strtoupper(substr($message->sender->name,0,1)) }}
                        </div>
                        <!--  <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg"> -->
                    </div>
                    <div class="msg_cotainer">
                        {{$message->message}}
                        <span class="msg_time">{{shortTimeAgo($message->created_at)}}</span>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="card-footer">
        <form wire:submit="sendMessage">
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text attach_btn"><i class="bi-paperclip"></i></span>
                </div>
                <input type="hidden" value="{{$reciever->id}}">
                <input type="hidden" value="{{$buyerRequestConversation->id}}">
                <input wire:model="message" type="text" name="" class="form-control type_msg" placeholder="Type your message...">
                <div class="input-group-append">
                    <button type="submit" class="input-group-text send_btn"><i class="bi-send-fill"></i></button>
                </div>
            </div>
        </form>
    </div>
    @endif
</div>