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

                        @foreach ($results as $row)
                            @php
                                $x1 = $row['box']['x1'] / $info['width'];
                                $y1 = $row['box']['y1'] / $info['height'];
                                $x2 = $row['box']['x2'] / $info['width'];
                                $y2 = $row['box']['y2'] / $info['height'];

                                $w = $x2 - $x1;
                                $h = $y2 - $y1;
                            @endphp

                            <!-- 枠 -->
                            <div class="absolute border-2 border-red-500"
                                style="
                                    left:{{ $x1 * 100 }}%;
                                    top:{{ $y1 * 100 }}%;
                                    width:{{ $w * 100 }}%;
                                    height:{{ $h * 100 }}%;
                                ">
                            </div>
                        @endforeach

                        @foreach ($results as $row)
                            @php
                                $x1 = $row['box']['x1'] / $info['width'];
                                $y1 = $row['box']['y1'] / $info['height'];
                            @endphp

                            <!-- ラベル -->
                            <div class="absolute bg-red-500 text-white text-xs px-1"
                                style="
                                    left:{{ $x1 * 100 }}%;
                                    top:{{ ($y1 - 0.05) * 100 }}%;
                                ">
                                {{ $row['label'] }} ({{ round($row['confidence'], 2) }})
                            </div>
                        @endforeach
                    </div>
                    <div>info</div>
                    <pre>{{ print_r($info, true) }}</pre>
                    <div>results</div>
                    <pre>{{ print_r($results, true) }}</pre>
                </div>
            @endif
        </form>
    </div>
</x-app-layout>
