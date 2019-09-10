@extends('layouts.app')
@section('content')
<div class="container">
      <div class="card" style="margin-top:2%">

    <div class="card-body ProfileStyleDroite">
        <div id="alert_tmeassage_area"></div>
        <div id="calendar"></div>
        <div class="buttonCalendar">
        <button id="create_event" type="button" class="btn btn-success btn-md buttonBleu"><i class="fa fa-plus"></i> Créer un Evénement</button>
        <span id="sync">
        <button v-on:click="SynchroFlux" class="btn btn-success btn-md buttonBleu">Valider les modifications</button></span>
    </div>
    </div>
</div>
</div>
<!-- Create Event -->
<div class="container">
<div class="modal fade " id="create_event_modal" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header ProfileStyleDroite">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                 <h4 class="modal-title" id="myModalLabel">Créer un nouvel événement</h4>
            </div>
            <div class="modal-body ProfileStyleDroite">
                <div id="create_event_alert"></div>
                <form id="create_event_frm" action="{{route('event')}}"
                method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-xl-12 col-12">
                            <div class="form-group">
                                <input type="text" name="event_title" id="event_title" required class="form-control"
                                placeholder="Titre">
                                <input type="hidden" name="user_id" id="user_id" required class="form-control"
                                value="{{Auth::user()->id}}">
                                <input type="hidden" id="set_start_time_data" value="No">
                                <input type="hidden" id="set_end_time_data" value="No">
                                <input type="hidden" name="set_end_date_data" id="set_end_date_data" value="No">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="float-left" style="width: 100%;">
                            <div class="col-xl-5 col-12">
                                <div class="form-group">
                                    <input type="text" name="event_start_date" required id="event_start_date"
                                    value="" class="form-control date_pick" placeholder="Date de depart">
                                </div>
                            </div>
                            <div class="col-xl-2 col-2" style="width: 100%; margin-bottom: 1%;">
                                <div id="start_time_toggle">
                                    <button type="button" class="btn btn-md buttonBleu" title="Add Start Time" onclick="add_start_time()"> <i class="text-success fa fa-plus"></i>
 <i class="text-success fa fa-clock"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-xl-5 col-12" id="event_start_time_area" style="display: none">
                                <!-- none-->
                                <div class="form-group">
                                    <input type="text" name="event_start_time" id="event_start_time" value="12:00 AM"
                                    class="form-control time_pick" placeholder="Heure de depart">
                                </div>
                            </div>
                        </div>
                        <div class="float-right">
                            <div class="col-xl-2 col-2"style="margin-bottom: 2%;">
                                <div id="end_date_toggle">
                                    <button type="button" class="btn btn-md buttonBleu" onclick="add_end_date()" style="width: 117px"> <i class="text-success fa fa-plus"></i> Date de fin</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section row" id="end_date_area" style="display: none">
                        <!-- none-->
                        <div class="float-left" style="width: 100%;">
                            <div class="col-xl-5 col-12">
                                <div class="form-group">
                                    <input type="text" name="event_end_date" id="event_end_date" value=""
                                    class="form-control date_pick" placeholder="Date de fin">
                                </div>
                            </div>
                            <div class="col-xl-2 col-2" style="margin-bottom: 2%;">
                                <div id="end_time_toggle" style="margin-bottom: 1%;">
                                    <button type="button" class="btn btn-md buttonBleu" title="Add End Time" onclick="add_end_time()"> <i class="text-success fa fa-plus"></i>
 <i class="text-success fa fa-clock"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-xl-5 col-12 " id="event_end_time_area" style="display: none; margin-bottom: 1%;">
                                <!-- //none-->
                                <input type="text" name="event_end_time" id="event_end_time" value=""
                                class="form-control time_pick" placeholder="Heure de fin">
                            </div>
                        </div>
                        <div class="float-right">
                            <div class="col-xl-2 col-2">
                                <button type="button" class="btn btn-md buttonBleu" onclick="remove_end_date()" style="width: 117px"> <i class="text-danger fa fa-times"></i> Supprimer</button>
                            </div>
                        </div>
                    </div>
                    <div class="section row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea class="form-control" id="event_description" name="event_description"
                                placeholder="Description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="section" style="margin-top: 10px">
                        <div class="text-right" id="event_image_error_msg"></div>
                        <p class="text-right">
                            <button type="button" id="create_event_btn" class="btn btn-primary buttonBleu">Confirmer</button>
                        </p>
                    </div>
                    <!-- end section row -->
                </form>
            </div>
            <div class="modal-footer ProfileStyleDroite">
                <button type="button" class="btn btn-secondary buttonBleu" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Edit Event -->
