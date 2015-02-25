{% extends 'layouts/index.volt' %}
{% block content %}
{{ get_content() }}
<h1>Create Examinations</h1>
<div class="row">
    <div class="span6 offset3">
        {{ form('categories/create', 'method': 'post', 'id': 'user_created', 'class': 'new_user') }}
            <label for="user_full_name">Name</label>
            {{ text_field('name') }}
            <label for="user_email">Status</label>
            {{ select_status }}
            {{ submit_button('Create', 'class': 'btn btn-large btn-primary') }}
        {{ endform() }}
    </div>
</div>
{% endblock %}