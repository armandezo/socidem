function lobby(id, type) {
    $.ajax({
        type: "POST",
        url: "controller/dashboard/conference.controlador.php",
        data: {
            id: id
        },
        beforeSend: function() {


        },
        error: function() {

        },
        success: function(data) {

            $(".cargando").remove();
            $("#meet").addClass("ajust_height");

            if (data['estado_cita'] == 2) {

                alert("conferencia concluida");

            } else {

                const domain = 'meet.jit.si';

                const options = {
                    roomName: data['room'],
                    userInfo: {
                        email: data['email'],
                        displayName: data['nombre']
                    },
                    configOverwrite: {
                        prejoinPageEnabled: false
                    },
                    parentNode: document.querySelector('#meet')
                };

                const api = new JitsiMeetExternalAPI(domain, options);

                api.addEventListener('participantRoleChanged', function(event) {
                    var pass = String(data['pass']);
                    if (event.role === "moderator") {
                        api.executeCommand('password', '');
                    }
                });
                document.addEventListener('DOMContentLoaded', () => {

                    var sec = data['timer'],
                        countDiv = document.getElementById("timer"),
                        secpass,
                        countDown = setInterval(function() {
                            'use strict';

                            secpass();
                        }, 1000);

                    function secpass() {
                        'use strict';

                        var min = Math.floor(sec / 60),
                            remSec = sec % 60;

                        if (remSec < 10) {

                            remSec = '0' + remSec;

                        }
                        if (min < 10) {

                            min = '0' + min;

                        }
                        countDiv.innerHTML = min + ":" + remSec;

                        if (sec > 0) {

                            sec = sec - 1;

                        } else {

                            clearInterval(countDown);
                            api.dispose();
                            countDiv.innerHTML = 'countdown done';

                        }
                    }
                });

            }





        }
    });



}



//