<div class="container">
<div class="modal fade" id="edit_event_modal" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content admin-form">
            <div class="modal-header ProfileStyleDroite">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                 <h4 class="modal-title" id="myModalLabel">Modifier l'èvenement</h4>
            </div>
            <div class="modal-body ProfileStyleDroite">
                <div id="edit_event_alert"></div>
                <form id="edit_event_frm" action="" method="post" enctype="multipart/form-data">{{ csrf_field() }}
                    <div class="row">
                        <div class="col-xl-12 col-12">
                            <div class="form-group">
                                <label class="">Titre</label>
                                <input type="text" name="event_title" id="edit_event_title"
                                required class="form-control" placeholder="Event Title">
                            </div>
                            <input type="hidden" id="edit_event_id" value="" name="id">
                            <input type="hidden" id="edit_set_start_time_data" value="Yes">
                            <input type="hidden" id="edit_set_end_time_data" value="Yes">
                            <input type="hidden" name="set_end_date_data" id="edit_set_end_date_data"
                            value="Yes">
                        </div>
                    </div>
                    <div class=" row">
                        <div class="float-left" style="width: 100%;">
                            <div class="col-xl-5 col-12">
                                <div class="form-group">
                                    <label class="">Date de départ</label>
                                    <input type="text" name="event_start_date"
                                    required id="edit_event_start_date" value="" class="form-control date_pick"
                                    placeholder="Start Date">
                                </div>
                            </div>
                            <div class="col-xl-2 col-2">
                                <div id="edit_start_time_toggle" class="mt30">
                                    <button type="button" class="btn btn-md buttonBleu" title="Remove Start Time" onclick="edit_remove_start_time()"> <i class="text-danger fa fa-times"></i>
 <i class="text-danger fa fa-clock"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-xl-5 col-12" id="edit_event_start_time_area" style="display: block">
                                <div class="form-group">
                                    <label class="">Heure de départ</label>
                                    <input type="text" name="event_start_time"
                                    id="edit_event_start_time" value="" class="form-control time_pick" placeholder="Start Time">
                                </div>
                            </div>
                        </div>
                        <div class="float-right">
                            <div class="col-xl-2 col-2">
                                <div id="edit_end_date_toggle" class="mt30" style="display: none">
                                    <button type="button" class="btn btn-md buttonBleu" onclick="edit_add_end_date()"
                                    style="width: 117px"> <i class="text-success fa fa-plus"></i> Date de fin</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="edit_end_date_area" style="display: block">
                        <div class="float-left" style="width: 100%;">
                            <div class="col-xl-5 col-12">
                                <div class="form-group">
                                    <label class="">Date de fin</label>
                                    <input type="text" name="event_end_date" id="edit_event_end_date"
                                    value="" class="form-control date_pick" placeholder="End Date">
                                </div>
                            </div>
                            <div class="col-xl-2 col-2">
                                <div id="edit_end_time_toggle" class="mt30">
                                    <button type="button" class="btn btn-md buttonBleu" title="Remove End Time" onclick="edit_remove_end_time()"> <i class="text-danger fa fa-times"></i>
 <i class="text-danger fa fa-clock"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-xl-5 col-12" id="edit_event_end_time_area" style="display: block; margin-bottom: 1%">
                                <div class="form-group">
                                    <label class="">Heure de fin</label>
                                    <input type="text" name="event_end_time" id="edit_event_end_time"
                                    value="" class="form-control time_pick" placeholder="End Time">
                                </div>
                            </div>
                        </div>
                        <div class="float-right">
                            <div class="col-xl-2 col-2 mt30">
                                <button type="button" class="btn btn-md buttonBleu" onclick="edit_remove_end_date()"
                                style="width: 117px"> <i class="text-danger fa fa-times"></i> Supprimer</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="">Description</label>
                                <textarea class="form-control" id="edit_event_description"
                                name="event_description" placeholder="Description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="section" style="margin-top: 10px">
                        <p class="text-right">
                            <button type="button" id="edit_event_btn" class="btn btn-primary buttonBleu">Modifier</button>
                        </p>
                    </div>
                    <!-- end section row -->
                </form>
            </div>
            <div class="modal-footer ProfileStyleDroite">
                <button type="button" class="btn btn-secondary buttonBleu" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
      </div>  

   
