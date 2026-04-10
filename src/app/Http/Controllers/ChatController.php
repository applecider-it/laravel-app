<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Services\WebSocket\AuthService as WebSocketAuthService;
use App\Services\WebSocket\SystemService as WebSocketSystemService;
use App\Services\Channels\ChatChannel;
use App\Services\Chat\RoomService;

/**
 * チャット管理コントローラー
 * 
 * ドキュメント
 * /documents/features/chat.md
 */
class ChatController extends Controller
{
    public function __construct(
        private WebSocketAuthService $webSocketAuthService,
        private WebSocketSystemService $webSocketSystemService,
        private RoomService $roomService
    ) {}

    public function index(Request $request)
    {
        $user = $request->user();

        $room = $request->input('room');

        $ret = $this->roomService->getRoomInfo($room);

        $room = $ret['room'];
        $rooms = $ret['rooms'];

        $token = $this->webSocketAuthService->createUserJwt($user, ChatChannel::getChannel($room));

        return view('chat.index', compact('token', 'room', 'rooms'));
    }

    /** RPCからチャットメッセージ送信処理 */
    public function send(Request $request)
    {
        $user = $request->user();

        Log::info(request()->all());
        $room = $request->input('room');
        $data = [
            "message" => $request->input('message'),
            "name" => $user->name,
        ];

        $response = $this->webSocketSystemService->publish(ChatChannel::getChannel($room), $data);

        return $response;
    }
}
