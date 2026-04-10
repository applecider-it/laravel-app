<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Chat\RoomService;

/**
 * チャット(Echo)管理コントローラー
 * 
 * ドキュメント
 * /documents/features/chat.md
 */
class ChatEchoController extends Controller
{
    public function __construct(
        private RoomService $roomService
    ) {}

    public function index(Request $request)
    {
        $user = $request->user();

        $room = $request->input('room');

        $ret = $this->roomService->getRoomInfo($room);

        $room = $ret['room'];
        $rooms = $ret['rooms'];

        return view('chat_echo.index', compact('room', 'rooms'));
    }

    /** Echoでチャットメッセージ送信処理 */
    public function send(Request $request)
    {
        $user = $request->user();

        $room = $request->input('room');
        $message = $request->input('message');
        $options = $request->input('options');

        $others = $options['others'] ?? false;

        Log::info("sendMessageEcho options", [$options, $others]);

        $obj = broadcast(new \App\Events\ChatMessageSent($message, $room, $user));
        if ($others) $obj->toOthers();

        return response()->json([
            'status' => 'ok',
        ]);
    }
}
