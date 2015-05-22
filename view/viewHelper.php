<?php

function showNewsItems(array $arr) {
    getDebug($arr);

    $output = '';
    foreach ($arr as $item) {
        $output .= '<div class="news-item"><h3>' . $item->getHeadline() . '</h3>
                    <p>' . $item->getTextbody() . '</p>';
        if($item->getImage() != 0){
            $output .= '<img src="'.IMAGE_PATH.$item->getImage().'" alt="" width="150" />';
        }
        if ($_GET['a'] == 'all') {
            if ($_SESSION['user']['id'] == $item->getBenutzerId()) {
                $output .= '<p><a href="index.php?a=edit&id=' . $item->getId() . '">Bearbeiten</a>
                    <a href="index.php?a=delete&id=' . $item->getId() . '">Löschen</a><p>';
            }
        }
        $output .='</div>';
    }
    return $output;
}

function showNewsForm(News $news){
    $output = '<form action="index.php?a=update" method="post">
               <input type="hidden" name="id" value="' . $news->getId() . '" />
                <input type="text" name="headline" value="' . $data->getHeadline() . '" placeholder="Titel" /><br/>
                <textarea name="textbody" placeholder="Nachricht eingeben">' . $data->getTextbody() . '</textarea><br/>
                <select name="status">
                    <option value="0" ' . ($data->getStatus() == 0 ? 'selected' : '') . '>nicht sichtbar</option>
                    <option value="1" ' . ($data->getStatus() == 1 ? 'selected' : '') . '>publiziert</option>
                    <option value="2" ' . ($data->getStatus() == 2 ? 'selected' : '') . '>gesperrt</option>
                </select><br/>
                <button type="submit">Speichern</button>
               </form>';
    return $output;
}