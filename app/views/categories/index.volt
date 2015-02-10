{% extends 'layouts/index.volt' %}
{% block content %}
{{ get_content() }}
    <table>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Created</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        {% if count(categories) > 0 %}
            {% for category in categories %}
                <tr>
                    <td>{{ category.id }}</td>
                    <td>{{ link_to('categories/edit/' ~ category.id, category.name) }}</td>
                    <td>{{ category.created }}</td>
                    <td>
                        {% if category.status == 0 %}
                            Inactive
                        {% else %}
                            Active
                        {% endif %}
                    </td>
                    <td>
                        {{ link_to('categories/delete/' ~ category.id, 'Delete', 'onclick': "return confirm('Are you sure you want to delete this item?')") }}
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