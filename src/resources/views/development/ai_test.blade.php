<x-app-layout>
    <x-slot name="header">
        <h2 class="app-header-title">
            AI Test
        </h2>
    </x-slot>

    <div class="app-container">
        <div class="my-6 text-lg">画像解析</div>
        <form method="POST" action="{{ route('development.ai_test_post') }}" enctype="multipart/form-data" class="app-form mt-5">
            @csrf
            <div class="mt-5">
                <input type="file" name="file" id="file" class="mt-1">
                @error('file')
                    <p class="app-error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-5">
                <button type="submit" class="app-btn-primary">送信</button>
            </div>

            @if($src)
                <div class="mt-5">
                    <div class="relative inline-block">
                        <img src="{{ $src }}">

                        @foreach ($list as $row)
                            <!-- 枠 -->
                            <div class="absolute border-2 border-red-500"
                                style="
                                    left:{{ $row['calculatedValues']['x1Ratio'] * 100 }}%;
                                    top:{{ $row['calculatedValues']['y1Ratio'] * 100 }}%;
                                    width:{{ $row['calculatedValues']['wRatio'] * 100 }}%;
                                    height:{{ $row['calculatedValues']['hRatio'] * 100 }}%;
                                ">
                            </div>
                        @endforeach

                        @foreach ($list as $row)
                            <!-- ラベル -->
                            <div class="absolute bg-red-500 text-white text-xs px-1"
                                style="
                                    left:{{ $row['calculatedValues']['x1Ratio'] * 100 }}%;
                                    top:{{ ($row['calculatedValues']['y1Ratio'] - 0.05) * 100 }}%;
                                ">
                                {{ $row['label'] }} ({{ round($row['confidence'], 2) }})
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-4">
                        <div>info</div>
                        <pre>{{ App\Services\Data\Json::trace($info, true) }}</pre>
                        <div>list</div>
                        <pre class="h-[30rem] overflow-scroll">{{ App\Services\Data\Json::trace($list, true) }}</pre>
                        <div>response</div>
                        <pre class="h-[30rem] overflow-scroll">{{ App\Services\Data\Json::trace($response, true) }}</pre>
                    </div>
                </div>
            @endif
        </form>
    </div>
</x-app-layout>
