$.fn.questions = {}

$.fn.questions.init = ()->
    $ document
        .on 'click', '#add_answer', $.fn.questions.addAnswer

$.fn.questions.addAnswer = ()->
    $ '#answer'
        .append '<div class="controls border_question">
                    <input type="text" name="answer_name[]">
                    <select name="correct[]">
                        <option value="0">Incorrect</option>
                        <option value="1">Correct</option>
                    </select></div>'

$.fn.questions.validate = ()->
    $ '#question_create'
        .validate 
            rules:
                category_id:
                    require: true
                name:
                    require: true
                'answer_name[]':
                    require: true