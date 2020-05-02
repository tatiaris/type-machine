<?php
    $project_name = "Type Machine";
    $fn = "type_machine";
    $language = "py";
    $file_name = "$fn.$language";

    $solution_file = fopen("./$file_name", "r") or die("Unable to open file!");
    $solution_txt = fread($solution_file, filesize("./$file_name"));
    fclose($solution_file);
    if ($language == "py"){
        $lex = "python";
    } else if ($language == "cpp"){
        $lex = "c++";
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>tatia.me | <?php echo $project_name; ?></title>
        <meta charset="utf-8">
        <script src="./../../js/jquery.min.js"></script>
        <link rel="stylesheet" href="./../../css/bootstrap.min.css">
        <script src="./../../js/popper.min.js"></script>
        <link rel="stylesheet" href="./../../css/style.css">
        <link rel="stylesheet" href="./../../css/main.css">
        <script src="./../../js/font_kit.js"></script>
    </head>

    <body>
        <div id="particles-js" class="position-fixed d-flex align-items-center justify-content-center">
            <div class="container position-fixed">
                <button class="btn btn-block" style="background-color:#00897bd6">
                    <a style="color:#282828;float:left"><?php echo $project_name; ?></a>
                    <p style="float:right;"><?php echo strtoupper($lex); ?></p>
                </button>
                <?
                    $url = 'http://hilite.me/api';
                    $data = array('code' => $solution_txt, 'lexer' => $lex, 'options' => '', 'style' => 'fruity', 'lineons' => '', 'divstyles' => 'max-height:80vh;overflow:scroll;font-size:large;border:none;background-color:#21212182;');

                    $options = array(
                        'http' => array(
                            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                            'method'  => 'POST',
                            'content' => http_build_query($data)
                        )
                    );
                    $context  = stream_context_create($options);
                    $result = file_get_contents($url, false, $context);
                    if ($result === False) {echo "could not load code.";}

                    echo $result;
                ?>
            </div>
        </div>

        <form action="./../../"><button type="submit" class="homebutton btn btn-dark fas fa-home"></button></form>
        <form action="./<?php echo $fn; ?>.zip"><button type="submit" class="add_button btn btn-dark fas fa-download"></button></form>

        <script src="./../../particles.js"></script>
        <script src="./../../js/app.js"></script>
    </body>
</html>
