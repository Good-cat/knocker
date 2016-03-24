$(document).ready(function(){
        var service_id = "{{service_id}}";
        var booking_id = "{{booking_id}}";
        $('body').on('click', 'a[for=detach][service=' + service_id + ']', function(){
            if (confirm('Вы действительно хотите удалить услугу из заказа?')) {
                $.ajax({
                    type: "POST",
                    url: "{{ path('detach_service_from_booking') }}",
                    data: {service_id: service_id, booking_id: booking_id},
                    success: function(data) {
                        window.location.reload();
                    },
                    error:  function(xhr, str){
                        alert("Возникла ошибка!");
                    }
                });
            }
        });
    }
);