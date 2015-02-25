{% if flag %}
    {% for examination in examinations %}
    <li>
        <span class="block bold width_2">{{ examination.examinations.created }}</span>
        <span class="block width_2">
            {{ (examination.examinations.status == 0) ? "Testing" : "Checked" }}
        </span>
        <ul>
            <li>
                <span class="block width_3">{{ examination.category_name }}</span>
                <span class="block width_1">{{ examination.examinations.result_question }}</span>
                <span class="block width_2">
                    {% if examination.examinations.datetime is not null %}
                        {{ formatDatetime(examination.examinations.datetime) }}
                    {% endif %}
                </span>
                <a href="/fts_15/examinations/edit/{{ examination.examinations.id }}">
                    {{ (examination.examinations.status == 0) ? "Start" : "View" }}
                </a>
            </li>
        </ul>
    </li>
    {% endfor %}
{% endif %}