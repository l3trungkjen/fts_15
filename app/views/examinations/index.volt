{% extends 'layouts/index.volt' %}
{% block content %}
{{ get_content() }}
<h1>All Examinations</h1>
{{ form('', 'method': 'post', 'id': 'create_examinations') }}
    {{ select_static('categories[]', 'id': 'categories[]', categories, 'multiple': '', 'class': 'span4') }}
    {{ submit_button('Start new', 'class': 'btn btn-large btn-primary') }}
{{ endform() }}
<ul class="users" id="users">
    {% for examination in examinations %}
    <li>
        <span class="block bold width_2">{{ examination.examinations.created }}</span>
        <span class="block width_2">
            {{ (examination.examinations.status == 0) ? "Testing" : "Checked" }}
        </span>
        <ul>
            <li>
                <span class="block width_3">{{ examination.category_name }}</span>
                <span class="block width_1">{{ examination.examinations.result_question }}</span>
                <span class="block width_2">
                    {% if examination.examinations.datetime is not null %}
                        {{ formatDatetime(examination.examinations.datetime) }}
                    {% endif %}
                </span>
                <a href="/fts_15/examinations/edit/{{ examination.examinations.id }}">
                    {{ (examination.examinations.status == 0) ? "Start" : "View" }}
                </a>
            </li>
        </ul>
    </li>
    {% endfor %}
</ul>
{% endblock %}