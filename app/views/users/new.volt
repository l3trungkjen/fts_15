{% extends 'layouts/index.volt' %}
{% block content %}
{{ get_content() }}
<h1>Sign up</h1>
<div class="row">
    <div class="span6 offset3">
        {{ form('users/create', 'method': 'post', 'id': 'user_created', 'class': 'new_user') }}
            <label for="user_full_name">Full name</label>
            {{ text_field('name') }}
            <label for="user_email">Email</label>
            {{ text_field('email') }}
            <label for="user_password">Password</label>
            {{ password_field('password') }}
            <label for="user_password_confirmation">Confirmation</label>
            {{ password_field('re_password') }}
            {{ submit_button('Create my account', 'class': 'btn btn-large btn-primary') }}
        {{ endform() }}
    </div>
</div>
{% endblock %}