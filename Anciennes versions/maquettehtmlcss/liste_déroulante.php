<form method="get" action="">
    <select name="tag[]" MULTIPLE />
    <option value="a">a</option>
    <option value="b">b</option>
    <option value="c">c</option>
    </select><br />
    <input type="submit" value="Envoyer" />
</form>

<?php
if(!empty($_GET['tag'])) {
    echo implode('', $_GET['tag']);
}
?>
