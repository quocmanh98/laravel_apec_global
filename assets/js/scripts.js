$(document).ready(function(){

    // delete modal
    $(function () {
        $('[data-method]').on('click', function(e){
            e.preventDefault();

            //form action
            var $action = $(this).attr('href');

            // manage form method
            $methodContent = '';
            $method = $(this).attr('data-method');

            if($method == 'delete' || $method == 'DELETE' ){
                $methodContent = '<input type="hidden" name="_method" value="DELETE">';
            }else if($method == 'put' || $method == 'PUT' ){
                $methodContent = '<input type="hidden" name="_method" value="DELETE">';
            }else if($method == 'patch' || $method == 'PATCH' ){
                $methodContent = '<input type="hidden" name="_method" value="PATCH">';
            }

            if($action === 'undefined'){
                return true;
            }

            // mode content
            var $html = '<input name="_token" type="hidden" value="'+ document.querySelector("meta[name='csrf-token']").content+'" >'+ $methodContent+ '<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title"></h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"></div><div class="modal-footer"><button type="submit" class="btn btn-primary"></button></div></div></div></div>';

            //create form
            var form_id = 'tempform_' + Math.random().toString(36).substr(2, 9);
            let form_element = document.createElement('form');
            form_element.method = 'post';
            form_element.id = form_id;
            // form action
            form_element.action = $action;

            //csrf tock element
            form_element.innerHTML = $html;
            document.body.appendChild(form_element);

            $modal = $('#' +form_id+ ' .modal');
            // change modal content
            $modal.find('.modal-title').html($(this).attr('data-confirm-title'));
            $modal.find('.modal-body').html($(this).attr('data-confirm-text'));
            $modal.find('.modal-footer button').text($(this).attr('data-confirm-button'));

            //change footer button for  delete action
            if($method == 'delete' || $method == 'DELETE' ){
                $modal.find('.modal-footer button').removeClass('btn-primary').addClass('btn-danger');
            }
            $modal.modal('show');
            //remove modal
            $modal.on('hidden.bs.modal', function (e) {
                e.target.parentNode.parentNode.removeChild(e.target.parentNode);
            });
        });
    });

    // change setting mail driver
    $(function () {
        $("[setting-tab='mail-smtp']").hide();
        if($("#setting_mail_driver").val() === 'smtp'){
            $("[setting-tab='mail-smtp']").show();
        }

        $("#setting_mail_driver").on('change', function () {
            $("[setting-tab]").fadeOut();
            if($(this).val() == 'smtp'){
                $("[setting-tab='mail-smtp']").fadeIn();
            }
        });
    });

    $('.popover-dismiss').popover({
        trigger: 'focus'
    })

    /**
     *  setting.
     */
    $("#app_settings [type='submit']").prop('disabled', false);

    $("#app_settings").on('submit', function (event) {

        // mail setting
        if( mailSettingPage !== undefined){
            event.preventDefault();

            $(function() {
                $("#app_settings [type='submit']").html('Wait 15 seconds <i class="fas fa-spinner fa-pulse"></i>');
                $("#app_settings [type='submit']").prop('disabled', true);
            });

            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                async: false,
                cache: false,
                timeout: 9000,
                data: $(this).serialize(),
                dataType: 'json',
                success: function () {
                    setTimeout(function () {
                        location.reload();
                    }, 5000);
                    return;
                },
                error:function(){
                    setTimeout(function () {
                        location.reload();
                    }, 15000);
                    return;
                }
            });
        }
    });

    //gradient line chart registrationHistoryChart
    if(jQuery('#registrationHistoryChart').length > 0 ){
        let draw = Chart.controllers.line.__super__.draw; //draw shadow

        const registrationHistoryChart = document.getElementById("registrationHistoryChart").getContext('2d');
        //generate gradient
        const registrationHistoryChartgradientStroke = registrationHistoryChart.createLinearGradient(500, 0, 100, 0);
        registrationHistoryChartgradientStroke.addColorStop(0, "rgba(26, 51, 213, 1)");
        registrationHistoryChartgradientStroke.addColorStop(1, "rgba(26, 51, 213, 0.5)");

        registrationHistoryChart.height = 100;

        new Chart(registrationHistoryChart, {
            type: 'line',
            data: {
                defaultFontFamily: 'Poppins',
                labels: chartjs.label,

                datasets: [
                    {
                        label: "New Users",
                        data: chartjs.value,
                        borderColor: registrationHistoryChartgradientStroke,
                        borderWidth: "2",
                        backgroundColor: 'transparent',
                        pointBackgroundColor: 'rgba(26, 51, 213, 0.5)'
                    }
                ]
            },
            options: {
                legend: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: 50,
                            min: 0,
                            stepSize: 5,
                            padding: 10
                        }
                    }]
                }
            }
        });
    }

    if(jQuery('#loginByOparationSys').length > 0 ){
        //doughut chart
        const loginByOparationSys = document.getElementById("loginByOparationSys").getContext('2d');
        loginByOparationSys.height = 100;
        new Chart(loginByOparationSys, {
            type: 'doughnut',
            data: loginPieChart,
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        })
    }
});

