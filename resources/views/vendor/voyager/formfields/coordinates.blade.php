@php
    $showAutocomplete = property_exists($row->details, 'showAutocompleteInput') ? (bool)$row->details->showAutocompleteInput : true;
    $showAutocomplete = $showAutocomplete ? 'true' : 'false';
    $showLatLng = property_exists($row->details, 'showLatLngInput') ? (bool)$row->details->showLatLngInput : true;
    $showLatLng = $showLatLng ? 'true' : 'false';
    $unedited = 'false';
    if ($dataTypeContent->getCoordinates() && count($dataTypeContent->getCoordinates())) {
        $defaultCenter = $dataTypeContent->getCoordinates();
    } elseif (old('location')) {
        $defaultCenter = [old('location')];
    } else {
        $unedited = 'true';
        $defaultCenter = [['lat' => config('app.maps.center.lat'), 'lng' => config('app.maps.center.lng')]];
    }
@endphp

<div id="app" class="coordinates-formfield">
    <coordinates-form-field 
        ref="coordinates"
        :default-center="{{ json_encode($defaultCenter) }}"
        :show-lat-lng="{{ $showLatLng }}"
        :zoom={{ config('app.maps.zoom') }}
        :fieldname="'{{ $row->field }}'"
        :unedited="{{ $unedited }}"
    >
    </coordinates-form-field>
</div>