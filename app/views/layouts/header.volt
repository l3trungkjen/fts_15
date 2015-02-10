<header class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <a href="index" id="logo">Home</a>
            <nav>
                <ul class="nav pull-right">
                    {% if session.has('user_id') AND session.has('email') AND session.get('status') == 2 %}
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                Categories<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>{{ link_to('categories/new', 'Add new') }}</li>
                                <li>{{ link_to('categories', 'Show All') }}</li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                Questions<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>{{ link_to('questions/new', 'Add new') }}</li>
                                <li>{{ link_to('questions', 'Show all') }}</li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                Examinations<b class="caret"></b>
                            </a>
                        </li>
                    {% endif %}
                    {% if session.has('user_id') AND session.has('email') %}
                        <li id="fat-menu" class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                {{ user.name }} <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>{{ link_to('users/profile/' ~ user.id, 'Profile') }}</li>
                                <li>{{ link_to('users/edit/' ~ user.id, 'Settings') }}</li>
                                <li class="divider"></li>
                                <li>
                                    {{ link_to('logout', 'Sign out') }}
                                </li>
                            </ul>
                        </li>
                    {% else %}
                        <li>{{ link_to('signin', 'Sign in') }}</li>
                    {% endif %}
                </ul>
            </nav>
        </div>
    </div>
</header>