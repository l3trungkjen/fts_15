<html>
<head>
    <meta charset="UTF-8">
    <title>FTS_15</title>
    {% block css %}
        {{ stylesheet_link('css/bootstrap.css') }}
        {{ stylesheet_link('css/style.css') }}
    {% endblock %}
    {% block javascript %}
        {{ javascript_include('js/jquery.min.js') }}
        {{ javascript_include('js/bootstrap.min.js') }}
        {{ javascript_include('js/questions.js') }}
        {{ javascript_include('js/examinations.js') }}
        {{ javascript_include('js/javascript.js') }}
    {% endblock %}
</head>
<body>
    {{ partial('layouts/header') }}
    <div class="container">
        {% block content %}
            {{ get_content() }}
        {% endblock %}
    </div>
</body>
</html>