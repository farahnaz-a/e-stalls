<option value="">Kies vendor..</option>
@foreach ($vendors as $vendor)
    <option value="{{ $vendor->id }}">{{ $vendor->user->first_name ?? null }}</option>
@endforeach