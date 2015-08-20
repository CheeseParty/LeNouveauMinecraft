<?php
# BUILD_CACHE.PHP
# Construction du cache principale et de la catégorie affectée par la publication d'un article

# Démarrage de la temporisation de sortie
ob_start();

# Inclusion pour la connexion à la bdd
require('includes/connexion.php');

# Construction du cache principal
$select = $db -> prepare('SELECT categorie, titre, thumbnail, version FROM articles WHERE publie=1 LIMIT 0,20');
$select -> execute();
while($data = $select -> fetch()) {
    switch($data['categorie']) {
        case '0':
            $data['categorie'] = "map";
            break;
            
        case '1':
            $data['categorie'] = "mod";
            break;
            
        case '2':
            $data['categorie'] = "version";
            break;
            
        case '3':
            $data['categorie'] = "plugin";
            break;
            
        case '4':
            $data['categorie'] = "texture";
            break;
            
        case '5':
            $data['categorie'] = "cheats";
            break;
            
        case '6':
            $data['categorie'] = "divers";
            break;
    }    
?>
    <article class="<?=$data['categorie']?>">
        <a href="" style="background:url('upload/full/<?=$data['thumbnail']?>') no-repeat;background-size:cover">
            <h2><?=$data['categorie']?> :
                <span><?=$data['titre']?></span>
            </h2>
            <?php if(!empty($data['version'])): ?>
                <span><?=$data['version']?></span>
            <?php endif ?>
        </a>
    </article>
        
<?php
}

# Fermeture de la requête
$select -> closeCursor();

# Ouverture du fichier de cache principal
$cache = fopen('cache/index.php', 'w');
fwrite($cache, ob_get_contents());
fclose($cache);

# Termine la temporisation et vide le tampon
ob_end_clean();



# Démarrage de la temporisation de sortie
ob_start();

# Construction du cache de catégorie
$select = $db -> prepare('SELECT categorie, titre, thumbnail, version FROM articles WHERE publie=1 LIMIT 0,20');
$select -> execute();

switch($_POST['categorie']) {
    case '0':
        $categorie = "map";
        break;

    case '1':
        $categorie = "mod";
        break;

    case '2':
        $categorie = "version";
        break;

    case '3':
        $categorie = "plugin";
        break;

    case '4':
        $categorie = "texture";
        break;

    case '5':
        $categorie = "cheats";
        break;

    case '6':
        $categorie = "divers";
        break;
}

while($data = $select -> fetch()) {   
?>
    <article class="<?=$categorie?>">
        <a href="" style="background:url('upload/full/<?=$data['thumbnail']?>') no-repeat;background-size:cover">
            <h2><?=$categorie?> :&nbsp;
                <span><?=$data['titre']?></span>
            </h2>
            <?php if(!empty($data['version'])): ?>
                <span><?=$data['version']?></span>
            <?php endif ?>
        </a>
    </article>

<?php
}

# Fermeture de la requête
$select -> closeCursor();

# Ouverture du fichier de cache principal
$cache = fopen('cache/'.$categorie.'.php', 'w');
fwrite($cache, ob_get_contents());
fclose($cache);

# Termine la temporisation et vide le tampon
ob_end_clean();