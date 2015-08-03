<p class="form_title">Inscrivez vous</p>
            <p class="info">(*) = obligatoires</p>
            <form method="post" action="regform.php">
                <input type="text" class="textbox" name="pseudo" placeholder="Choisissez un pseudo*" required="required"><br>
                <input type="password" class="textbox" name="password" placeholder="Choisissez un mdp*" required="required"><br>
                <input type="password" class="textbox" name="password2" placeholder="Répétez le mdp*" required="required"><br>
                <input type="email" class="textbox" name="email" placeholder="Votre email valide*" required="required"><br>
                <input type="submit" class="form_btn" value="Inscription">
            </form>
            
            <p class="dejamembre">Déjà membre ?</p>
            
            <p class="form_title">Connectez vous</p>
            <form method="post" action="logform.php">
                <input type="text" class="textbox" name="pseudo" placeholder="Votre pseudo" required="required"><br>
                <input type="password" class="textbox" name="password" placeholder="Votre mdp" required="required"><br>
                <input type="submit" class="form_btn" value="Connexion">
            </form>