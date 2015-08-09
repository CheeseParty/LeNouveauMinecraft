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
if($publies->rowCount() > 0) {
    while($data = $publies->fetch()) {
        echo "<tr>";
        echo "<td>".$data['auteur']."</td>";
        echo "<td>".$data['titre']."</td>";
        echo "<td><a href='read.php?id=".$data['id']."'>Lecture</a></td>";
        echo "<td><button onclick='remove(".$data['auteur'].")'>Retirer</button></td>";
        echo "</tr>";
    }
}
# Pas de résultats
else {
    echo "Aucun article n'a été publié";
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
if($non_publies->rowCount() > 0) {
    while($non_ = $non_publies->fetch()) {
        echo "<tr>";
        echo "<td>".$data['auteur']."</td>";
        echo "<td>".$data['titre']."</td>";
        echo "<td><a href='read.php?id=".$data['id']."'>Lecture</a></td>";
        echo "</tr>";
    }
}
# Pas de résultats
else {
    echo "Aucun articles non-publiés";
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
if($essais->rowCount() > 0) {
    while($data = $essais->fetch()) {
        echo "<tr>";
        echo "<td>".$data['auteur']."</td>";
        echo "<td>".$data['titre']."</td>";
        echo "<td><a href='read.php?id=".$data['id']."'>Lecture</a></td>";
        echo "</tr>";
    }
}
# Pas de résultats
else {
    echo "Aucun articles des rédacteurs à l'essai";
}
echo "</table><br>";
$essais->closeCursor();

# Brouillons de l'utilisateur
$brouillons = $db->prepare('SELECT id, auteur, titre FROM articles WHERE publie=0 AND auteur=? ORDER BY publication LIMIT 0, 10');
$brouillons->execute(array($_SESSION['AUTH']));
?>
<table>
    <caption>Mes brouillons</caption>
    <tr>
        <td>Titre</td>
        <td>Edition</td>
    </tr>
<?php
if($brouillons->rowCount() > 0) {
    while($data = $brouillons->fetch()) {
        echo "<tr>";
        echo "<td>".$data['titre']."</td>";
        echo "<td><button onclick='edit(".$data['id'].")'>Lecture</button></td>";
        echo "</tr>";
    }
}
# Pas de résultats
else {
    echo "Vous n'avez aucun brouillon";
}
echo "</table><br>";
$brouillons->closeCursor();