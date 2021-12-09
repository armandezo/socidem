<script src="views/assets/plugins/calendario/main.js"></script>
<script src='views/assets/plugins/calendario/locales-all.js'></script>
// document.addEventListener('DOMContentLoaded', function() {
//     var initialLocaleCode = 'es';
//     var calendarEl = document.getElementById('calendar');

//     var calendar = new FullCalendar.Calendar(calendarEl, {
//         headerToolbar: {
//             left: 'prev,next today',
//             center: 'title',
//             right: 'dayGridMonth,listWeek'
//         },
//         eventClick: function(info) {
            
//             var eventObj = info.event;
//             var token = eventObj.extendedProps.token;
//             var estatus = eventObj.extendedProps.status;
//             var id = eventObj.id;
//             var f_init = eventObj.startStr;
//             var f_end = eventObj.endStr;
//             var fecha_start = f_init.replace('Z', '');
//             var fecha_end = f_end.replace('Z', '');
 
//             if (estatus == "agendado"){ 
//                 alert("CITA RESERVADA POR FAVOR ELIGA OTRA");

//             }else {
                 
//                 modalCita(id, token, fecha_start, fecha_end);
//             }
           
           
//             info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
//          },
//         // hiddenDays: [ ] ,
//         timeZone: 'UTC',
//         initialDate: '2021-02-24',
//         initialView: 'listWeek',
//         editable: false,
//         locale: initialLocaleCode,
//         eventTimeFormat: { // like '14:30:00'
//             hour: '2-digit',
//             minute: '2-digit',
//             hour12: true
//         },
//         eventDidMount: function(info) {

//             switch (info.event.extendedProps.status) {
//                 case "libre":
//                     info.el.style.cssText = "background-color: #0098c1;";
//                     info.event.backgroundColor = "#0098c1";
                     
//                     break;
//                 case "agendado":
//                     info.el.style.cssText = "background-color: #ff7c00;";
//                     info.event.backgroundColor = "#ff7c00";
                    
//                     break;
//             }



//         },
        
//         nowIndicator: true,
//         navLinks: false, // can click day/week names to navigate views
//         dayMaxEvents: true, // allow "more" link when too many events
//         events: {
//             url: 'controller/dashboard/consulAgenda.controlador.php?token_med=<?=$routes[1] ?>',
//             failure: function() {

//             }
//         },
//         loading: function(bool) {
//             document.getElementById('loading').style.display =
//                 bool ? 'block' : 'none';
//         },

//     });

//     calendar.render();
// });


// function modalCita(id, token, fecha_start, fecha_end) {
//         $.ajax({
//             type: "POST",
//             url: "controller/dashboard/agenda.controlador.php",
//             data: {
//               valor: id,
//               secur: token,
//               fecha_start: fecha_start,
//               fecha_end: fecha_end
//             },            
//             success: function(data) {
//                 $('#cuerpo_cita').html(data);
//                 $('#agenda_cita').modal('show');
//             }
//         });
// }