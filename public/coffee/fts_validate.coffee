fst_func = ->
    user_created = ->
        $ '#user_created'
            .validate
                rules:
                    name:
                        require: true
                    email:
                        require: true
                        email: true
                    password:
                        require: true
                    password_confirmation:
                        require: true
                        equalTo: '#password'
    init: ->
        user_created()