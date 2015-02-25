{% extends 'layouts/index.volt' %}
{% block content %}
{{ get_content() }}
<div>
    <div>
        <span>{{ examination.created }}</span>
        <div class="time">Time left: 
            <span id="time">00:00:00</span>
        </div>
    </div>
    {{ form('examinations/save', 'class': 'edit_answer_sheet', 'method': 'post', 'id': 'form_examination') }}
        <div class="title">
            {% if examination.datetime > 0 %}
                {% set time_count_down = 1200 - examination.datetime  %}
                {% set time_count_up = examination.datetime %}
            {% else %}
                {% set time_count_down = 1200  %}
                {% set time_count_up = 0  %}
            {% endif %}
            {{ category.name }}
            {{ hidden_field('time_value_count_up', 'value': time_count_up) }}
            {{ hidden_field('time_value_count_down', 'value': time_count_down) }}
            {{ hidden_field('examination_id', 'value': examination.id) }}
        </div>
        <ul>
            {% for key, question in questions %}
                <li class="margin_bottom">
                    <span>
                        <label class="float_left">{{ key + 1 }}.&nbsp;</label>
                        <pre>{{ question.name }}</pre>
                    </span>
                    <span class="block width_9">
                        <ul>
                            {% for answer in question.answers %}
                                <li>
                                    {{ radio_field('question_id[' ~ answer.question_id ~ ']', 'value': answer.id) }}
                                    {{ answer.name }}
                                </li>
                            {% endfor %}
                        </ul>
                    </span>
                </li>
            {% endfor %}
        </ul>
        <p>
            {{ submit_button('Submit', 'class': 'btn btn-large btn-primary') }}
        </p>
    {{ endform() }}
<script type="text/javascript">
    $(document).ready(function() {
        $.fn.examinations.clock();
    });
</script>
</div>
{% endblock %}