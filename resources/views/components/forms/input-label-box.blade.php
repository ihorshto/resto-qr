<div class="mb-4 sm:mb-6">
    <label for="{{$id}}" class="block font-semibold text-sm mb-1">{{$labelTitle}}</label>
    <input type="{{$type}}" name="{{$name}}" id="{{$id}}" value="{{$value}}"
           class="py-3 px-4 block w-full border-gray-200 @error($name) border-red-500 @enderror rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
           placeholder="{{$placeholder}}">
    @error($name)
    <div class="text-red-500 text-sm">{{ $message }}</div>
    @enderror
</div>
