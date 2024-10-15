@foreach ($arrivals as $transport)

    <div class="columns-2">
        <div class="line">{{$transport['line']['name']}}</div>
        <div class="time">{{$transport['when']}}</div>
    </div>

@endforeach
