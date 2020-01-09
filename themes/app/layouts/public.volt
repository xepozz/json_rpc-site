{%- set menus = [
    'Home': 'index'
] -%}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    {{ link_to(null, 'class': 'navbar-brand', 'Link Shorter') }}

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            {%- for key, value in menus %}
                {% if value == dispatcher.getControllerName() %}
                <li class="nav-item active">
                    {{ link_to(value, 'class': 'nav-link', key) }}
                </li>
                {% else %}
                <li class="nav-item">{{ link_to(value, 'class': 'nav-link', key) }}</li>
                {% endif %}
            {%- endfor -%}
        </ul>
    </div>
</nav>

<main role="main" class="flex-shrink-0">
    <div class="container">
        {{ content() }}
    </div>
</main>
