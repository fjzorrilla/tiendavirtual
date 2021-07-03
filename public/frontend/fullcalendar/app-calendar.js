/* Calendar */
/*-------- */

$(document).ready(function () {

  fetchCalendar();
  var csrf_token = $('meta[name=csrf-token]').attr('content');

})
function fetchCalendar(){
  var Calendar = FullCalendar.Calendar;
  var Draggable = FullCalendarInteraction.Draggable;
  var containerEl = document.getElementById('external-events');
  var calendarEl = document.getElementById('fc-external-drag');
  var checkbox = document.getElementById('drop-remove');

  //  Basic Calendar Initialize
  var basicCal = document.getElementById('basic-calendar');
 
   var eventosList = []
   $('#external-events .fc-event').each(function () {
     
    $(this).css({ 'backgroundColor': $(this).data('color'), 'borderColor': $(this).data('color') });
  });
  var colorData;
  $('#external-events .fc-event').mousemove(function () {
    colorData = $(this).data('color');
  })
  // Draggable event init
  new Draggable(containerEl, {
    itemSelector: '.fc-event',
    eventData: function (eventEl) {
      return {
        title: eventEl.innerText,
        color: colorData
      };
    }
  });
  
  $.ajax({
    url: 'calendarAjax',
    method: "GET",
    data: {
        
    }
  })
  .done(function(data) {
    data.data.forEach(function(value, i) {
        
        if(value.evento == 'Liberar Domingo'){
          var colorevent = '#5bff95'
        }else{
          var colorevent = '#ff4081'
        }
      
        var listE = {
          id: value.id,
          title: value.evento,
          start: value.start,
          end: value.end,
          backgroundColor: colorevent
        }

        eventosList.push(listE)
    });
    data.ordenes.forEach(function(value, i) {
        
        var coloreventCompra = '#CCC'
      
        var listCompra = {
          id: value.id,
          title: "PEDIDO",
          start: value.dayDelivery,
          end: value.dayDelivery,
          backgroundColor: coloreventCompra
        }
        eventosList.push(listCompra)
    });
    $("#fc-external-drag").html('')
    var calendar = new Calendar(calendarEl, {
      header: {
        left: 'prev,next today',
        center: 'title',
        right: ""
      },
      editable: true,
      locale: 'es',
      plugins: ["dayGrid", "timeGrid", "interaction"],
      droppable: true,
      events: eventosList,
      slotEventOverlap: false,
      drop: function (info) {
        
        $.ajax({
          url: "calendarInsertAjax",
          method: "POST",
          data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            start: info.dateStr,
            end: info.dateStr,
            evento: info.draggedEl.innerHTML,
          }
        })
        .done(function(data) {
          swal({
              title: "Evento Agregado Exitosamente.",
              text: "",
              icon: "success",
              buttons: false,
              dangerMode: false,
          })
          location.reload();
        })
        .fail(function(error) {
          swal({
              title: "Error al registrar el evento.",
              text: "",
              icon: "error",
              buttons: false,
              dangerMode: false,
          })
        });
      },
      eventClick: function(info) {
        if(info.event.title == 'PEDIDO'){
          return
        }
        swal({
            title: "Estas Seguro?",
            text: "Una vez eliminados, no podrá recuperar estos datos!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                  url: "calendarDeleteAjax",
                  method: "POST",
                  data: {
                      _token: $('meta[name="csrf-token"]').attr('content'),
                      id: info.event.id,
                  }
                })
                .done(function(data) {
                   location.reload()
                })
                .fail(function(error) {
                  console.log(error)
                });
            } else {
                swal("¡Tus datos están seguros!");
            }
        });
        
      },
      eventResize: function(info) {
        return
      },
      eventOverlap: function(stillEvent, movingEvent) {
        if(stillEvent)
          return false
      },
      eventDrop: function(info) {
        if(info.event.title == 'PEDIDO'){
          return
        }
        $.ajax({
          url:  "calendarUpdateAjax",
          method: "POST",
          data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: info.event.id,
            start: moment(info.event.start).format('YYYY/MM/DD'),
            end: info.event.end ? moment(info.event.end).format('YYYY/MM/DD') : moment(info.event.start).format('YYYY/MM/DD')
          }
        })
        .done(function(data) {
           
        })
        .fail(function(error) {
          console.log(error)
        });
      },
    });
    calendar.render(); 
  })
  .fail(function(error) {
    console.log(error)
  });  
}
