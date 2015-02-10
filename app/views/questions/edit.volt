{% extends 'layouts/index.volt' %}
{% block content %}
{{ get_content() }}
<h1>Create Questions</h1>
<div class="row">
    <div class="span6 offset3">
        {{ form('questions/save', 'method': 'post') }}
            {{ hidden_field('id', 'value': question.id) }}
            <div class="control-group">
                <label>Category name</label>
                <div class="controls">
                    {{ categories }}
                </div>
            </div>
            <div class="control-group">
                <label>Question name</label>
                <div class="controls">
                    {{ text_field('name', 'value': question.name) }}
                </div>
            </div>
            <div id="answer" class="control-group">
                <label>Answer name</label>
                {% for answer in answers %}
                    <div class="controls border_question">
                        {{ text_field('answer_name[' ~ answer.id ~ ']', 'value': answer.name) }}
                        {{ select_static('correct[' ~ answer.id ~ ']', ['0': 'Incorrect', '1': 'Correct']) }}
                    </div>
                {% endfor %}
            </div>
            <div class="control-group">
                <button class="btn btn-success dropdown-toggle" type="button" id="add_answer">+</button>
            <div>
            <div style="margin-top: 20px">
                {{ submit_button('Save', 'class': 'btn btn-large btn-primary', 'id': 'question_submit') }}
            </div>
        {{ endform() }}
    </div>
</div>
{% endblock %}