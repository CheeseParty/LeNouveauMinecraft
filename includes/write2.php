<?php
# Articles publiés
$publies = $db->prepare('SELECT id, auteur, titre FROM articles WHERE publie=1 ORDER BY publication LIMIT 0, 10');
$publies->execute();
?>
<table>
    <caption>Articles publiés</caption>
    <tr>
        <td>Auteur</td>
        <td>Titre</td>
        <td>Lecture</td>
        <td>Retirer</td>
    </tr>
<?php
while($data = $publies->fetch()) {
    echo "<tr>";
    echo "<td>".$data['auteur']."</td>";
    echo "<td>".$data['titre']."</td>";
    echo "<td><a href='read.php?id=".$data['id']."'>Lecture</a></td>";
    echo "<td><button onclick='remove(".$data['auteur'].")'>Retirer</button></td>";
    echo "</tr>";
}
?>
</table><br>
<?php
$publies->closeCursor();

# Articles non-publiés
$non_publies = $db->prepare('SELECT id, auteur, titre FROM articles WHERE publie=0 ORDER BY publication LIMIT 0, 10');
$non_publies->execute();
?>
<table>
    <caption>Articles non-publiés</caption>
    <tr>
        <td>Auteur</td>
        <td>Titre</td>
        <td>Lecture</td>
    </tr>
<?php
while($data = $non_publies->fetch()) {
    echo "<tr>";
    echo "<td>".$data['auteur']."</td>";
    echo "<td>".$data['titre']."</td>";
    echo "<td><a href='read.php?id=".$data['id']."'>Lecture</a></td>";
    echo "</tr>";
}
?>
</table><br>
<?php
$non_publies->closeCursor();

# Articles des rédacteurs à l'essai
$essais = $db->prepare('SELECT id, auteur, titre FROM articles WHERE publie=-1 ORDER BY publication LIMIT 0, 10');
$essais->execute();
?>
<table>
    <caption>Articles des rédacteurs à l'essai</caption>
    <tr>
        <td>Auteur</td>
        <td>Titre</td>
        <td>Lecture</td>
    </tr>
<?php
while($data = $essais->fetch()) {
    echo "<tr>";
    echo "<td>".$data['auteur']."</td>";
    echo "<td>".$data['titre']."</td>";
    echo "<td><a href='read.php?id=".$data['id']."'>Lecture</a></td>";
    echo "</tr>";
}
?>
</table><br>
<?php
$essais->closeCursor();