<script>
 var loader='<img class="loader" src="<?php echo asset('vendor/event/image/ajax-loader.gif')?>"/>';     
 var calender_data_url = "{{route('all-event')}}";
     
    $( document ).ready(function() {
         
     $(function() {
  $('#calendar').fullCalendar({
     height: 800,
    header: {
        left: 'month,agendaWeek,agendaDay custom1',
        center: 'title',
        right: 'custom2 prevYear,prev,next,nextYear'
      },
      footer: {
        left: 'custom1,custom2',
        center: '',
        right: 'prev,next'
      },  
       events: window.calender_data_url,
 
  	   axisFormat: 'h:mm',
	    timeFormat: 'HH:mm',	
            editable: false,
            droppable: false,
            eventTextColor:"#000000",
	    eventColor:"#FFF",
            selectable: true,
            selectHelper: true,
            eventLimit: 4,
            eventDurationEditable: false,
            
            eventClick: function (event, jsEvent, view) {
             edit_event(event.events_id);
            } 
 
 
  })

});
});


  function reloadCalender(mode)
    {
    $('#calendar').fullCalendar( 'removeEvents');
    $('#calendar').fullCalendar( 'addEventSource', calender_data_url);         
     $('#calendar').fullCalendar( 'rerenderEvents' );
}


   $("#create_event").click(function(){

        $('#create_event_alert').html('');
        $('#create_event_frm').parsley().reset();
        $("#create_event_frm")[0].reset();
      
       
     $('#create_event_modal').modal({ 
 show: true
	 });
         
    });
    
    
    
    	  $('.date_pick').datetimepicker({
	format: 'DD/MM/YYYY',			
               pickTime: false
              
            });
            
         $('.time_pick').datetimepicker({
			pickDate: false
            });      



function add_start_time(){
    $('#set_start_time_data').val('Yes');
     $('#event_start_time').val('');
    
    var button='<button type="button" title="Remove Start Time"   class="btn btn-md buttonBleu"  onclick="remove_start_time()"><i class="text-danger fa fa-times"></i>   <i class="text-danger fa fa-clock"></i> </button>';
     $('#start_time_toggle').html(button);
        $('#event_start_time_area').show();
     
  
}


function remove_start_time(){
    $('#set_start_time_data').val('No');
    
    $('#event_start_time').val('12:00 AM');
    var button='<button type="button" title="Add Start Time"  class="btn btn-md buttonBleu"  onclick="add_start_time()"><i class="text-success fa fa-plus"></i>   <i class="text-success fa fa-clock"></i> </button>';
     $('#start_time_toggle').html(button);
       $('#event_start_time_area').hide();
  
}


function add_end_time(){
    $('#set_end_time_data').val('Yes');
     $('#event_end_time').val('');
    
    var button='<button type="button"  title="Remove End Time"  class="btn btn-md buttonBleu"  onclick="remove_end_time()"><i class="text-danger fa fa-times"></i>   <i class="text-danger fa fa-clock"></i> </button>';
     $('#end_time_toggle').html(button);
        $('#event_end_time_area').show();
     
  
}


function remove_end_time(){
    $('#set_end_time_data').val('No');
    
     $('#event_end_time').val('11:59 PM');
    var button='<button type="button" title="Add End Time"  class="btn btn-md buttonBleu"  onclick="add_end_time()"><i class="text-success fa fa-plus"></i>   <i class="text-success fa fa-clock"></i> </button>';
     $('#end_time_toggle').html(button);
       $('#event_end_time_area').hide();
  
}

   
                                     

function add_end_date(){
    $('#set_end_date_data').val('Yes');
    $('#event_end_time').val('11:59 PM');
    $('#end_date_toggle').hide();
    $('#end_date_area').show();
     
  
}



