<option value="">Selecteer vendor</option>
@foreach ($vendors as $vendor)
    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
@endforeach