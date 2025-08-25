@extends('layouts.app')

@section('content')

    <style>
        .box {
            border: 1px solid #000;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
        }
    </style>
    <div class="container text-center mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- <a href="{{ route('run.scheduler') }}" class="btn btn-warning mt-3">Run Scheduler Now</a> --}}

        <h3>Color Array</h3>
        <div id="color-array" class="mb-3">
            @foreach ($colors as $color)
                <span style="background-color: {{ $color }}"
                    class="badge bg-{{ $color == 'grey' ? 'secondary' : $color }} m-1">{{ $color }}</span>
            @endforeach
        </div>

        <button id="shuffleBtn" class="btn btn-primary">Shuffle Colours</button>
        <button id="sortBtn" class="btn btn-success ms-2">Sort Boxes</button>

        <div class="container mt-4 text-center">
            <div id="box-container" class="d-flex justify-content-start">
                @php
                    $total = count($boxes);
                    $level = 1; // how many boxes in a column
                    $index = 0; // current box index
                @endphp
                {{-- Boxes display verticaly --}}
                @while ($index < $total)
                    <div class="d-flex flex-column align-items-center mx-3">
                        @for ($i = 0; $i < $level && $index < $total; $i++, $index++)
                            <div class="m-2 box" data-color="{{ $boxes[$index]->color }}"
                                style="height:{{ $boxes[$index]->height }}px;
                                width:{{ $boxes[$index]->width }}px;
                                background-color:{{ $boxes[$index]->color }};">
                            </div>
                        @endfor
                    </div>
                    @php
                        $level *= 2;
                    @endphp
                @endwhile
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let colors = @json($colors);

        function renderColors() {
            let html = '';
            $.each(colors, function(i, c) {
                let bootstrapColor = (c === 'grey') ? 'secondary' : c;
                html += `<span style="background-color:${c}" class="badge bg-${bootstrapColor} m-1">${c}</span>`;
            });
            $('#color-array').html(html);
        }

        // Shuffle colors
        $('#shuffleBtn').on('click', function() {
            colors.sort(() => Math.random() - 0.5);
            renderColors();
        });

        // Sort boxes according to array
        $('#sortBtn').on('click', function() {
            let container = $('#box-container');
            let boxes = container.find('.box').get();

            boxes.sort(function(a, b) {
                return colors.indexOf($(a).data('color')) - colors.indexOf($(b).data('color'));
            });

            container.empty();

            let level = 1,
                index = 0;
            while (index < boxes.length) {
                let col = $('<div class="d-flex flex-column align-items-center mx-3"></div>');
                for (let i = 0; i < level && index < boxes.length; i++, index++) {
                    col.append(boxes[index]);
                }
                container.append(col);
                level *= 2;
            }
        });
    </script>
@endpush
