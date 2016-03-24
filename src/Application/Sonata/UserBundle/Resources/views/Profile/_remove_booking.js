$(document).ready(function(){
        var booking_id = "{{booking_id}}";
        $('body').on('click', 'a[id=remove_booking][booking=' + booking_id + ']', function(){
            if (confirm('Вы действительно хотите удалить этот заказ?')) {
                $.ajax({
                    type: "POST",
                    url: "{{ path('remove_booking') }}",
                    data: {booking_id: booking_id},
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