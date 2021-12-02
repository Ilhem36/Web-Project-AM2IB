<?php

<html>
        <body>
                <form method="post" action="value.php">
                        <select name="flower[ ]" multiple>
                                <option value="flower">FLOWER</option>
                                <option value="rose">ROSE</option>
                                <option value="lilly">LILLY</option>
                                <option value="jasmine">JASMINE</option>
                                <option value="Lotus">Lotus</option>
                                <option value="tulips">TULIPS</option>
                        </select>
                        <input type="submit" name="submit" value=Submit>
                </form>
        </body>
</html>


?>
<?php
foreach ($_POST['flower'] as $names)
{
        print "You are selected $names<br/>";
}

?>