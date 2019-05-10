@foreach($items as $item)
    <option value="{{ $item->id }}">{{ $item->text }}</option>
@endforeach