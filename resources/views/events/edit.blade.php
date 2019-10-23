@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Edit Form</h2>
@endsection

@section('titlebreadcrumb')
<li>
    <a href="{{route('events.index')}}">Events</a>
</li>
<li class="active">
    <strong>Edit Events Form</strong>
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
                    <h5>Edit form</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12 b-r">
                            <h3 class="m-t-none m-b">Edit Event</h3>
                            <form role="form" method="POST" action="{{ route('events.update',$event->id) }}"
                                enctype='multipart/form-data'>
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Cover Image</label>
                                    <input type="file" class="form-control" name="cover_url">
                                    <img src="{{Storage::url($event->cover_url)}}" style='height:50px; width:50px;'>
                                </div>

                                <div class="form-group">
                                    <label>Main Title</label>
                                    <input type="text" value="{{$event->main_title}}" class="form-control"
                                        name="main_title">
                                </div>

                                <div class="form-group">
                                    <label>Secondary Title</label>
                                    <input type="text" value="{{$event->secondary_title}}" class="form-control"
                                        name="secondary_title">
                                </div>

                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea type="text" class="form-control" name="content"
                                        id="content"> {{$event->content}} </textarea>
                                </div>

                                <div class="form-group">
                                    <label>Start Date</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>                                        </span>
                                        </span>
                                        <input name="start_date" id="start_date" type="text" class="form-control"
                                            value="{{ $event->start_date }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>End Date</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>                                        </span>
                                        </span>
                                        <input name="end_date" id="end_date" type="text" class="form-control"
                                            value="{{ $event->end_date }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Invited</label> <br>
                                    <select id="visitors" name="visitors[]" class="form-control chosen-select" multiple>
                                        <option disabled>Select</option>
                                        @foreach ($all_visitors as $key => $value)
                                            @foreach ($visitors as $visitor)
                                                @if($value == $visitor->id))
                                                    <option value="{{$visitor->id}}" selected>
                                                        {{ $visitor->user->getFullNameAttribute() }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Upload Images</label>
                                    <div class="dropzone" id="dropzoneFormImage">
                                        
                                    </div>
                                    <label for="images">
                                        @foreach ($images as $image)
                                            <img src="{{Storage::url($image->url)}}" style='height:50px; width:50px;'>
                                        @endforeach
                                    </label>
                                </div>
                                
                                <div class="form-group">
                                    <label for="address_address">Address</label>
                                <input type="text" id="address-input" name="address_address" class="form-control map-input" value="{{$event->address_address}}">
                                    <input type="hidden" name="address_latitude" id="address-latitude" value="{{$event->address_latitude}}" />
                                    <input type="hidden" name="address_longitude" id="address-longitude" value="{{$event->address_longitude}}" />
                                </div>
                                <div id="address-map-container" style="width:100%;height:400px; ">
                                    <div style="width: 100%; height: 100%" id="address-map"></div>
                                </div>
                                <br>

                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                        type="submit"><strong>Submit</strong></button>
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
    $(document).ready( function() {
        var imageDropZone = new Dropzone("#dropzoneFormImage",{
            paramName: "image", // The name that will be used to transfer the file
            url: "{{ route('uploadImage') }}",
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            dictDefaultMessage: "<strong>Drop Images here or click to upload. </strong></br>",
            acceptedFiles: ".png,.jpg",
            maxThumbnailFilesize: 1, //MB
            addRemoveLinks: true,
            success: function(file, response) {
                $('form').append('<input type="hidden" name="image[]" value="'+response.name+'" >')
                uploadedImageMap[file.name] = response.name
            },
            removedFile: function(file) {
                file.previewElement.remove()
                var name = ''
                if(typeof(file.file_name !== 'undefined')){
                    name = file.file_name
                }else{
                    name = uploadedImageMap[file.name]
                }
                $('form').find('input[name="image[]"][value="'+name+'"]').remove() 
            },
        });
    });
</script>
@endsection

@section('MapScript')
    @parent
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
    <script src="{{ asset('js/mapInput.js') }}"></script>
@stop

@push('JSValidatorScript')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\EventRequest') !!}
@endpush
