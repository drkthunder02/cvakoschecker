<?php

function PrintTextAreaForm() {
    printf("<div class=\"container\">
                <div class=\"row\">
                    <form class=\"form-group\" method=\"POST\" action=\"processkos.php\">
                        <textarea name=\"names\" rows=\"10\" cols=\"50\"></textarea>
                        <input type=\"submit\" class=\"form-control\" value=\"Submit\"/>
                    </form<
                </div>
            </div>");
}

?>
