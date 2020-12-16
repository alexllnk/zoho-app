<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            {{--@foreach($account as $key => $item)
                @if(is_array($item))
                    {{ print_r($item, true) }}

                @else
                    {{ $item }}
                @endif
            @endforeach--}}
            {{ json_encode($account, JSON_PRETTY_PRINT) }}
        </div>
    </div>
</div>
