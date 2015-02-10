{% extends 'layouts/index.volt' %}
{% block content %}
{{ get_content() }}
    <h1>Update your profile</h1>
    <div class="row">
        <div class="span6 offset3">
            {{ form('users/save', 'method': 'post') }}
                {{ hidden_field('id', 'value': user.id) }}
                <label for="user_full_name">Full name</label>
                {{ text_field('name', 'value': user.name) }}
                <label for="user_email">Email</label>
                {{ text_field('email', 'value': user.email) }}
                <label for="user_password">Password</label>
                {{ password_field('password') }}
                <label for="user_password_confirmation">Confirm Password</label>
                {{ password_field('re_password') }}
                <br> <br>
                {{ submit_button('Save changes', 'class': 'btn btn-large btn-primary') }}
            {{ endform() }}
        </div>
    </div>
{% endblock %}