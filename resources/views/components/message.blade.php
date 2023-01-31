@if(isset($message))
<div class="border mt-6 px-4 py-3 rounded relative bg-green-100 border-green-400 text-green-700" {{ $attributes }}>
    {{$message}}
</div>
@endif