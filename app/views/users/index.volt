{% extends 'layouts/index.volt' %}
{% block content %}
{{ get_content() }}
    <table>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created</th>
            <th>Admin</th>
            <th>Action</th>
        </tr>
        {% if count(users) > 0 %}
            {% for user in users %}
                <tr>
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.created }}</td>
                    <td>
                        {% if user.status == 1 %}
                            No
                        {% else %}
                            Yes
                        {% endif %}
                    </td>
                    <td>
                        {{ link_to('users/delete/' ~ user.id, 'Delete', 'onclick': "return confirm('Are you sure you want to delete?')") }}
                    </td>
                </tr>
            {% endfor %}
        {% else %}
            <tr>
                <td colspan="6">Data not found!!!</td>
            </tr>
        {% endif %}
    </table>
{% endblock %}