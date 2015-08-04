<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Nether News - News sur le jeu de type "sandbox"</title>
		<link rel="stylesheet" href="style.css">
		<link href='http://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>

		<!-- Métadonnées pour SEO -->
		
		<!-- Fin  meta pour SEO -->

	</head>
	<body>
        <div id="cache"></div>
		<div id="content">
            
            <header>
                <div id="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                </div>
                
                <a class="title" href="index.php">Nether News</a>
                <a class="login" onclick="toggleLogin()">Connexion | Inscription</a>
                
                <div id="loginbox">
                    <p class="form_title">Connectez vous</p>
                    <img class="cross" src="close32.svg" onclick="toggleLogin()">
                    <form method="post" action="logform.php">
                    <input type="text" class="textbox" name="pseudo" placeholder="Nom d'utilisateur" required>
                    <input type="password" class="textbox" name="password" placeholder="Mot de passe" required>

                    <div id="loginzone">
                        <label class="css-label"><input type="checkbox" name="rememberbox" value="1"> Se souvenir de moi</label>
                        <input type="submit" class="form_btn" value="Connexion">
                    </div>

                    </form>

                                                            <hr class="separatorform">

                    <p class="form_title">Inscrivez vous</p>
                    <p class="forminfo">(*) = obligatoires</p>

                    <form method="post" action="regform.php">
                        <input type="text" class="textbox" name="pseudo" placeholder="Nom d'utilisateur" required>       
                        <input type="password" class="textbox" name="password" placeholder="Mot de passe" required>
                        <input type="password" class="textbox" name="password2" placeholder="Répétez le mot de passe" required>
                        <input type="email" class="textbox" name="email" placeholder="Adresse mail valide" required>
                        <input type="submit" class="form_btn2" value="Inscription">
                    </form>
            
        </div>
                <div id="menu">
                    <p class="menutext">MENU</p>
			<span>Maps</span>
			<span>Mods</span>
			<span>Plugins</span>
            <span>Versions</span>
		</div>
            </header>
            
            <div id="page">
                <div id="image"></div>
                
                <div class="article">
                    <img src="http://screenshots.fr.sftcdn.net/fr/scrn/189000/189271/minecraft-02-700x393.jpg">
                    <h2>MAP: It's so huge! ü</h2>
                    </article>
                    
                    
                </div>
                <!-- <article>
                        <p class="articletitle">Notre premier article</p>
                        <p class="articletext">Fusce sodales nibh id ultrices bibendum. Donec iaculis vel ligula at sollicitudin. Praesent quis enim quis leo iaculis sollicitudin consectetur id tellus. Curabitur quis velit ultricies, porta lorem quis, lobortis magna. Donec ac iaculis libero, non pellentesque lorem. Suspendisse vitae faucibus nunc, ornare consequat ante. Mauris quis gravida eros. Curabitur posuere lectus ac nisl lacinia, a posuere odio vulputate. In nec sapien eu leo lobortis tempor. Nulla f...(line truncated)...
                        
                        <a class="savoirplus" href="#">En savoir +</a> -->
            
               <!-- <div class="article">
                    <article>
                        <p class="articletitle">Notre deuxième article</p>
                        <p class="articletext">Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis ac nisl lacus. Suspendisse potenti. Pellentesque euismod tortor eget nulla eleifend, eget suscipit nunc blandit. Nullam faucibus nisi et diam auctor, a iaculis justo euismod. Aliquam venenatis lobortis nulla, sodales faucibus eros auctor non. Nullam porttitor neque eu velit efficitur, tristique rutrum massa feugiat. Donec congue tempor pulvinar. Integer quis risus egestas, convallis risus at, vestibulum diam. In enim leo, tincidunt consequat fringilla ut, scelerisque sit amet felis. Praesent elit magna, porttitor sed ante eu, aliquam sodales risus. Aenean pharetra tellus pharetra, maximus lacus in, consequat elit. Vestibulum hendrerit quam purus, vitae ullamcorper lacus sodales nec. Fusce volutpat ante at turpis laoreet, sit amet lacinia sem tempus. Morbi eu euismod risus.</p>
                        
                        <a class="savoirplus" href="#">En savoir +</a>
                    </article>
                    
                    -->
                </div>
            </div>
        </div>
        <script type='text/javascript'>
            function toggleLogin() {
                var loginbox = document.getElementById("loginbox");
                if(loginbox.style.zIndex==99) 
                {   
                    cache.style.zIndex=-1;
                    loginbox.style.zIndex=-1;
                }
                
                else{
                    loginbox.style.zIndex=99;
                    cache.style.zIndex=99;
                }
                    
            }
		function initMenu() {
            		document.getElementById("hamburger").addEventListener('click', function(){
				var menu = document.getElementById("menu");
				var burger = document.getElementById("hamburger");
				if(window.getComputedStyle(menu).top == "-230px") {
					menu.style.top = "85px";
					burger.style.transform = "rotate(90deg)";
				} else {
					menu.style.top = "-230px";
					burger.style.transform = "rotate(0)";
				}
			});
			window.addEventListener('resize', function(){
				moveMenu();
			});
		}

		
            window.onload=function(){
                initMenu();
                moveMenu();
            }
            
            function moveMenu() {
    document.getElementById("menu").style.left = window.getComputedStyle(document.getElementById("content")).marginLeft;
  }
                </script>
	</body>
</html>