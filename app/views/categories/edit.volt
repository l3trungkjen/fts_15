{% extends 'layouts/index.volt' %}
{% block content %}
{{ get_content() }}
<h1>Edit Categories</h1>
<div class="row">
    <div class="span6 offset3">
        {{ form('categories/save', 'method': 'post', 'class': 'new_user') }}
            {{ hidden_field('id') }}
            <label for="user_full_name">Name</label>
            {{ text_field('name') }}
            <label for="user_email">Status</label>
            {{ select_status }}
            {{ submit_button('Save', 'class': 'btn btn-large btn-primary') }}
        {{ endform() }}
    </div>
</div>
{% endblock %}