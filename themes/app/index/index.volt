<h1 class="mt-3">Short a link</h1>

{{ flashSession.output() }}

<form method="post">
    <div class="form-group row">
        <div class="col-sm-4">
            {{ form.render('link', ['class': 'form-control', 'placeholder': 'Link']) }}
        </div>
    </div>

    {{ submit_button("Short", "class": "btn btn-success") }}
</form>
