$.fn.examinations = {}

$.fn.examinations.init = ()->
    $ document
        .on 'submit', '#create_examinations', $.fn.examinations.createExam

$.fn.examinations.createExam = (e)->
    e.preventDefault()
    $.ajax
        url: '/fts_15/examinations/create'
        type: 'POST'
        data: new FormData(this)
        contentType: false
        cache: false
        processData: false
        success: (data)->
            if data == null || data == ''
                alert('Please, Choose categories...')
            else
                $ '#users'
                    .html data

$.fn.examinations.clock = ()->
    intervalClock = setInterval(
        ()->
            timeValueCountDown = parseInt(
                $ '#time_value_count_down'
                    .val()
                )
            timeValueCountUp = parseInt(
                    $ '#time_value_count_up'
                        .val()
                )
            $.fn.examinations.stopClock(intervalClock) if timeValueCountDown < 0
            $ '#time'
                .html $.fn.examinations.timeValue(timeValueCountDown)
            $ '#time_value_count_down'
                .val timeValueCountDown - 1
            $ '#time_value_count_up'
                .val timeValueCountUp + 1
    , 1000) if parseInt(
        $ '#time_value_count_down'
            .val()
    ) > 0

$.fn.examinations.stopClock = (time)->
    clearInterval(time)
    alert 'Time has expired.'
    $ '#form_examination'
        .submit()

$.fn.examinations.timeValue = (time)->
    hour = parseInt time / (60 * 60) % 24
    minute = parseInt (time / 60) % 60
    second = parseInt time % 60
    if hour < 10
        _time_hour = '0' + hour
    else
        _time_hour = hour
    if minute < 10
        _time_minute = '0' + minute
    else
        _time_minute = minute
    if second < 10
        _time_second = '0' + second
    else
        _time_second = second
    _time_hour + ':' + _time_minute + ':' + _time_second