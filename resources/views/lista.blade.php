@extends('app')

@section('content')

  <div class="d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm">
    <div class="lh-1">
      <h1 class="h6 mb-0 text-white lh-1"><i class="fa fa-microphone"></i> Texto a Voz</h1>
      <small>Integracion con Text-to-Speech (TTS) API</small>
    </div>
  </div>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
    <form id="text-to-speech-convert-form">
    @csrf
        <div class="mb-3">
            <label for="text" class="form-label">Texto a convertir</label>
            <textarea required class="form-control" id="text" name="text" aria-describedby="text" placeholder="Ingrese texto para su traduccion..." rows="4">{{ old('text') }}</textarea>
            <div id="text" class="form-text">Maximo 500 caracteres.</div>
        </div>

        <div class="mb-3">
            <label for="lan">Language del Texto</label>
            <select required class="form-control" name="lan" id="lan">       
                @foreach( config('idiomas.lan') as $key => $value )                         
                    @if( $key == old('lan') )
                        <option value="{{ $key }}" selected>{{ $value }}</option>
                    @else
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endif
                @endforeach
            </select>
        </div> 

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" id="convert-speech"><b>Convertir</b> <i class="fa fa-refresh"></i></button>
            <div class="text-center" id="speech-function"></div>
        </div> 
    </form>
    </div>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Listado de audios</h6>
    <div id="listado"></div>
  </div>

@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function () {     
        var downloadFile;                
        $("#speech-function").html('');                          
        $("#error-message").hide();                          
        $("#download-speech").hide();
        listado();

        $("#text-to-speech-convert-form").validate({
            rules: {
                text: { 
                    required: true,
                    maxlength: 500
                }                                    
            },
            messages: {
                text: {
                    required: "Please Enter Text",
                    maxlength: "Maximum 500 character."
                }
            }
        });        

        $(document).on('click', '#convert-speech', function(e){                                                                  
            $("#error-message").hide();                          
            
            if($('#text-to-speech-convert-form').valid()) { 
                e.preventDefault();                             
                $('#convert-speech').attr("disabled", true);                                                                                
                text = $('#text').val();
                lan = $('#lan').val();
                
                $.ajax({              
                    url : "{{ url('convertir') }}",
                    type : "get",                                
                    data: {
                        text: text,                               
                        lan: lan                             
                    },                          
                    success:function(data) {                                                                          
                                                                                    
                        $('#convert-speech').attr("disabled", false);  
                        if( data["status"] == 200) {                                                                                                            
                            downloadFile = data.responseText["download-file"];
                            $("#download-speech").show(); 
                            text = $('#text').val('');
                            lan = $('#lan').prop("selectedIndex", 0);
                            $("#speech-function").html('<audio controls><source src="'+ data.responseText["play-url"] +'" type="audio/mpeg"> Your browser does not support the audio element.</audio> ');
                        }   
                        else {
                            $("#error-message").html(data["responseText"]).show(); 
                        }
                        listado();                           
                    },               
                    error:function(data){ 
                        $('#convert-speech').attr("disabled", false);                                
                        $("#error-message").html(data.responseJSON["message"]).show();                         
                        console.log(data);                               
                    }
                    
                });   
            }                                                                           
        }); 

        function listado(){

            $("#listado").html('Por Favor Espere...');
                $.getJSON("{{ url('listado') }}", function(data){
                    $("#listado").html('');
                    $.each(data.data, function(i,f) {
                        $("#listado").append('<div class="d-flex text-muted pt-3">'+
                            '<svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">'+
                                '<title>Media</title>'+
                                '<rect width="100%" height="100%" fill="#007bff"/>'+
                                '<text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>'+
                            '</svg>'+
                            '<div class="pb-3 mb-0 small lh-sm border-bottom w-100">'+
                                '<div class="d-flex justify-content-between">'+
                                f.descripcion +
                                '<a href="#"><audio controls><source src="{{ url('/media').'/' }}'+ f.media +'" type="audio/mpeg"> Your browser does not support the audio element.</audio></a>'+
                                '</div>'+
                            '</div>'+
                        '</div>');
                    });
            });

        }

    });
</script>
        
@endsection