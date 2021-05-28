<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brainf**k to php</title>
</head>
<body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <textarea name="bf_code" id="bf_code" cols="30" rows="10"></textarea>
        <br>
        <button type="submit">Parse</button>
    </form>


    <?php

        $equilavent_code = [
            '>' => '$ptr += 1;',
            '<' => '$ptr -= 1;',
            '+' => '$memory[$ptr] += 1;',
            '-' => '$memory[$ptr] -= 1;',
            '.' => 'echo(chr($memory[$ptr]));',
            ',' => '$memory[$ptr] = get_next_char();',
            '[' => 'while ($memory[$ptr] != 0) {',
            ']' => '}',
        ];

        $allowed_symbols = ['>', '<', '+', '-', '.', ',', '[', ']'];

        $inputs = [
            1, 3, 5, 6, 1,
        ];

        $inputs_ptr = 0;

        function parse_bf($bf_code) {
            global $equilavent_code;
            global $allowed_symbols;
            
            $symbols = str_split($bf_code);
            
            foreach ($symbols as $symbol) {
                if (!in_array($symbol, $allowed_symbols)) {
                    continue;
                }

                echo($equilavent_code[$symbol]);
                echo("<br>");
            }
        }
        
        function get_next_char() {
            global $inputs;
            global $inputs_ptr;

            if ($inputs_ptr < count($inputs)) {
                return ord($inputs[$inputs_ptr++]);
            } else {
                exit("missing input");
            }
        }

        function print_initial_code(){
            echo('&lt;!DOCTYPE html&gt; <br>
            &lt;html lang="en"&gt; <br>
            &lt;head&gt; <br>
                &lt;meta charset="UTF-8"&gt; <br>
                &lt;meta http-equiv="X-UA-Compatible" content="IE=edge"&gt; <br>
                &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt; <br>
                &lt;title&gt;Brainf**k to php&lt;/title&gt; <br>
            &lt;/head&gt; <br>
            &lt;body&gt; <br>
                &lt;form method="POST" action="&lt;?php echo $_SERVER[\'PHP_SELF\'];?&gt;"&gt; <br>
                    input: &lt;input type="text" name="inputs"&gt; <br>
                    &lt;br&gt; <br>
                    &lt;button type="submit"&gt;Run&lt;/button&gt; <br>
                &lt;/form&gt;

                <br><br>
                
                &lt;?php <br>
                    $inputs = []; <br>
                    <br>
                    $inputs_ptr = 0; <br>
                    <br>
                    $memory = array_fill(0, 5000, 0); <br>
                    $ptr = 0; <br>
                    <br>
                    function get_next_char() { <br>
                        global $inputs; <br>
                        global $inputs_ptr; <br>
                        <br>
                        if ($inputs_ptr &lt; count($inputs)) { <br>
                            return ord($inputs[$inputs_ptr++]); <br>
                        } else { <br>
                            exit("&lt;br&gt;&lt;h1&gt;End execution: missing input&lt;/h1&gt;"); <br>
                        } <br>
                    } <br>
                    <br>
                    if ($_SERVER[\'REQUEST_METHOD\'] == \'POST\') { <br>
                        $inputs = str_split($_POST[\'inputs\']); <br>
                ');
        }

        function print_final_code() {
            echo('
                }   <br>
                <br>
                ?&gt; <br>
            &lt;/body&gt; <br>
            &lt;/html&gt; <br>
            ');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $bf_code = $_POST['bf_code'];

            print_initial_code();
            parse_bf($bf_code);
            print_final_code();
            
        }



    ?>
</body>
</html>