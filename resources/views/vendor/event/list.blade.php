@extends('layouts.app')
@section('content')
<div class="container">
<div class="card text-red" style="margin-top:2%;">

    <div class="ProfileStyleDroite" style="padding-top:0;">

        <div id="alert_tmeassage_area"></div>
        <div class="table-responsive" style="margin-bottom:-1.20%;">
            <table id="data_table" class="table">
                <thead>
                    <tr class="bg-light ProfileStyleDroite">
                        <th>#</th>
                        <th>Titre</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th class="text-right"></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
    <div class="text-right" style="margin-top:1%">
        <button id="create_event" type="button" class="btn btn-success btn-md buttonBleu"><i class="fa fa-plus"></i> Créer un évenement</button>
        <span id="sync">
        <button v-on:click="SynchroFlux" class="btn btn-success btn-md buttonBleu">Valider les modifications</button></span>
    </div>

</div>
                  <footer class="footer fixed-bottom">
  <small>© 2019 Copyright:
    <a href="{{ route('legals') }}"> My Help Mate </a> |
 <a href="{{ route('RGPD') }}"> Politique de confidentialité</a>
    </small>
  </footer>
<!-- View Event-->
<div class="container">
<div class="modal fade" id="view_event_modal" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content admin-form">
            <div class="modal-header ProfileStyleDroite">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                 <h4 class="modal-title" id="myModalLabel">Détails</h4>
            </div>
            <div class="modal-body ProfileStyleDroite">
                <div id="view_event_alert"></div>
                <div class="section row">
                    <div class="col-lg-12 col-12">
                        <div class="section row">
                            <div class="col-xl-12 col-12">
                                <label class=""></label>
                                <label for="" class="field"> <span id="view_event_title"></span>
                                </label>
                            </div>
                        </div>
                        <div class="section row">
                            <div class="col-xl-12 col-12">
                                <label class=""></label>
                                <label for="" class="field"> <span id="view_event_time"></span>
                                </label>
                            </div>
                        </div>
                        <div class="section row">
                            <div class="col-lg-12">
                                <label class=""></label>
                                <label for="" class="field"> <span id="view_event_description"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer ProfileStyleDroite">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Create Event -->
<div clas="container">
<div class="modal fade" id="create_event_modal" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header ProfileStyleDroite">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                 <h4 class="modal-title" id="myModalLabel">Créer un évenement</h4>
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
                                <div class="form-group ">
                                    <input type="text" name="event_start_date" required id="event_start_date"
                                    value="" class="form-control date_pick" placeholder="Date de départ">
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
                                    <input type="text" name="event_start_time" id="event_start_time" value=""
                                    class="form-control time_pick" placeholder="Heure de départ">
                                </div>
                            </div>
                        </div>
                        <div class="float-right">
                            <div class="col-xl-2 col-2"style="margin-bottom: 2%;">
                                <div id="end_date_toggle" >
                                    <button type="button" class="btn btn-md buttonBleu" onclick="add_end_date()" style="width: 117px"> <i class="text-success fa fa-plus"></i> Date de fin</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section row" id="end_date_area" style="display: none">
                        <!-- none-->
                        <div class="float-left" style="width:100%;">
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
                            <div class="col-xl-2 col-2" style="margin-bottom: 2%;">
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
<div class="modal fade" id="edit_event_modal" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content admin-form">
            <div class="modal-header ProfileStyleDroite">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                 <h4 class="modal-title" id="myModalLabel">Modifier l'évenement</h4>
            </div>
            <div class="modal-body ProfileStyleDroite">
                <div id="edit_event_alert"></div>
                <form id="edit_event_frm" action="" method="post" enctype="multipart/form-data">{{ csrf_field() }}
                    <div class="row">
                        <div class="col-xl-12 col-12">
                            <div class="form-group">
                                <label class="">Titre</label>
                                <input type="text" name="event_title" id="edit_event_title"
                                required class="form-control" placeholder="Titre">
                            </div>
                            <input type="hidden" id="edit_event_id" value="" name="id">
                            <input type="hidden" id="edit_set_start_time_data" value="Yes">
                            <input type="hidden" id="edit_set_end_time_data" value="Yes">
                            <input type="hidden" name="set_end_date_data" id="edit_set_end_date_data"
                            value="Yes">
                        </div>
                    </div>
                    <div class="row">
                        <div class="float-left" style="width: 100%;">
                            <div class="col-xl-5 col-12">
                                <div class="form-group">
                                    <label class="">Date de départ</label>
                                    <input type="text" name="event_start_date"
                                    required id="edit_event_start_date" value="" class="form-control date_pick"
                                    placeholder="Date de départ">
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
                                    id="edit_event_start_time" value="" class="form-control time_pick" placeholder="Heure de départ">
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
                                    value="" class="form-control date_pick" placeholder="Date de fin">
                                </div>
                            </div>
                            <div class="col-xl-2 col-2">
                                <div id="edit_end_time_toggle" class="mt30">
                                    <button type="button" class="btn btn-md buttonBleu" title="Remove End Time" onclick="edit_remove_end_time()"> <i class="text-danger fa fa-times"></i>
 <i class="text-danger fa fa-clock"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-xl-5 col-12" id="edit_event_end_time_area" style="display: block; margin-bottom: 1%;">
                                <div class="form-group">
                                    <label class="">Heure de fin</label>
                                    <input type="text" name="event_end_time" id="edit_event_end_time"
                                    value="" class="form-control time_pick" placeholder="End Time">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                  
                    
                    
                            <div class="form-group" style="padding-top:1%;">
                            
                                <textarea class="form-control" id="edit_event_description"
                                name="event_description" placeholder="Description"></textarea>
                            </div>
                        <div class="section" style="margin-top: 10px">
                        <p >
                            <button type="button" id="edit_event_btn" class="btn btn-primary buttonBleu">Modifier</button>
                            <button type="button" class="btn btn-md buttonBleu" onclick="edit_remove_end_date()"
                                style="width: 117px"> <i class="text-danger fa fa-times"></i> Supprimer</button>
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
 
       
        
        
    
      <script>

