$(document).ready(function(){
    var calendar = new FullCalendar.Calendar($('#calendar')[0],{
        plugins: [ 'dayGrid' ],
        events: '/getEventRange',
        eventDataTransform: function(eventData){
            var event = {
                title : eventData.name,
                start : eventData.eventStart,
                end : eventData.eventEnd,
                url: '/event/' + eventData.id
            };

            return event;
        }
    });

    calendar.render();
})