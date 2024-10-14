@foreach ($stops as $stop)
    <div class="stop"
        data-type="{{$stop['type']}}"
        data-id="{{$stop['id']}}"
        data-name="{{$stop['name']}}"
        data-location="{{json_encode($stop['location'])}}"
        data-products="{{json_encode($stop['products'])}}"
    >
        <p class="name">{{$stop['name']}}</p>
        <div class="products">
            @foreach ($stop['products'] as $key => $product)
                @if ($product)
                    <p data-type="{{$key}}">{{$key}}</p>
                @endif
            @endforeach
        </div>
    </div>
@endforeach

<pre class="mt-5">@php
        print_r($stops);
    @endphp
</pre>
