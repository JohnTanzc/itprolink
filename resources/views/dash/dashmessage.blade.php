@extends('layouts.main')

@section('content')
    {{-- Header --}}
    @include('dash.dashnav')
    {{-- End of Header --}}
    <div class="dashboard-content-wrap">
        <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ms-3">
            <i class="la la-bars me-1"></i> Dashboard Nav
        </div>

        <div class="dashboard-heading mb-0">
            <h3 class="fs-22 font-weight-semi-bold">Message</h3>
        </div>
        <div class="dashboard-message-wrapper d-flex my-4">
            <div class="message-sidebar">
                <form action="#" class="p-4" method="GET">
                    <div class="form-group mb-0">
                        <input class="form-control form--control form--control-gray ps-3" type="text" name="search"
                            placeholder="Search..." value="{{ request('search') }}" />
                        <button type="submit" class="search-icon">
                            <i class="la la-search"></i>
                        </button>
                    </div>
                </form>

                <div class="message-inbox-item border-bottom border-bottom-gray">
                    <div class="notification-body scrolled-box scrolled--box custom-scrollbar-styled">
                        @foreach ($conversations as $user)
                            <!-- Loop through users -->
                            <a href="{{ route('messages.fetch', $user->id) }}" class="media media-card align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-2 position-relative">
                                    <img class="rounded-full img-fluid"
                                        src="{{ asset('storage/profile_pictures/' . ($user->profile_picture ?? 'default-image.png')) }}"
                                        alt="Avatar image"
                                        style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%;" />
                                    <span class="dot-status bg-success position-absolute bottom-0 right-0"></span>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h5 class="fs-14">
                                        {{ $user->fname }}
                                        <span class="badge text-bg-success p-1 ms-2">{{ $user->unread }}</span>
                                    </h5>
                                    <p class="text-truncate lh-18 pt-1 text-gray fs-13">
                                        @if ($user->lastMessage)
                                            @if ($user->lastMessage->sender_id == auth()->id())
                                                <strong>You:</strong> {{ $user->lastMessage->message }}
                                            @else
                                                {{ $user->lastMessage->message }}
                                            @endif
                                        @else
                                            No messages yet
                                        @endif
                                    </p>
                                    <span class="fs-12 d-block lh-18 pt-1 text-gray">
                                        @if ($user->lastMessage)
                                            {{ $user->lastMessage->created_at->diffForHumans() }}
                                        @endif
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <!-- end message-inbox-item -->
            </div>
            <!-- message-sidebar -->

            <div class="message-content flex-grow-1">
                @if ($receiver)
                    <div
                        class="message-header bg-gray d-flex align-items-center justify-content-between p-4 border-bottom border-bottom-gray">
                        <div class="media media-card align-items-center">
                            <div class="avatar-sm flex-shrink-0 me-2">
                                <img class="rounded-full img-fluid"
                                    src="{{ asset('storage/profile_pictures/' . ($receiver->profile_picture ?? 'default-image.png')) }}"
                                    alt="Avatar image"
                                    style="width: 48px; height: 48px; object-fit: cover; border-radius: 50%;" />

                            </div>
                            <div class="media-body overflow-hidden">
                                <h5 class="fs-14">{{ $receiver->fname }}</h5>
                                <span class="fs-12 d-block lh-18 pt-1 text-success">Online</span>
                            </div>
                        </div>
                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Clear chart">
                            <i class="la la-trash"></i>
                        </div>
                    </div>
                    <!-- message-header -->
                    <div class="conversation-wrap">
                        <div class="conversation-box custom-scrollbar-styled" id="conversation-box">
                            @foreach ($messages as $message)
                                <!-- Loop through conversation messages -->
                                <div
                                    class="conversation-item {{ $message->sender_id == auth()->id() ? 'message-sent' : 'message-reply' }} mb-3">
                                    <div class="media media-card align-items-center">
                                        <div class="avatar-sm flex-shrink-0 me-4">
                                            <img class="rounded-full img-fluid"
                                                src="{{ asset('storage/profile_pictures/' . ($message->sender->profile_picture ?? 'default-image.png')) }}"
                                                alt="Avatar image"
                                                style="width: 48px; height: 48px; object-fit: cover; border-radius: 50%;" />
                                        </div>
                                        <div class="media-body d-flex align-items-center">
                                            <div class="generic-action-wrap generic--action-wrap-3">
                                                <div class="dropdown">
                                                    <a class="action-btn" href="#" role="button"
                                                        id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="la la-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item" href="#">Copy</a>
                                                        <a class="dropdown-item" href="#">Cut</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="message-body">
                                                <h5 class="fs-13">{{ $message->message }}</h5>
                                                <span
                                                    class="fs-12 d-block lh-18 pt-1">{{ $message->created_at->format('h:i A') }}
                                                    <i class="la la-check ms-1"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- conversation-item -->
                            @endforeach
                        </div>
                        <!-- conversation-box -->
                    </div>
                    <!-- conversation-wrap -->
                @endif

                <!-- Message Input Area -->
                @if ($receiver)
                    <div class="message-reply-body d-flex align-items-center pt-2 px-4 border-top border-top-gray">
                        <form action="{{ route('messages.send') }}" method="POST" id="message-form"
                            class="flex-grow-1 d-flex align-items-center">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $receiver ? $receiver->id : '' }}">
                            <textarea class="emoji-picker" name="message" placeholder="Your message" rows="3" style="flex: 1;"></textarea>
                            <button type="submit" id="send-message-btn"
                                class="message-send icon-element icon-element-xs bg-1 text-white ms-2 border-0">
                                <i class="la la-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Default blank space, keeping it white when no user is selected -->
                    <div class="message-reply-body d-flex align-items-center pt-2 px-4 border-top border-top-gray"
                        style="visibility: hidden;">
                        <form action="{{ route('messages.send') }}" method="POST" id="message-form"
                            class="flex-grow-1 d-flex align-items-center">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $receiver ? $receiver->id : '' }}">
                            <textarea class="emoji-picker" name="message" placeholder="Your message" rows="3" style="flex: 1;"></textarea>
                            <button type="submit" id="send-message-btn"
                                class="message-send icon-element icon-element-xs bg-1 text-white ms-2 border-0">
                                <i class="la la-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
            <!-- message-content -->
        </div>
        @include('dash.dashfooter')
    </div>


    <!-- Modal -->
    <div class="modal fade modal-container" id="deleteModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="la la-exclamation-circle fs-60 text-warning"></span>
                    <h4 class="modal-title fs-19 font-weight-semi-bold pt-2 pb-1">
                        Your account will be deleted permanently!
                    </h4>
                    <p>Are you sure you want to delete your account?</p>
                    <div class="btn-box pt-4">
                        <button type="button" class="btn font-weight-medium me-3" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">
                            Ok, Delete
                        </button>
                    </div>
                </div>
                <!-- end modal-body -->
            </div>
            <!-- end modal-content -->
        </div>
        <!-- end modal-dialog -->
    </div>
    <!-- end modal -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Variables
            const messageForm = document.getElementById("message-form");
            const conversationBox = document.getElementById("conversation-box");

            // Ensure elements are available before proceeding
            if (!messageForm || !conversationBox) {
                console.error("Required elements not found in the DOM");
                return;
            }

            // Ensure receiverId is only set if $receiver is not null
            const receiverId = {{ isset($receiver) && $receiver ? $receiver->id : 'null' }};

            if (receiverId === 'null') {
                alert("No conversation selected.");
                return;
            }

            // Function to fetch messages
            function fetchMessages() {
                fetch("{{ route('messages.fetch', ':id') }}".replace(':id', receiverId))
                    .then(response => response.json())
                    .then(messages => {
                        conversationBox.innerHTML = ''; // Clear current messages
                        messages.forEach(message => {
                            const messageElement = document.createElement("div");
                            messageElement.classList.add("message", "media", "media-card",
                                "align-items-center");
                            messageElement.innerHTML = `
                        <div class="avatar-sm flex-shrink-0 me-2">
                            <img class="rounded-full img-fluid" src="{{ asset('images/small-avatar-1.jpg') }}" alt="Avatar image" />
                        </div>
                        <div class="media-body overflow-hidden">
                            <p>${message.message}</p>
                            <span class="fs-12 d-block lh-18 pt-1 text-gray">${new Date(message.created_at).toLocaleString()}</span>
                        </div>
                    `;
                            conversationBox.appendChild(messageElement);
                        });

                        // Scroll to the bottom of the messages
                        conversationBox.scrollTop = conversationBox.scrollHeight;
                    })
                    .catch(error => console.error("Error fetching messages:", error));
            }

            // Fetch messages initially
            fetchMessages();

            // Handle message form submission
            messageForm.addEventListener("submit", function(e) {
                e.preventDefault();
                const messageInput = messageForm.querySelector("textarea[name='message']");
                const messageContent = messageInput.value.trim();

                if (messageContent) {
                    fetch("{{ route('messages.send') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                receiver_id: receiverId,
                                message: messageContent
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error("Failed to send message");
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.status === 'success') {
                                // Clear message input
                                messageInput.value = '';
                                // Fetch updated messages
                                fetchMessages();
                            } else {
                                alert("Failed to send message");
                            }
                        })
                        .catch(error => {
                            console.error("Error sending message:", error);
                            alert("An error occurred. Please try again.");
                        });
                }
            });
        });
    </script>

@endsection
