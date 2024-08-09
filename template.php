      <?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
      <!DOCTYPE html>
      <html>
      <head>
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <link rel="icon" type="image/x-icon" href="/public/Images/logotest3.png">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://db.onlinewebfonts.com/c/95cecf452d3208890088a5b4c19c7ecf?family=Helvetica+Neue+ME" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="public/style/style.template.css">
        <link rel="stylesheet" href="public/style/style.connexion.css">
        <link rel="stylesheet" href="public/style/style.accueil.css">
        <link rel="stylesheet" href="public/style/style.thread.css">
        <link rel="stylesheet" href="public/style/style.new.css">
        <link rel="stylesheet" href="public/style/style.category.css">
        <link rel="stylesheet" href="public/style/style.userlist.css">
        <link rel="stylesheet" href="public/style/style.profile.css">
        <link rel="stylesheet" href="public/style/style.404.css">
        <link rel="stylesheet" href="public/style/style.updateprofile.css">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <title></title>
      </head>
          <body>
                <header>
                    <div class="containertemplate">
                        <nav>
                            <div class="mobile-menu-button">
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                            </div>
                            <div class="leftfill"></div>
                            <div class="bandeau">
                                    <a class="logolink" href="/"><img class="logo"src="public/Images/logotest3.png" alt=""></a>
                                    <ul>
                                        <li><a class="navlink category" href="/category"><span>Category</span></a></li>
                                        <li><a class="navlink commoners" href="/userlist"><span>W.I.P</span></a></li>
                                        <?php if (isset($_SESSION['username'])){
                                        echo '<li><a class="navlink newtopic" href="/new"><span>New</span></a></li>';
                                    }
                                    ?>
                                    </ul>
                                    <form action="/" method="GET">
                                        <input type="text" id="searchInput" name="query" placeholder="Search">
                                    </form>
                                    <?php if (!isset($_SESSION['username'])){
                                        echo '<button class="login"><a href="/connexion">Log in</a></button>
                                        <button class="signup"><a href="/inscription">Sign up</a></button>';
                                    }?>
                                    
                                    <?php if (isset($_SESSION['username'])){
                                        echo '<button class="signup"><a href="/deconnection">Disconnect</a></button>';
                                        echo '<button class="login"><a href="/profile">Profile</a></button>';
                                    }?>
                                    
                            </div>
                            <div class="rightfill">
                            <?php if (isset($_SESSION['username'])){
                                        echo '<a href="/new">
                                        <svg class="new"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 161.51 161.51" >
                                            <circle cx="80.76" cy="80.76" r="80.76" fill="#3571b8"></circle>
                                            <path d="M80.76 121.26c-2.49 0-4.5-2.01-4.5-4.5v-72a4.5 4.5 0 0 1 9 0v72c0 2.48-2.02 4.5-4.5 4.5z">
                                            </path>
                                            <path d="M116.76 85.26h-72a4.5 4.5 0 0 1 0-9h72a4.5 4.5 0 0 1 0 9z">
                                            </path>
                                        </svg>
                                    </a>';
                                    }?>
                                
                            </div>
                        </nav>
                    </div>
                    
                    <div class="side-menu">
                        <ul>
                        <?php if (isset($_SESSION['username'])){
                    echo '<li><a class="navlink-side" href="/new"><span>New</span></a></li>';
                            }?>
                            <li><a class="navlink-side" href="/category"><span>Category</span></a></li>
                            <li><a class="navlink-side" href="/userlist"><span>Users</span></a></li>
                            
                        </ul>
                    </div>
                </header>
            
              <?= $content ?>




              <script src="javascript/script.js"></script>
          </body>

      </html>