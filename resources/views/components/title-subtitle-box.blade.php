@props(['margin_bottom'=>'mb-4'])
<div {{$attributes->merge(['class'=>"$margin_bottom"])}}>
    <div class="flex">
        <h4 class="font-semibold text-xl text-dark mb-1 mt-0 mr-1">{{$title}}</h4>
        {{ $slot }}
    </div>
    <p class="font-normal text-sm text-medium-dark">{{$subtitle}}</p>
</div>
