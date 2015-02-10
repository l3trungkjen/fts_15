{% block content %}
<h1>All examinations</h1>
    <label>Use the Ctrl key to select multiple</label>
    <br>
    {{ select_static('category_id', categories, 'multiple': '', 'class': 'select_option') }}
    {{ link_to('#', 'Start New', 'id': 'start_new', 'class': 'btn btn-large btn-primary') }}
<ul class="users">
    <li>
        <span style="display: inline-block; width: 20%; font-weight: bold;">09/02/2015 07:51:53</span>
        <span style="display: inline-block; width: 20%;">Testing</span>
        <span style="display: inline-block; width: 20%;">&nbsp;</span>
        <span style="display: inline-block; width: 40%;">&nbsp;</span>
        <ul>
            <li>
                <span style="display: inline-block; width: 30%;">Git</span>
                <span style="display: inline-block; width: 10%;">&nbsp;</span>
                <span style="display: inline-block; width: 20%;">&nbsp;</span>
                <span style="display: inline-block; width: 10%;">
                    <a href="/examinations/663/answer_sheets/654/edit">Start</a>
                </span>
                <span style="display: inline-block; width: 25%;">&nbsp;</span>
            </li>
        </ul>
    </li>
</ul>
{% endblock %}