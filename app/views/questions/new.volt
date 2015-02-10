{% extends 'layouts/index.volt' %}
{% block content %}
{{ get_content() }}
<h1>Create Questions</h1>
<div class="row">
    <div class="span6 offset3">
        {{ form('questions/create', 'method': 'post') }}
            <div class="control-group">
                <label>Category name</label>
                <div class="controls">
                    {{ categories }}
                </div>
            </div>
            <div class="control-group">
                <label>Question name</label>
                <div class="controls">
                    {{ text_field('name') }}
                </div>
            </div>
            <div id="answer" class="control-group">
                <label>Answer name</label>
                <div class="controls border_question">
                    {{ text_field('answer_name[]') }}
                    {{ select_static('correct[]', ['0': 'Incorrect', '1': 'Correct']) }}
                </div>
            </div>
            <div class="control-group">
                <button class="btn btn-success dropdown-toggle" type="button" id="add_answer">+</button>
            <div>
            <div style="margin-top: 20px">
                {{ submit_button('Create', 'class': 'btn btn-large btn-primary', 'id': 'question_submit') }}
            </div>
        {{ endform() }}
    </div>
</div>
{% endblock %}