<?php
# Articles publiés
$publies = $db->prepare('SELECT id, auteur, titre FROM articles WHERE publie=1 ORDER BY publication LIMIT 0, 10');
$publies->execute();
?>
<table>
    <caption>Articles publiés</caption>
    <tr>
        <th>Auteur</th>
        <th>Titre</th>
        <th>Lecture</th>
        <th>Retirer</th>
    </tr>
<?php
if($publies->rowCount() > 0) {
    while($data = $publies->fetch()) {
        echo "<tr>";
        echo "<td>".$data['auteur']."</td>";
        echo "<td>".$data['titre']."</td>";
        echo "<td><button onclick='read(".$data['id'].")'>Lire</button></td>";
        echo "<td><button onclick='remove(".$data['auteur'].")'>Retirer</button></td>";
        echo "</tr>";
    }
}
# Pas de résultats
else {
    echo "<tr><td colspan='4'>Aucun article n'a été publié</td></tr>";
}
?>
</table>
<?php
$publies->closeCursor();

# Articles non-publiés
$non_publies = $db->prepare('SELECT id, auteur, titre FROM articles WHERE publie=0 ORDER BY publication LIMIT 0, 10');
$non_publies->execute();
?>
<table>
    <caption>Articles non-publiés</caption>
    <tr>
        <th>Auteur</th>
        <th>Titre</th>
        <th>Lecture</th>
    </tr>
<?php
if($non_publies->rowCount() > 0) {
    while($data = $non_publies->fetch()) {
        echo "<tr>";
        echo "<td>".$data['auteur']."</td>";
        echo "<td>".$data['titre']."</td>";
        echo "<td><button onclick='read(".$data['id'].")'>Lire</button></td>";
        echo "</tr>";
    }
}
# Pas de résultats
else {
    echo "<tr><td colspan='3'>Aucun articles non-publiés</td></tr>";
}
?>
</table>
<?php
$non_publies->closeCursor();

# Articles des rédacteurs à l'essai
$essais = $db->prepare('SELECT id, auteur, titre FROM articles WHERE publie=-1 ORDER BY publication LIMIT 0, 10');
$essais->execute();
?>
<table>
    <caption>Articles des rédacteurs à l'essai</caption>
    <tr>
        <th>Auteur</th>
        <th>Titre</th>
        <th>Lecture</th>
    </tr>
<?php
if($essais->rowCount() > 0) {
    while($data = $essais->fetch()) {
        echo "<tr>";
        echo "<td>".$data['auteur']."</td>";
        echo "<td>".$data['titre']."</td>";
        echo "<td><button onclick='read(".$data['id'].")'>Lire</button></td>";
        echo "</tr>";
    }
}
# Pas de résultats
else {
    echo "<tr><td colspan='3'>Aucun articles des rédacteurs à l'essai</td></tr>";
}
echo "</table>";
$essais->closeCursor();

# Brouillons de l'utilisateur
$brouillons = $db->prepare('SELECT id, auteur, titre FROM articles WHERE publie=0 AND auteur=? ORDER BY publication LIMIT 0, 10');
$brouillons->execute(array($_SESSION['AUTH']));
?>
<table id="brouillons">
    <caption>Mes brouillons</caption>
    <tr>
        <th>Titre</th>
        <th>Edition</th>
    </tr>
<?php
if($brouillons->rowCount() > 0) {
    while($data = $brouillons->fetch()) {
        echo "<tr>";
        echo "<td>".$data['titre']."</td>";
        echo "<td><button onclick='edit(".$data['id'].")'>Editer</button></td>";
        echo "</tr>";
    }
}
# Pas de résultats
else {
    echo "<tr><td colspan='2'>Vous n'avez aucun brouillon</td></tr>";
}
echo "</table>";
$brouillons->closeCursor();