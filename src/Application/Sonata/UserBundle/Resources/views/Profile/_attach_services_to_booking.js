$(document).ready(function(){
        var booking_id = "{{booking_id}}";
        $('body').on('click', 'button[id=attach_services][booking=' + booking_id + ']', function(){
            var data = $('input[type=checkbox][booking=' + booking_id + ']:checked').serializeArray();
            if(data.length){
                var service_ids = [];
                $.each(data, function(index, value) {
                    service_ids.push(value['value']);
                });
            }
            $.ajax({
                type: "POST",
                url: "{{ path('attach_services_to_booking') }}",
                data: {service_ids: service_ids, booking_id: booking_id},
                success: function(data) {
                    window.location.reload();
                },
                error:  function(xhr, str){
                    alert("Возникла ошибка!");
                }
            });
        });
    }
);