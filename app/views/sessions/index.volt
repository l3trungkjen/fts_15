{% extends 'layouts/index.volt' %}
{% block content %}
    {{ get_content() }}
    <h1>Sign in</h1>
    <div class="row">
        <div class="span6 offset3">
            {{ form('sessions/create', 'method': 'post') }}
                <label>Email</label>
                {{ text_field('email') }}
                <label>Password</label>
                {{ password_field('password') }}
                {{ submit_button('Sign in', 'class': 'btn btn-large btn-primary') }}
            {{ endform() }}
            <p>New user? {{ link_to('signup', 'Sign up now!') }}</p>
        </div>
    </div>
{% endblock %}