var loader='<img class="loader" src="<?php echo asset('vendor/event/image/ajax-loader.gif')?>"/>';
$(document).ready(function(){

get_data();
});


function get_data(){
      $('#data_table tbody').html(loader); 
       
    var event_url = "{{route('all-event')}}";
   
        $.get(event_url, function (r) {
                var html = '';
            var ad = $.parseJSON(r);
         
            $.each(ad, function(i,item){
                 html += '<tr>';
                html += '<td class="text-left">'+(i+1)+'</td>';
                html += '<td class="text-left">'+ad[i].title+'</td>';
                html += '<td>'+ad[i].start+ '</td>';	
                html += '<td>'+ad[i].event_description+'</td>';	
            
                html += '<td class="text-right">';
                html += '<a onclick="delete_event('+ad[i].events_id+')"  class="btn btn-sm  btn-danger"    href="javascript:;" ><i class="fa fa-trash"></i></a> ';
                html += '<a href="javascript:;"  onclick="edit_event('+ad[i].events_id+')"    class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> </a> ';
		html += '<a href="javascript:;"  onclick="view_event('+ad[i].events_id+')"     class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> </a> ';
                html += '</td>';
                html += '</tr>';
              })
	$('#data_table tbody').html(html);
        });
        

    }

   function view_event(event_id){
  
 $('#view_event_modal').modal({ 
 show: true
 });
      
   
     $('#view_event_alert').html(loader); 
      

    var view_html='';
           var single_event_url = "{{url('single-event')}}/"+event_id;
  
    
    $.get(single_event_url, function (r) {
            var edata = $.parseJSON(r);
       
     
           if(edata.id>0){
    
    
        $('#view_event_alert').html('');     

        $('#view_event_title').text(edata.event_title);

	var event_time=edata.event_start_date+' '+edata.event_start_time+' - '+edata.event_end_date+' '+edata.event_end_time;
	$('#view_event_time').text(event_time);
	
	$('#view_event_description').text(edata.event_description);

	   
             }  
         
             
	
        }); 
  
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
    
    $('#event_start_time').val('');
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
    
     $('#event_end_time').val('');
    var button='<button type="button" title="Add End Time"  class="btn btn-md buttonBleu"  onclick="add_end_time()"><i class="text-success fa fa-plus"></i>   <i class="text-success fa fa-clock"></i> </button>';
     $('#end_time_toggle').html(button);
       $('#event_end_time_area').hide();
  
}

   
                                     

function add_end_date(){
    $('#set_end_date_data').val('Yes');
    $('#event_end_time').val('');
    $('#end_date_toggle').hide();
    $('#end_date_area').show();
     
  
}



function remove_end_date(){
   
    $('#set_end_date_data').val('No');
     $('#event_end_date').val('');
     $('#event_end_time').val('');
    
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

       $('#create_event_alert').show().html('<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>End time must be bigger then Start time</div>');   
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
           
        
           $('#alert_tmeassage_area').show().html('<div class="alert '+jd.type+'"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+"Evenement ajouté !"/*jd.message*/+'</div>');     
           get_data();
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
    var button='<button type="button" title="Add Start Time" class="btn btn-md buttonBleu" onclick="edit_add_start_time()"><i class="text-success fa fa-plus"></i>  <i class="text-success fa fa-clock"></i></button>';
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
          get_data();
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
              $('#edit_event_alert').show().html('<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>End time must be bigger then Start time</div>');
              return false;    
             }else{
              return true; 
             }

         }else{
            return true; 
         }


}
  function delete_event(event_id){
        var token = '<?php echo csrf_token(); ?>';
        $.ajax({
            url: "{{url('delete-event')}}/"+event_id,
            type: 'DELETE',
            data: {
                "id": event_id,
                "_token": token,
            },
            success: function (response)
            {
            response = $.parseJSON(response);  
               if(response.type=='alert-success'){
                  $('#alert_tmeassage_area').show().html('<div class="alert '+response.type+'"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+response.message+'</div>');     
                  get_data();
               }else{    
                  $('#alert_tmeassage_area').show().html('<div class="alert '+response.type+'"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+response.message+'</div>');            

               }
            }
        });
   }



    </script>

    @endsection