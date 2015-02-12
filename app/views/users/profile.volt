{% extends 'layouts/index.volt' %}
{% block content %}
    <h1>User</h1>
    <div class="row">
        <div class="span6 offset3">
            <span>Full name: {{ user.name }}</span><br>
            <span>Email: {{ user.email }}</span><br>
            <span>Admin: 
                {% if user.status == 1 %}
                    No
                {% else %}
                    Yes
                {% endif %}
            </span>
        </div>
    </div>
{% endblock %}