function remove_end_date(){
   
    $('#set_end_date_data').val('No');
     $('#event_end_date').val('');
     $('#event_end_time').val('11:59 PM');
    
    $('#end_date_toggle').show();
     $('#end_date_area').hide();
     
  
}
function date_compare(){
     var event_start_date = $('#event_start_date').val().split("/");
      var event_start_time=$('#event_start_time').val();
      var start_data=event_start_date[2]+' '+event_start_date[1]+' '+event_start_date[0]+' '+event_start_time ;
      var start_time = new Date(start_data).getTime();
  
  
      var event_end_date = $('#event_end_date').val().split("/");
      var event_end_time=$('#event_end_time').val();
      var end_data=event_end_date[2]+' '+event_end_date[1]+' '+event_end_date[0]+' '+event_end_time ;
      var end_time = new Date(end_data).getTime();
      $("#create_event_alert").html('');
     
   if($('#set_end_date_data').val()=="Yes"){
    
    if(start_time>end_time){

       $('#create_event_alert').show().html('<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>La date de fin doit être supérieure a la date de départ</div>');   
    return false;
     //   return false;
        
    }else{
         return true; 
    }
   
}else{
       return true; 
}


}
$("#create_event_btn").click(function(){
     var set_start_time=$('#set_start_time_data').val();
       if(set_start_time=='Yes'){
         $('#event_start_time').attr('required', 'required');
     }else{
         $('#event_start_time').removeAttr('required');
     }
     
     
     
     
     var set_end_date=$('#set_end_date_data').val();
     if(set_end_date=='Yes'){
         $('#event_end_date').attr('required', 'required');
     }else{
         $('#event_end_date').removeAttr('required');
     }
     
     
     
      var set_end_time=$('#set_end_time_data').val();
       if(set_end_time=='Yes'){
         $('#event_end_time').attr('required', 'required');
     }else{
         $('#event_end_time').removeAttr('required');
     }
     
 
     
if($('#create_event_frm').parsley().validate()==true  && date_compare()==true ){
  
  //$('#create_event_frm').submit();
$('#create_event_alert').show().html(loader); 

var action="{{route('event')}}";
var formData = new FormData($('#create_event_frm')[0]);
      $.ajax({
     type: "POST",
     url: action,
     data: formData,
     contentType: false,
     processData: false,
     async: false,
        success: function(feedback) {
            
               var jd = $.parseJSON(feedback);  
         
         if(jd.type=='alert-success'){
           $("#create_event_frm")[0].reset(); 
           $('#create_event_modal').modal('hide');
           $('#create_event_alert').show().html('');   
           
        
           $('#alert_tmeassage_area').show().html('<div class="alert '+jd.type+'"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+jd.message+'</div>');     
           reloadCalender();
          }else{
              
         
         var msg ='';  
         
           $.each(jd.error, function( key, value ){
               msg +=value+'</br>';  
              });
     
         $('#create_event_alert').show().html('<div class="alert '+jd.type+'"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+msg+'</div>');            
           
         
      
        

        } 
           
         }
   
       
    });
 
  
  }
});

function edit_event(event_id){
  

   	  $('#edit_event_modal').modal({ 
 show: true
	 });
        $('#edit_event_frm').parsley().reset();
        $("#edit_event_frm")[0].reset();  
         
 $('#edit_event_alert').html(loader); 
    var view_html='';
   
      var single_event_url = "{{url('single-event')}}/"+event_id;
        
    
    $.get(single_event_url, function (r) {
            var edata = $.parseJSON(r);
       
        
            
           if(edata.id>0){
    
    
        $('#edit_event_alert').html('');     
	$('#edit_event_id').val(edata.id);
        $('#edit_event_title').val(edata.event_title);

	
	$('#edit_event_start_date').val(edata.event_start_date);
	$('#edit_event_start_time').val(edata.event_start_time);

        $('#edit_event_end_date').val(edata.event_end_date);
	$('#edit_event_end_time').val(edata.event_end_time);

       
	$('#edit_event_description').val(edata.event_description);

	   
             }  
         
             
	
        }); 
  
   }




function edit_add_start_time(){
    $('#edit_set_start_time_data').val('Yes');
     $('#edit_event_start_time').val('');
    
    var button='<button type="button" title="Remove Start Time"   class="btn btn-md buttonBleu"  onclick="edit_remove_start_time()"><i class="text-danger fa fa-times"></i>   <i class="text-danger fa fa-clock"></i> </button>';
     $('#edit_start_time_toggle').html(button);
        $('#edit_event_start_time_area').show();
     
  
}


function edit_remove_start_time(){
    $('#edit_set_start_time_data').val('No');
    
    $('#edit_event_start_time').val('12:00 AM');
    var button='<button type="button"  title="Add Start Time"  class="btn btn-md buttonBleu"  onclick="edit_add_start_time()"><i class="text-success fa fa-plus"></i>   <i class="text-success fa fa-clock"></i> </button>';
     $('#edit_start_time_toggle').html(button);
       $('#edit_event_start_time_area').hide();
  
}


function edit_add_end_time(){
    $('#edit_set_end_time_data').val('Yes');
     $('#edit_event_end_time').val('');
    
    var button='<button type="button" title="Remove End Time"   class="btn btn-md buttonBleu"  onclick="edit_remove_end_time()"><i class="text-danger fa fa-times"></i>   <i class="text-danger fa fa-clock"></i> </button>';
     $('#edit_end_time_toggle').html(button);
        $('#edit_event_end_time_area').show();
     
  
}


function edit_remove_end_time(){
    $('#edit_set_end_time_data').val('No');
    
     $('#edit_event_end_time').val('11:59 PM');
    var button='<button type="button" title="Add End Time"   class="btn btn-md buttonBleu"  onclick="edit_add_end_time()"><i class="text-success fa fa-plus"></i>   <i class="text-success fa fa-clock"></i> </button>';
     $('#edit_end_time_toggle').html(button);
       $('#edit_event_end_time_area').hide();
  
}

   
                                     

function edit_add_end_date(){
    $('#edit_set_end_date_data').val('Yes');
    $('#edit_event_end_time').val('11:59 PM');
    
    $('#edit_end_date_toggle').hide();
     $('#edit_end_date_area').show();
     
  
}



function edit_remove_end_date(){
   
    $('#edit_set_end_date_data').val('No');
     $('#edit_event_end_date').val('');
    $('#edit_event_end_time').val('11:59 PM');
    
    $('#edit_end_date_toggle').show();
     $('#edit_end_date_area').hide();
     
  
}



$("#edit_event_btn").click(function(){
     var set_start_time=$('#edit_set_start_time_data').val();
       if(set_start_time=='Yes'){
         $('#edit_event_start_time').attr('required', 'required');
     }else{
         $('#edit_event_start_time').removeAttr('required');
     }
     
     
     
     
     var set_end_date=$('#edit_set_end_date_data').val();
     if(set_end_date=='Yes'){
         $('#edit_event_end_date').attr('required', 'required');
     }else{
         $('#edit_event_end_date').removeAttr('required');
     }
     
     
     
      var set_end_time=$('#edit_set_end_time_data').val();
       if(set_end_time=='Yes'){
         $('#edit_event_end_time').attr('required', 'required');
     }else{
         $('#edit_event_end_time').removeAttr('required');
     }
     
     
   
 
     
     
if($('#edit_event_frm').parsley().validate()==true  && edit_date_compare()==true ){
  
   // $('#edit_event_frm').submit();
$('#edit_event_alert').show().html(loader); 
var action="{{url('update-event')}}";
var formData = new FormData($('#edit_event_frm')[0]);
      $.ajax({
     type: "POST",
     url: action,
     data: formData,
     contentType: false,
     processData: false,
     async: false,
        success: function(feedback) {
         var jd = $.parseJSON(feedback);  
         
         
         if(jd.type=='alert-success'){
           $("#edit_event_frm")[0].reset(); 
           $('#edit_event_modal').modal('hide');
           $('#edit_event_alert').show().html('');   
           
        
           $('#alert_tmeassage_area').show().html('<div class="alert '+jd.type+'"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+jd.message+'</div>');     
           reloadCalender();
          }else{
              
         
         var msg ='';  
         
           $.each(jd.error, function( key, value ){
               msg +=value+'</br>';  
              });
     
         $('#edit_event_alert').show().html('<div class="alert '+jd.type+'"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+msg+'</div>');            
           
         

        }
         }
   
       
    });
 
  
  }
});


function edit_date_compare(){
     var event_start_date = $('#edit_event_start_date').val().split("/");
      var event_start_time=$('#edit_event_start_time').val();
      var start_data=event_start_date[2]+' '+event_start_date[1]+' '+event_start_date[0]+' '+event_start_time ;
      var start_time = new Date(start_data).getTime();
  
  
      var event_end_date = $('#edit_event_end_date').val().split("/");
      var event_end_time=$('#edit_event_end_time').val();
      var end_data=event_end_date[2]+' '+event_end_date[1]+' '+event_end_date[0]+' '+event_end_time ;
      var end_time = new Date(end_data).getTime();
      $("#edit_event_alert").html('');
     
   if($('#edit_set_end_date_data').val()=="Yes"){
    
    if(start_time>end_time){


       $('#edit_event_alert').show().html('<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>La date de fin doit être supérieure a la date de départ</div>');            
          
    return false;
     //   return false;
        
    }else{
         return true; 
    }
   
}else{
       return true; 
}


}

    </script>
   
@endsection
