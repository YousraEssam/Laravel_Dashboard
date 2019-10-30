@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Create Form</h2>
@endsection

@section('titlebreadcrumb')
<li>
    <a href="{{route('events.index')}}">Events</a>
</li>
<li class="active">
    <strong>Create new Events Form</strong>
</li>
@endsection

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create form</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12 b-r">
                            <h3 class="m-t-none m-b">Create Events</h3>
                            <form role="form" method="POST" action="{{ route('events.store') }}"
                                enctype='multipart/form-data'>
                                @csrf
                                
                                <div class="form-group">
                                    <label>Main Title</label>
                                    <input type="text" placeholder="Main Title" class="form-control" name="main_title"
                                        id="main">
                                </div>

                                <div class="form-group">
                                    <label>Secondary Title</label>
                                    <input type="text" placeholder="Secondary Title" class="form-control"
                                        name="secondary_title" id="secondary">
                                </div>

                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea type="text" placeholder="Content" class="form-control" name="content"
                                        id="content">
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label>Start Date</label>
                                    <div class="input-group date" id="datetimepicker1">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>                                        </span>
                                        <input name="start_date" id="start_date" type="text" class="form-control"
                                            value="{{ date('Y-m-d H:i:s') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>End Date</label>
                                    <div class="input-group date" id="datetimepicker2">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input name="end_date" id="end_date" type="text" class="form-control"
                                            value="{{ date('Y-m-d H:i:s') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Invited</label> <br>
                                    <select id="visitors" name="visitors[]" class="form-control chosen-select" multiple>
                                        
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Upload Images</label>
                                    <div class="dropzone" id="dropzoneFormImage">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="address_address">Address</label>
                                    <input type="text" id="address-input" name="address_address" class="form-control map-input">
                                    <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                                    <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
                                </div>
                                <div id="address-map-container" style="width:100%;height:400px; ">
                                    <div style="width: 100%; height: 100%" id="address-map"></div>
                                </div>
                                <br>
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit">
                                        <strong>Submit</strong>
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('Imagedropzone')
<script>
    Dropzone.autoDiscover = false;
    var uploadedImageMap = {}
    $(document).ready(function () {
        var imageDropZone = new Dropzone("#dropzoneFormImage", {
            paramName: "image", // The name that will be used to transfer the file
            url: "{{ route('uploadImage') }}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            dictDefaultMessage: "<strong>Drop Images here or click to upload. </strong></br>",
            acceptedFiles: ".png,.jpg",
            maxThumbnailFilesize: 1, //MB
            addRemoveLinks: true,
            success: function (file, response) {
                $('form').append('<input type="hidden" name="image[]" value="' + response.id + '" >')
                let elem = $('.dz-preview').has('img[alt="'+file.name+'"]').last();
                $(elem).append('Set as cover <input type="radio" value="'+response.id +'" name="cover_url"/>')
                uploadedImageMap[file.name] = response.id
            },
            removedfile: function (file) {
                file.previewElement.remove()
                var name = ''
                if (typeof (file.file_name) !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedImageMap[file.name]
                }
                $('form').find('input[name="image[]"][value="' + name + '"]').remove()
            },
        });
    });

</script>
@endsection

@section('MapScript')
    @parent
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAilhmQ53WmMriu4R0VmosM2o3HBqo4pqo&libraries=places&callback=initialize" async defer></script>
    <script src="{{ asset('js/mapInput.js') }}"></script>
@stop

@push('JSValidatorScript')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\EventRequest') !!}
@endpush
