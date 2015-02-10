{% block content %}
<h1>All examinations</h1>
    <label>Use the Ctrl key to select multiple</label>
    <br>
    <select id="subject_ids" multiple="multiple" name="subject_ids[]" style="display: inline-block; width: 200px;">
        <option value="1">MySQL</option>
        <option value="2">Ruby on Rails</option>
        <option value="3">MySQL Exercise</option>
        <option value="4">Git</option>
    </select>
    {{ link_to('#', 'id': 'start_new', 'class': 'btn btn-large btn-primary') }}
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