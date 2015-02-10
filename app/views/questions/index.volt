{% extends 'layouts/index.volt' %}
{% block content %}
{{ get_content() }}
<table>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Answers</th>
        <th>Action</th>
    </tr>
    {% if count(questions) > 0 %}
        {% for question in questions %}
            <tr>
                <td>{{ question.id }}</td>
                <td>{{ link_to('questions/edit/' ~ question.id, question.name) }}</td>
                <td>{{ count(question.answers) }}</td>
                <td>
                    {{ link_to('questions/delete/' ~ question.id, 'Delete', 'onclick': "return confirm('Are you sure you want to delete this questions?')") }}
                </td>
            </tr>
        {% endfor %}
    {% else %}
        <tr>
            <td colspan="4">Data not found!!!</td>
        </tr>
    {% endif %}
</table>
{% endblock %}