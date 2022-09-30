@php
    $showAutocomplete = property_exists($row->details, 'showAutocompleteInput') ? (bool)$row->details->showAutocompleteInput : true;
    $showAutocomplete = $showAutocomplete ? 'true' : 'false';
    $showLatLng = property_exists($row->details, 'showLatLngInput') ? (bool)$row->details->showLatLngInput : true;
    $showLatLng = $showLatLng ? 'true' : 'false';
    if ($dataTypeContent->getCoordinates() && count($dataTypeContent->getCoordinates())) {
        $defaultCenter = $dataTypeContent->getCoordinates();
        $unedited = 'false';
    } else {
        $unedited = 'true';
        $defaultCenter = [['lat' => config('voyager.maps.center.lat'), 'lng' => config('voyager.maps.center.lng')]];
    }
@endphp

<div id="app" class="coordinates-formfield">
    <coordinates-form-field 
        ref="coordinates"
        :default-center="{{ json_encode($defaultCenter) }}"
        :show-lat-lng="{{ $showLatLng }}"
        :zoom={{ config('voyager.maps.zoom') }}
        :fieldname="'{{ $row->field }}'"
        :unedited="{{ $unedited }}"
    >
    </coordinates-form-field>
</div>

@push('javascript')
    <script type="application/javascript">
        var app = new Vue({
            el: '#app',
        });
    </script>
@endpush