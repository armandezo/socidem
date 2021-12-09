(function($) {

    $.fn.rescalendar = function(options) {

            function alert_error(error_message) {

                return [
                    '<div class="error_wrapper">',

                    '<div class="thumbnail_image vertical-center">',

                    '<p>',
                    '<span class="error">',
                    error_message,
                    '</span>',
                    '</p>',
                    '</div>',

                    '</div>'
                ].join('');

            }

            function set_template(targetObj, settings) {

                var template = '',
                    id = targetObj.attr('id') || '';

                if (id == '' || settings.dataKeyValues.length == 0) {

                    targetObj.html(alert_error(settings.lang.init_error + ': No id or dataKeyValues'));
                    return false;

                }

                if (settings.refDate.length != 10) {

                    targetObj.html(alert_error(settings.lang.no_ref_date));
                    return false;

                }


                template = settings.template_html(targetObj, settings);

                targetObj.html(template);

                return true;

            };

            function dateInRange(date, startDate, endDate) {

                if (date == startDate || date == endDate) {
                    return true;
                }

                var date1 = moment(startDate, settings.format),
                    date2 = moment(endDate, settings.format),
                    date_compare = moment(date, settings.format);

                return date_compare.isBetween(date1, date2, null, '[]');

            }

            function dataInSet(data, name, date) {

                var obj_data = {};

                for (var i = 0; i < data.length; i++) {

                    obj_data = data[i];

                    if (
                        name == obj_data.name &&
                        dateInRange(date, obj_data.startDate, obj_data.endDate)
                    ) {

                        return obj_data;

                    }

                }

                return false;

            }

            function setData(targetObj, dataKeyValues, data, type) {

                var html = '',
                    dataKeyValues = settings.dataKeyValues,
                    data = settings.data,
                    arr_dates = [],
                    name = '',
                    content = '',
                    hasEventClass = '',
                    customClass = '',
                    classInSet = false,
                    tipo_calendario = settings.type,
                    obj_data = {};


                targetObj.find('td.day_cell').each(function(index, value) {

                    arr_dates.push($(this).attr('data-cellDate'));

                });

                for (var i = 0; i < dataKeyValues.length; i++) {

                    content = '';
                    date = '';
                    name = dataKeyValues[i];

                    html += '<tr class="dataRow">';
                    html += '<td class="firstColumn ajust_indice">' + name + '</td>';

                    for (var j = 0; j < arr_dates.length; j++) {

                        title = '';
                        date = arr_dates[j];
                        obj_data = dataInSet(data, name, date);

                        // var reserva_class = '';
                        if (typeof obj_data === 'object') {

                            if (obj_data.title) { title = ' title="' + obj_data.title + '" '; }


                            switch (obj_data.estado) {

                                case 'agendado':
                                    switch (tipo_calendario) {
                                        case 'med':
                                            reserva_class = 'reservado';
                                            desabled_class = 'disabled_class';
                                            obj_data.url = 'javascript:';
                                            onclik_event = '';
                                            break;

                                        case 'dash_med':
                                            reserva_class = 'reservado_med';
                                            desabled_class = 'disabled_class_med';
                                            obj_data.url = 'javascript:';
                                            onclik_event = 'onclick="abrirDetallesCli(&apos;' + obj_data.agenda + '&apos; )"';
                                            break;

                                        case 'paciente':
                                            reserva_class = 'reservado';
                                            desabled_class = 'disabled_class';
                                            obj_data.url = 'javascript:';
                                            onclik_event = '';
                                            break;
                                    }
                                    break;

                                case 'libre':
                                    var hora_init = moment(obj_data.title, 'h:mm');
                                    var hora_end = moment().format("h:mm");
                                    var et = moment('').format("D/MM/Y");

                                    if (hora_init.isBefore(hora_end) == false) {

                                        reserva_class = '';
                                        desabled_class = '';

                                        switch (tipo_calendario) {
                                            case 'med':
                                                onclik_event = 'onclick="elimAgenda(&apos;' + obj_data.id + '&apos; , &apos;' + obj_data.token + '&apos; )"';
                                                break;

                                            case 'dash_med':
                                                onclik_event = 'onclick="abrirDetallesCli(&apos;' + obj_data.agenda + '&apos; )"';
                                                break;

                                            case 'paciente':

                                                onclik_event = 'onclick="procesoCita(&apos;' + obj_data.id + '&apos; , &apos;' + obj_data.token + '&apos; , &apos;' + obj_data.startDate + '&apos; , &apos;' + obj_data.title + '&apos; ,  &apos;' + obj_data.time + ' &apos; ,  &apos;' + obj_data.tipo + '&apos;)"';
                                                break;
                                        }


                                    }
                                    break;

                                case 'exepcion':

                                    reserva_class = 'reservado aca';
                                    desabled_class = 'disabled_class';
                                    obj_data.url = 'javascript:';
                                    onclik_event = '';

                                    break;

                                case 'pendiente':

                                    switch (tipo_calendario) {
                                        case 'med':
                                            reserva_class = 'reservado';
                                            desabled_class = 'disabled_class';
                                            obj_data.url = 'javascript:';
                                            onclik_event = '';
                                            break;

                                        case 'dash_med':
                                            reserva_class = 'reservado_med';
                                            desabled_class = 'disabled_class_med';
                                            obj_data.url = 'javascript:';
                                            onclik_event = '';
                                            break;

                                        case 'paciente':
                                            reserva_class = 'reservado';
                                            desabled_class = 'disabled_class';
                                            obj_data.url = 'javascript:';
                                            onclik_event = '';
                                            break;
                                    }

                                    break;
                            }



                            // content = '<a class="' + desabled_class + ' "  href="' + obj_data.url + '" ' + title + '>' + obj_data.title + '</a>';
                            content = '<a class="' + desabled_class + ' "  ' + onclik_event + '  href="javascript:" ' + title + '>' + obj_data.title + '</a>';
                            hasEventClass = 'hasEvent';

                            if (obj_data.tipo == 'Online') {

                                customClass = obj_data.customClass + " " + "bg_tipo_online";

                            } else {

                                customClass = obj_data.customClass + " " + "bg_tipo_reservado";

                            }


                        } else {

                            switch (tipo_calendario) {
                                case 'med':
                                    content = '<a href="javascript:" onclick="AbrirAgenda(&apos;' + date + '&apos; , &apos;' + name + '&apos; )" class="no_data_new"> <i class="fas fa-clock"></i> </a>';
                                    break;

                                case 'dash_med':
                                    content = '<a href="javascript:"  class="no_data_new_dash_med"> <i class="fas fa-clock"></i> </a>';
                                    break;

                                case 'paciente':
                                    content = '<a  class="no_data"> - </a>';
                                    break;
                            }



                            hasEventClass = '';
                            customClass = '';
                            reserva_class = '';

                        }

                        //  ' + customClass + ' 

                        html += '<td data-date="' + date + '" data-name="' + name + '" class=" data_cell ' + hasEventClass + ' ' + customClass + '  ' + reserva_class + ' ">' + content + '</td>';
                    }

                    html += '</tr>';

                }

                targetObj.find('.rescalendar_data_rows').html(html);
            }

            function setDayCells(targetObj, refDate) {

                var format = settings.format,
                    f_inicio = moment(refDate, format).subtract(settings.jumpSize, 'days'),
                    f_fin = moment(refDate, format).add(settings.jumpSize, 'days'),
                    today = moment().startOf('day'),
                    html = '<td class="firstColumn "></td>',
                    f_aux = '',
                    f_aux_format = '',
                    dia = '',
                    dia_semana = '',
                    num_dia_semana = 0,
                    mes = '',
                    clase_today = '',
                    clase_middleDay = '',
                    clase_disabled = '',
                    middleDay = targetObj.find('input.refDate').val();

                for (var i = 0; i < (settings.calSize + 1); i++) {

                    clase_disabled = '';
                    moment.lang("es");
                    moment.lang('es', {
                        months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
                        monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
                        weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
                        weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
                        weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
                    });
                    f_aux = moment(f_inicio).add(i, 'days');
                    f_aux_format = f_aux.format(format);

                    dia = f_aux.format('DD');
                    mes = f_aux.locale(settings.locale).format('MMM').replace('.', '');
                    mescla = dia + ' ' + mes;
                    dia_semana = f_aux.locale(settings.locale).format('dddd');
                    num_dia_semana = f_aux.day();
                    // today class del dia <--- important
                    f_aux_format == today.format(format) ? clase_today = 'hoy_' : clase_today = '';
                    f_aux_format == middleDay ? clase_middleDay = 'middleDay' : clase_middleDay = '';



                    if (
                        settings.disabledDays.indexOf(f_aux_format) > -1 ||
                        settings.disabledWeekDays.indexOf(num_dia_semana) > -1
                    ) {

                        clase_disabled = 'disabledDay';
                    }


                    html += [
                        '<td class="day_cell ' + clase_today + ' ' + clase_middleDay + ' ' + clase_disabled + '" data-cellDate="' + f_aux_format + '">',

                        '<span class="dia_semana" id="' + clase_today + '"> ' + dia_semana + ' </span>',

                        '<span class="mes">' + mescla + '</span>',
                        '</td>'
                    ].join('');


                }

                targetObj.find('.rescalendar_day_cells').html(html);

                addTdClickEvent(targetObj);

                setData(targetObj)


            }

            function addTdClickEvent(targetObj) {

                var day_cell = targetObj.find('td.day_cell');

                day_cell.on('click', function(e) {

                    var cellDate = e.currentTarget.attributes['data-cellDate'].value;

                    targetObj.find('input.refDate').val(cellDate);

                    setDayCells(targetObj, moment(cellDate, settings.format));

                });

            }

            function change_day(targetObj, action, num_days) {

                var refDate = targetObj.find('input.refDate').val(),
                    f_ref = '';

                if (action == 'subtract') {
                    f_ref = moment(refDate, settings.format).subtract(num_days, 'days');
                } else {
                    f_ref = moment(refDate, settings.format).add(num_days, 'days');
                }

                targetObj.find('input.refDate').val(f_ref.format(settings.format));

                setDayCells(targetObj, f_ref);

            }

            // INITIALIZATION
            var settings = $.extend({
                id: 'rescalendar',
                format: 'YYYY-MM-DD',
                refDate: moment().format('YYYY-MM-DD'),
                startDate: moment().startOf('year'),
                jumpSize: 15,
                calSize: 30,
                locale: 'es',
                disabledDays: [],
                disabledWeekDays: [],
                dataKeyField: 'name',
                dataKeyValues: [],
                data: {},

                lang: {
                    'init_error': 'Error al iniciar',
                    'no_data_error': 'No se encontro Datos',
                    'no_ref_date': 'No referencia de Datos Ref.',
                    'today': 'Hoy'
                },

                template_html: function(targetObj, settings) {
                    $("#hoy_").text('Hoy');
                    // '<input class="refDate" type="text" value="' + refDate + '" />',
                    // '<button class="move_to_today"> ' + settings.lang.today + ' </button>',
                    var id = targetObj.attr('id'),
                        refDate = settings.refDate;
                    if (refDate) {

                    }
                    return [

                        '<div class="rescalendar ', id, '_wrapper">',

                        '<div class="rescalendar_controls">',


                        '<button class="move_to_yesterday dp-carousel-nav dp-carousel-nav-next circle bg-gray-dark">  <i class="svg-icon svg-icon-v2 svg-icon__caret-left svg-icon__size-16 svg-icon__color-white"><svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path d="M10.636 3.536c.351-.351.351-.921 0-1.273-.351-.351-.921-.351-1.273 0l-5.1 5.1c-.351.351-.351.921 0 1.273l5.1 5.1c.351.351.921.351 1.273 0 .351-.351.351-.921 0-1.273l-4.464-4.464 4.464-4.464z"></path></svg></i> </button>',


                        '<input class="refDate" type="hidden" value="' + refDate + '" />',


                        '<button class="move_to_tomorrow dp-carousel-nav dp-carousel-nav-next circle bg-gray-dark"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path d="M5.26360388,3.53639612 C4.91213204,3.18492422 4.91213204,2.61507578 5.26360388,2.26360388 C5.61507578,1.91213204 6.18492422,1.91213204 6.53639612,2.26360388 L11.6363961,7.36360388 C11.987868,7.71507578 11.987868,8.28492422 11.6363961,8.63639612 L6.53639612,13.7363961 C6.18492422,14.087868 5.61507578,14.087868 5.26360388,13.7363961 C4.91213204,13.3849242 4.91213204,12.8150758 5.26360388,12.4636039 L9.72720782,8 L5.26360388,3.53639612 Z"></path></svg> </button>',

                        '<br>',


                        '</div>',

                        '<table class="rescalendar_table">',
                        '<thead>',
                        '<tr class="rescalendar_day_cells"></tr>',
                        '</thead>',
                        '<tbody class="rescalendar_data_rows"  id="caja">',

                        '</tbody>',

                        '</table>',

                        '</div>',

                    ].join('');

                }

            }, options);




            return this.each(function() {
                $("#hoy_").text('Hoy');
                var targetObj = $(this);

                set_template(targetObj, settings);

                setDayCells(targetObj, settings.refDate);

                // Events
                var move_to_last_month = targetObj.find('.move_to_last_month'),
                    move_to_yesterday = targetObj.find('.move_to_yesterday'),
                    move_to_tomorrow = targetObj.find('.move_to_tomorrow'),
                    move_to_next_month = targetObj.find('.move_to_next_month'),
                    move_to_today = targetObj.find('.move_to_today'),
                    refDate = targetObj.find('.refDate');

                move_to_last_month.on('click', function(e) {

                    change_day(targetObj, 'subtract', settings.jumpSize);
                    $("#hoy_").text('Hoy');
                });

                move_to_yesterday.on('click', function(e) {

                    change_day(targetObj, 'subtract', 1);
                    $("#hoy_").text('Hoy');

                });

                move_to_tomorrow.on('click', function(e) {

                    change_day(targetObj, 'add', 1);
                    $("#hoy_").text('Hoy');

                });

                move_to_next_month.on('click', function(e) {

                    change_day(targetObj, 'add', settings.jumpSize);
                    $("#hoy_").text('Hoy');
                });

                refDate.on('blur', function(e) {

                    var refDate = targetObj.find('input.refDate').val();
                    setDayCells(targetObj, refDate);
                    $("#hoy_").text('Hoy');
                });

                move_to_today.on('click', function(e) {

                    var today = moment().startOf('day').format(settings.format);
                    targetObj.find('input.refDate').val(today);

                    setDayCells(targetObj, today);
                    $("#hoy_").text('Hoy');

                });

                return this;

            });

        } // end rescalendar plugin


}(jQuery));